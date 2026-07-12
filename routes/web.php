<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\PlatformController;
use App\Models\BlogPost;

$platforms = [
    ['name' => 'YouTube', 'domain' => 'youtube.com', 'accent' => '#ff3b30', 'icon' => 'youtube', 'slug' => 'youtube-video-downloader'],
    ['name' => 'Facebook', 'domain' => 'facebook.com', 'accent' => '#1877f2', 'icon' => 'facebook', 'slug' => 'facebook-video-downloader'],
    ['name' => 'Instagram', 'domain' => 'instagram.com', 'accent' => '#e1306c', 'icon' => 'instagram', 'slug' => 'instagram-video-downloader'],
    ['name' => 'TikTok', 'domain' => 'tiktok.com', 'accent' => '#00b9d8', 'icon' => 'tiktok', 'slug' => 'tiktok-video-downloader'],
    ['name' => 'Twitter / X', 'domain' => 'x.com', 'accent' => '#111827', 'icon' => 'x', 'slug' => 'twitter-video-downloader'],
    ['name' => 'Vimeo', 'domain' => 'vimeo.com', 'accent' => '#1ab7ea', 'icon' => 'vimeo', 'slug' => 'vimeo-video-downloader'],
    ['name' => 'Dailymotion', 'domain' => 'dailymotion.com', 'accent' => '#00aaff', 'icon' => 'dailymotion', 'slug' => 'dailymotion-video-downloader'],
    ['name' => 'Pinterest', 'domain' => 'pinterest.com', 'accent' => '#e60023', 'icon' => 'pinterest', 'slug' => 'pinterest-video-downloader'],
];

$loadPosts = function () {
    try {
        return BlogPost::published()->latest('published_at')->get()->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'meta_title' => $post->meta_title,
                'slug' => $post->slug,
                'category' => $post->category,
                'excerpt' => $post->excerpt,
                'description' => $post->meta_description ?: $post->excerpt,
                'read' => $post->read_minutes . ' min read',
                'published' => optional($post->published_at)->format('M j, Y'),
                'image' => $post->image,
                'image_alt' => $post->image_alt ?: $post->title,
                'content' => $post->content,
            ];
        })->all();
    } catch (\Throwable $exception) {
        return [];
    }
};

// ── Admin Routes ──────────────────────────────────────────────────────────────
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'doLogin'])->name('admin.login.post');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard-data', [AdminController::class, 'dashboardData'])->name('admin.dashboard.data');
Route::get('/admin/homepage', [AdminController::class, 'homepageEdit'])->name('admin.homepage');
Route::post('/admin/homepage', [AdminController::class, 'homepageSave'])->name('admin.homepage.save');

// SEO Admin Routes
Route::get('/admin/seo-settings', [AdminController::class, 'seoSettings'])->name('admin.seo_settings');
Route::post('/admin/seo-settings', [AdminController::class, 'seoSettingsUpdate'])->name('admin.seo_settings.update');

// FAQ Admin Routes
Route::get('/admin/faqs', [AdminController::class, 'faqIndex'])->name('admin.faqs');
Route::post('/admin/faqs', [AdminController::class, 'faqStore'])->name('admin.faqs.store');
Route::get('/admin/faqs/{id}/edit', [AdminController::class, 'faqEdit'])->name('admin.faqs.edit');
Route::post('/admin/faqs/{id}/edit', [AdminController::class, 'faqUpdate'])->name('admin.faqs.update');
Route::delete('/admin/faqs/{id}', [AdminController::class, 'faqDelete'])->name('admin.faqs.delete');

// FAQ Page (Dedicated)
Route::get('/admin/faq-page', [AdminController::class, 'faqPageSettings'])->name('admin.faq_page');
Route::post('/admin/faq-page', [AdminController::class, 'faqPageStore'])->name('admin.faq_page.store');
Route::post('/admin/faq-page/seo', [AdminController::class, 'faqPageSeoSave'])->name('admin.faq_page.seo.save');
Route::delete('/admin/faq-page/{id}', [AdminController::class, 'faqPageDelete'])->name('admin.faq_page.delete');

// Download Page (Dedicated)
Route::get('/admin/download-page', [AdminController::class, 'downloadPage'])->name('admin.download_page');
Route::post('/admin/download-page', [AdminController::class, 'downloadPageSave'])->name('admin.download_page.save');

