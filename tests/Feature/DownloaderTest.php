<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DownloaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_editorjs_renderer_drops_exact_duplicate_text_blocks()
    {
        $content = json_encode(['blocks' => [
            ['type' => 'header', 'data' => ['text' => 'Useful guide', 'level' => 2]],
            ['type' => 'paragraph', 'data' => ['text' => 'Keep this practical paragraph.']],
            ['type' => 'paragraph', 'data' => ['text' => '  KEEP this practical paragraph.  ']],
        ]]);

        $html = \App\Models\Blog::renderEditorJS($content);

        $this->assertSame(1, substr_count(strtolower($html), 'keep this practical paragraph.'));
    }

    public function test_public_trust_pages_footer_and_security_headers_are_ready()
    {
        $this->seed();

        foreach (['/about', '/contact', '/dmca', '/privacy', '/terms', '/disclaimer'] as $path) {
            $this->get($path)->assertOk();
        }

        $home = $this->get('/');
        $home->assertOk()
            ->assertSee(route('privacy'), false)
            ->assertSee(route('terms'), false)
            ->assertSee(route('dmca'), false)
            ->assertDontSee('No platforms available')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN');

        $this->get('/privacy-policy')->assertRedirect('/privacy');
        $this->get('/terms-of-service')->assertRedirect('/terms');

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee(route('about'), false)
            ->assertSee(route('contact'), false)
            ->assertSee(route('dmca'), false);

        $this->get('/this-page-does-not-exist')
            ->assertNotFound()
            ->assertSee('Page not found');
    }

    public function test_blog_has_one_hundred_indexable_articles_with_metadata()
    {
        $this->seed();
        $this->get('/blog')
            ->assertOk()
            ->assertSee('YouTube Video Downloader: Safe HD MP4 Guide')
            ->assertSee('/images/blog/generated/', false);

        $this->assertCount(100, config('blog'));

        $this->get('/blog/youtube-video-downloader-safe-hd-mp4-guide')
            ->assertOk()
            ->assertSee('<link rel="canonical"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('YouTube Video Downloader: Safe HD MP4 Guide');

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function test_admin_can_open_the_post_editor_on_laravel_eight()
    {
        $this->seed();
        $admin = \App\Models\User::firstOrFail();
        $post = \App\Models\BlogPost::firstOrFail();

        $this->actingAs($admin)
            ->get('/admin?edit=' . $post->id)
            ->assertOk()
            ->assertSee('Edit post');
    }

    public function test_it_merges_extension_cache_and_source_but_only_shows_direct_formats()
    {
        Http::fake(function (Request $request) {
            $origin = $request->data()['origin'] ?? ($request->data()['data']['origin'] ?? null);

            if ($origin === 'cache') {
                return Http::response([
                    'status' => 1,
                    'data' => [
                        'title' => 'Extension Cache Video',
                        'thumbnail' => 'https://example.com/thumb.jpg',
                        'duration' => 90,
                        'resources' => [
                            [
                                'type' => 'video',
                                'quality' => '720P',
                                'format' => 'MP4',
                                'size' => 1000000,
                                'download_url' => 'https://media.example.com/720.mp4',
                            ],
                        ],
                    ],
                ]);
            }

            return Http::response([
                'status' => 1,
                'data' => [
                    'title' => 'Extension Source Video',
                    'thumbnail' => 'https://example.com/thumb.jpg',
                    'duration' => 90,
                    'resources' => [
                        [
                            'type' => 'video',
                            'quality' => '360P',
                            'format' => 'MP4',
                            'size' => 500000,
                            'download_url' => 'https://media.example.com/360.mp4',
                        ],
                        [
                            'type' => 'video',
                            'quality' => '1080P',
                            'format' => 'MP4',
                            'size' => 2000000,
                            'download_url' => '',
                            'resource_content' => 'conversion-only',
                        ],
                    ],
                ],
            ]);
        });

        $response = $this->followingRedirects()->post('/analyze', [
            'video_url' => 'https://www.youtube.com/watch?v=test123',
        ]);

        $response->assertOk();
        $response->assertSee('720P');
        $response->assertSee('360P');
        $response->assertDontSee('conversion-only');
        $response->assertDontSee('class="download-link prepare-download"', false);

        Http::assertSentCount(2);
    }

    public function test_it_shows_preparable_formats_for_tiktok()
    {
        Http::fake(function (Request $request) {
            $origin = $request->data()['origin'] ?? ($request->data()['data']['origin'] ?? null);
            if ($origin === 'cache') {
                return Http::response(['status' => 0]);
            }

            return Http::response([
                'status' => 1,
                'data' => [
                    'title' => 'TikTok Video',
                    'thumbnail' => 'https://example.com/tiktok.jpg',
                    'duration' => 20,
                    'resources' => [
                        [
                            'type' => 'video',
                            'quality' => 'HD',
                            'format' => 'MP4',
                            'size' => 1500000,
                            'download_url' => '',
                            'resource_content' => 'encrypted-tiktok-request',
                        ],
                    ],
                ],
            ]);
        });

        $response = $this->followingRedirects()->post('/analyze', [
            'video_url' => 'https://vt.tiktok.com/test-video',
        ]);

        $response->assertOk();
        $response->assertSee('TikTok Video');
        $response->assertSee('HD');
        $response->assertSee('prepare-download', false);
        $response->assertDontSee('No direct download formats');
    }

    public function test_plugin_sse_result_becomes_a_signed_download_url()
    {
        $token = 'test-tiktok-token';
        Cache::put('plugin_prepare:' . $token, [
            'request' => 'encrypted-tiktok-request',
        ], now()->addMinutes(5));

        Http::fake([
            'https://plugin.vidssave.com/api/sse*' => Http::response(
                "event: success\ndata: {\"download_link\":\"https://media.example.com/tiktok.mp4\"}\n\n"
            ),
        ]);

        $url = URL::temporarySignedRoute('plugin.prepare', now()->addMinutes(5), [
            'token' => $token,
            'name' => 'tiktok-video.mp4',
        ]);
        $response = $this->get($url);

        $response->assertOk();
        $response->assertJsonStructure(['download_url']);
        $this->assertStringContainsString('/download-file?', $response->json('download_url'));
        $this->assertStringContainsString('signature=', $response->json('download_url'));
    }
}