// Footer Settings
Route::get('/admin/footer-settings', [AdminController::class, 'footerSettings'])->name('admin.footer_settings');
Route::post('/admin/footer-settings', [AdminController::class, 'footerSettingsSave'])->name('admin.footer_settings.save');

// Blog Admin Routes
Route::get('/admin/blogs', [BlogController::class, 'index'])->name('admin.blogs.index');
Route::get('/admin/blogs/create', [BlogController::class, 'create'])->name('admin.blogs.create');
Route::post('/admin/blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
Route::get('/admin/blogs/{id}/edit', [BlogController::class, 'edit'])->name('admin.blogs.edit');
Route::post('/admin/blogs/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
Route::delete('/admin/blogs/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.delete');

// Legacy BlogPost edit routes
Route::get('/admin/legacy-blogs/{id}/edit', [BlogController::class, 'legacyEdit'])->name('admin.legacy_blogs.edit');
Route::post('/admin/legacy-blogs/{id}', [BlogController::class, 'legacyUpdate'])->name('admin.legacy_blogs.update');


// Guide Admin Routes
Route::get('/admin/guides', [GuideController::class, 'index'])->name('admin.guides.index');
Route::get('/admin/guides/create', [GuideController::class, 'create'])->name('admin.guides.create');
Route::post('/admin/guides', [GuideController::class, 'store'])->name('admin.guides.store');
Route::get('/admin/guides/{id}/edit', [GuideController::class, 'edit'])->name('admin.guides.edit');
Route::post('/admin/guides/{id}', [GuideController::class, 'update'])->name('admin.guides.update');
Route::delete('/admin/guides/{id}', [GuideController::class, 'destroy'])->name('admin.guides.delete');
Route::get('/guide/{slug}/', [GuideController::class, 'publicShow'])->name('guide.show');

// Platform Admin Routes
Route::get('/admin/platforms', [PlatformController::class, 'index'])->name('admin.platforms.index');
Route::get('/admin/platforms/create', [PlatformController::class, 'create'])->name('admin.platforms.create');
Route::post('/admin/platforms', [PlatformController::class, 'store'])->name('admin.platforms.store');
Route::get('/admin/platforms/{id}/edit', [PlatformController::class, 'edit'])->name('admin.platforms.edit');
Route::post('/admin/platforms/{id}', [PlatformController::class, 'update'])->name('admin.platforms.update');
Route::delete('/admin/platforms/{id}', [PlatformController::class, 'destroy'])->name('admin.platforms.delete');
Route::post('/admin/platforms/{id}/faqs', [PlatformController::class, 'faqStore'])->name('admin.platforms.faqs.store');
Route::delete('/admin/platforms/faqs/{faq_id}', [PlatformController::class, 'faqDelete'])->name('admin.platforms.faqs.delete');

// Public FAQs
Route::get('/faqs/', [AdminController::class, 'publicFaqs'])->name('public.faqs');

// CKEditor image upload
Route::post('/admin/cms/upload-editor-image', [AdminController::class, 'uploadEditorImage'])->name('admin.cms.upload-editor-image');

// ── Original Frontend Routes ──────────────────────────────────────────────────

Route::get('/', function () use ($platforms, $loadPosts) {
    $homeSettings = DB::table('homepage_settings')->first();
    $homeSeo = \App\Models\PageSeo::where('page_name', 'home')->first();
    $faqs = DB::table('faqs')->where('page', 'home')->where('is_active', true)->orderBy('sort_order')->get();

    return view('welcome', [
        'page'         => 'home',
        'platforms'    => $platforms,
        'posts'        => $loadPosts(),
        'result'       => session('result'),
        'homeSettings' => $homeSettings,
        'homeSeo'      => $homeSeo,
        'faqs'         => $faqs,
    ]);
})->name('home');

Route::get('/supported-platforms', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page'      => 'platforms',
        'platforms' => $platforms,
        'posts'     => $loadPosts(),
        'result'    => null,
    ]);
})->name('platforms');

Route::get('/blog', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page'      => 'blog',
        'platforms' => $platforms,
        'posts'     => $loadPosts(),
        'result'    => null,
    ]);
})->name('blog');

// Replaced blog slug route to work with both models on the original welcome view
Route::get('/blog/{slug}', function ($slug) use ($platforms, $loadPosts) {
    $posts = $loadPosts();
    
    // Also include new blogs in the view if they want to access them
    $newBlog = \App\Models\Blog::where('slug', $slug)->first();
    
    if ($newBlog) {
        $post = [
            'id'          => 'new_' . $newBlog->id,
            'title'       => $newBlog->title,
            'slug'        => $newBlog->slug,
            'category'    => $newBlog->tags ?? 'General',
            'excerpt'     => $newBlog->meta_description ?? '',
            'description' => $newBlog->meta_description ?? '',
            'read'        => '5 min read',
            'published'   => $newBlog->created_at->format('M j, Y'),
            'image'       => $newBlog->featured_image,
            'image_alt'   => $newBlog->title,
            'content'     => $newBlog->renderContent(),
        ];
    } else {
        $post = collect($posts)->firstWhere('slug', $slug);
        abort_unless($post, 404);
    }

    return view('welcome', [
        'page'         => 'blog-post',
        'platforms'    => $platforms,
        'posts'        => $posts,
        'post'         => $post,
        'relatedPosts' => collect($posts)
            ->where('slug', '!=', $slug)
            ->sortByDesc(function ($item) use ($post) {
                return $item['category'] === $post['category'];
            })
            ->take(3),
        'result'       => null,
    ]);
})->name('blog.show');

Route::get('/privacy', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page'      => 'privacy',
        'platforms' => $platforms,
        'posts'     => $loadPosts(),
        'result'    => null,
    ]);
})->name('privacy');

Route::get('/terms', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page'      => 'terms',
        'platforms' => $platforms,
        'posts'     => $loadPosts(),
        'result'    => null,
    ]);
})->name('terms');

Route::get('/disclaimer', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page'      => 'disclaimer',
        'platforms' => $platforms,
        'posts'     => $loadPosts(),
        'result'    => null,
    ]);
})->name('disclaimer');

// ── Analyze / Download (existing hd-video-downloadr logic) ───────────────────
Route::post('/analyze', function (Request $request) {
    $platformsList = [
        ['name' => 'YouTube', 'domain' => 'youtube.com'],
        ['name' => 'Facebook', 'domain' => 'facebook.com'],
        ['name' => 'Instagram', 'domain' => 'instagram.com'],
        ['name' => 'TikTok', 'domain' => 'tiktok.com'],
        ['name' => 'Twitter / X', 'domain' => 'x.com'],
        ['name' => 'Vimeo', 'domain' => 'vimeo.com'],
        ['name' => 'Dailymotion', 'domain' => 'dailymotion.com'],
        ['name' => 'Pinterest', 'domain' => 'pinterest.com'],
    ];

    $data = $request->validate([
        'video_url' => ['required', 'url', 'max:2048'],
    ]);

    $host = parse_url($data['video_url'], PHP_URL_HOST) ?: 'public video link';
    $cleanHost = preg_replace('/^www\./', '', strtolower($host));
    $platform = collect($platformsList)->first(function ($item) use ($cleanHost) {
        return strpos($cleanHost, $item['domain']) !== false;
    });

    $pluginEndpoint = 'https://api.vidssave.com/api/contentsite_api/media/parse';
    $pluginToken = base64_encode('vidssave_brower_plugin_' . round(microtime(true) * 1000));

    try {
        $pluginData = [];
        foreach (['cache', 'source'] as $origin) {
            try {
                $response = Http::asForm()->retry(1, 500)->timeout(15)->post($pluginEndpoint, [
                    'auth' => '20250901majwlqo',
                    'domain' => 'api-ak.vidssave.com',
                    'origin' => $origin,
                    'link' => $data['video_url'],
                    'plugin_token' => $pluginToken,
                ]);
                $body = $response->json();
                if ($response->successful() && ($body['status'] ?? null) === 1 && !empty($body['data'])) {
                    $pluginData[$origin] = $body['data'];
                }
            } catch (\Throwable $exception) {
                continue;
            }
        }

        $videoData = $pluginData['source'] ?? $pluginData['cache'] ?? null;
        $allowPreparedFormats = !($platform && $platform['domain'] === 'youtube.com');
        $rawResources = array_merge(
            $pluginData['cache']['resources'] ?? [],
            $pluginData['source']['resources'] ?? []
        );

        if ($videoData) {
            $resources = collect($rawResources)->filter(function ($resource) {
                return is_array($resource);
            })->filter(function ($resource) use ($allowPreparedFormats) {
                return !empty($resource['download_url'])
                    || ($allowPreparedFormats && !empty($resource['resource_content']));
            })->unique(function ($resource) {
                return strtolower(implode('|', [
                    $resource['type'] ?? '',
                    $resource['quality'] ?? '',
                    $resource['format'] ?? '',
                ]));
            })->map(function ($resource) use ($allowPreparedFormats) {
                $rawType = strtolower((string) ($resource['type'] ?? ''));
                $rawFormat = $resource['format'] ?? $resource['ext'] ?? null;
                if (!$rawFormat && in_array($rawType, ['audio', 'music'], true)) {
                    $rawFormat = 'MP3';
                } elseif (!$rawFormat && in_array($rawType, ['video', 'media'], true)) {
                    $rawFormat = 'MP4';
                }
                $format = strtoupper((string) ($rawFormat ?? $resource['type'] ?? 'MP4'));
                $quality = (string) ($resource['quality'] ?? $resource['resolution'] ?? $resource['label'] ?? $resource['bitrate'] ?? 'Original');
                $typeText = strtolower(implode(' ', [
                    $resource['type'] ?? '',
                    $format,
                    $quality,
                ]));
                $isAudio = strpos($typeText, 'audio') !== false
                    || strpos($typeText, 'mp3') !== false
                    || strpos($typeText, 'm4a') !== false
                    || strpos($typeText, 'kbps') !== false;

                $rawSize = $resource['size'] ?? $resource['filesize'] ?? $resource['file_size'] ?? null;
                if (is_numeric($rawSize)) {
                    $bytes = (float) $rawSize;
                    if ($bytes >= 1073741824) {
                        $size = number_format($bytes / 1073741824, 2) . ' GB';
                    } elseif ($bytes >= 1048576) {
                        $size = number_format($bytes / 1048576, 2) . ' MB';
                    } elseif ($bytes >= 1024) {
                        $size = number_format($bytes / 1024, 2) . ' KB';
                    } else {
                        $size = number_format($bytes, 0) . ' B';
                    }
                } else {
                    $size = $rawSize ?: 'Size varies';
                }

                $downloadUrl = $resource['download_url']
                    ?? $resource['downloadUrl']
                    ?? $resource['download']
                    ?? $resource['url']
                    ?? $resource['link']
                    ?? $resource['src']
                    ?? null;

                $prepareToken = null;
                if ($allowPreparedFormats && !$downloadUrl && !empty($resource['resource_content'])) {
                    $prepareToken = \Illuminate\Support\Str::random(48);
                    Cache::put('plugin_prepare:' . $prepareToken, [
                        'request' => $resource['resource_content'],
                    ], now()->addMinutes(30));
                }

                return [
                    'category' => $isAudio ? 'audio' : 'video',
                    'format' => $isAudio && $format === 'AUDIO' ? 'MP3' : $format,
                    'quality' => $quality,
                    'size' => $size,
                    'download_url' => $downloadUrl,
                    'prepare_token' => $prepareToken,
                ];
            })->values()->all();

            $resultData = [
                'url' => $data['video_url'],
                'host' => $cleanHost,
                'platform' => $platform['name'] ?? 'Supported public source',
                'title' => $videoData['title'] ?? 'Unknown Title',
                'thumbnail' => $videoData['thumbnail'] ?? null,
                'duration' => $videoData['duration'] ?? 0,
                'resources' => $resources,
            ];

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'html' => view('partials.result', ['result' => $resultData])->render(),
                ]);
            }

            return redirect()->route('home')->with('result', $resultData);
        }
    } catch (\Exception $e) {
        // Log or handle exception
    }

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'success' => false,
            'error' => 'Failed to retrieve video data. It might be private or unsupported.'
        ]);
    }

    return redirect()->route('home')->withErrors(['video_url' => 'Failed to retrieve video data. It might be private or unsupported.']);
})->name('analyze');

Route::get('/prepare-plugin-download', function (Request $request) {
    $token = (string) $request->query('token', '');
    $cached = Cache::get('plugin_prepare:' . $token);
    abort_unless(is_array($cached) && !empty($cached['request']), 410);

    $response = Http::retry(2, 500)->timeout(300)->get(
        'https://plugin.vidssave.com/api/sse',
        ['request' => $cached['request']]
    );
    abort_unless($response->successful(), 502);

    preg_match('/event:\s*success\s*[\r\n]+data:\s*(\{[^\r\n]+\})/', $response->body(), $matches);
    $event = isset($matches[1]) ? json_decode($matches[1], true) : null;
    $downloadLink = $event['download_link'] ?? null;
    abort_unless($downloadLink && filter_var($downloadLink, FILTER_VALIDATE_URL), 502);

    Cache::forget('plugin_prepare:' . $token);
    $encodedSource = rtrim(strtr(base64_encode($downloadLink), '+/', '-_'), '=');
    $filename = basename((string) $request->query('name', 'video.mp4'));

    return response()->json([
        'download_url' => URL::temporarySignedRoute('media.download', now()->addMinutes(20), [
            'source' => $encodedSource,
            'name' => $filename,
        ]),
    ]);
})->name('plugin.prepare')->middleware('signed');

Route::get('/download-file', function (Request $request) {
    $encodedSource = (string) $request->query('source', '');
    $padding = (4 - (strlen($encodedSource) % 4)) % 4;
    $source = base64_decode(strtr($encodedSource, '-_', '+/') . str_repeat('=', $padding), true);

    if (!$source || !filter_var($source, FILTER_VALIDATE_URL)) {
        return response('', 204);
    }
    if (strtolower((string) parse_url($source, PHP_URL_SCHEME)) !== 'https') {
        return response('', 204);
    }

    $host = (string) parse_url($source, PHP_URL_HOST);
    $resolvedIp = gethostbyname($host);
    $isPublicIp = filter_var(
        $resolvedIp,
        FILTER_VALIDATE_IP,
        FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
    );
    if (!$host || $resolvedIp === $host || !$isPublicIp) {
        return response('', 204);
    }

    $filename = basename((string) $request->query('name', 'video.mp4'));
    $filename = preg_replace('/[^A-Za-z0-9._-]+/', '-', $filename) ?: 'video.mp4';

    $client = new \GuzzleHttp\Client([
        'connect_timeout' => 15,
        'timeout' => 0,
        'http_errors' => false,
        'allow_redirects' => [
            'max' => 3,
            'strict' => true,
        ],
    ]);
    try {
        $upstream = $client->request('GET', $source, [
            'stream' => true,
            'headers' => [
                'Accept' => '*/*',
                'User-Agent' => $request->userAgent() ?: 'Mozilla/5.0',
            ],
        ]);
    } catch (\Throwable $exception) {
        return response('', 204);
    }

    if ($upstream->getStatusCode() < 200 || $upstream->getStatusCode() >= 300) {
        return response('', 204);
    }

    $body = $upstream->getBody();
    $headers = [
        'Content-Type' => $upstream->getHeaderLine('Content-Type') ?: 'application/octet-stream',
        'Cache-Control' => 'private, no-store',
    ];
    if ($upstream->hasHeader('Content-Length')) {
        $headers['Content-Length'] = $upstream->getHeaderLine('Content-Length');
    }

    return response()->streamDownload(function () use ($body) {
        while (!$body->eof()) {
            echo $body->read(1024 * 1024);
            if (ob_get_level() > 0) {
                ob_flush();
            }
            flush();
        }
    }, $filename, $headers);
})->name('media.download')->middleware('signed');

// ── Sitemap ───────────────────────────────────────────────────────────────────
Route::get('/sitemap.xml', function () {
    $platforms = \App\Models\Platform::where('status', 'active')->get();
    $blogs = \App\Models\Blog::where('status', 1)->get();
    $legacyBlogs = \App\Models\BlogPost::published()
        ->whereNotIn('slug', $blogs->pluck('slug'))
        ->get();
    $guides = \App\Models\Guide::where('status', 1)->get();
    $staticUrls = [
        ['loc' => route('home'), 'lastmod' => null, 'changefreq' => 'daily', 'priority' => '1.0'],
        ['loc' => route('platforms'), 'lastmod' => null, 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('blog'), 'lastmod' => null, 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('public.faqs'), 'lastmod' => null, 'changefreq' => 'monthly', 'priority' => '0.6'],
        ['loc' => route('privacy'), 'lastmod' => null, 'changefreq' => 'yearly', 'priority' => '0.3'],
        ['loc' => route('terms'), 'lastmod' => null, 'changefreq' => 'yearly', 'priority' => '0.3'],
        ['loc' => route('disclaimer'), 'lastmod' => null, 'changefreq' => 'yearly', 'priority' => '0.3'],
    ];

    return response()->view('sitemap', [
        'staticUrls' => $staticUrls,
        'platforms' => $platforms,
        'blogs' => $blogs,
        'legacyBlogs' => $legacyBlogs,
        'guides' => $guides,
    ])->header('Content-Type', 'application/xml');
});

// ── Catch-all Public Platform Route (Must be last) ────────────────────────────
Route::get('/{slug}/', [PlatformController::class, 'show'])->name('platforms.show');
