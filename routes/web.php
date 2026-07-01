<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use App\Models\BlogPost;
use App\Http\Controllers\AdminController;

$platforms = [
    ['name' => 'YouTube', 'domain' => 'youtube.com', 'accent' => '#ff3b30', 'icon' => 'youtube'],
    ['name' => 'Facebook', 'domain' => 'facebook.com', 'accent' => '#1877f2', 'icon' => 'facebook'],
    ['name' => 'Instagram', 'domain' => 'instagram.com', 'accent' => '#e1306c', 'icon' => 'instagram'],
    ['name' => 'TikTok', 'domain' => 'tiktok.com', 'accent' => '#00b9d8', 'icon' => 'tiktok'],
    ['name' => 'Twitter / X', 'domain' => 'x.com', 'accent' => '#111827', 'icon' => 'x'],
    ['name' => 'Vimeo', 'domain' => 'vimeo.com', 'accent' => '#1ab7ea', 'icon' => 'vimeo'],
    ['name' => 'Dailymotion', 'domain' => 'dailymotion.com', 'accent' => '#00aaff', 'icon' => 'dailymotion'],
    ['name' => 'Pinterest', 'domain' => 'pinterest.com', 'accent' => '#e60023', 'icon' => 'pinterest'],
];

$loadPosts = function () {
    try {
        return BlogPost::published()->latest('published_at')->get()->map(function ($post) {
            return [
        'id' => $post->id,
        'title' => $post->title,
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

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/posts', [AdminController::class, 'savePost'])->name('admin.posts.store');
    Route::put('/posts/{post}', [AdminController::class, 'savePost'])->name('admin.posts.update');
    Route::delete('/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::put('/settings', [AdminController::class, 'saveSettings'])->name('admin.settings');
});

Route::get('/', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page' => 'home',
        'platforms' => $platforms,
        'posts' => $loadPosts(),
        'result' => session('result'),
    ]);
})->name('home');

Route::post('/analyze', function (Request $request) use ($platforms) {
    $data = $request->validate([
        'video_url' => ['required', 'url', 'max:2048'],
    ]);

    $host = parse_url($data['video_url'], PHP_URL_HOST) ?: 'public video link';
    $cleanHost = preg_replace('/^www\./', '', strtolower($host));
    $platform = collect($platforms)->first(function ($item) use ($cleanHost) {
        return strpos($cleanHost, $item['domain']) !== false;
    });

    // Match the Chrome extension: query cache and source, preferring cached direct links.
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

Route::get('/supported-platforms', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page' => 'platforms',
        'platforms' => $platforms,
        'posts' => $loadPosts(),
        'result' => null,
    ]);
})->name('platforms');

Route::get('/blog', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page' => 'blog',
        'platforms' => $platforms,
        'posts' => $loadPosts(),
        'result' => null,
    ]);
})->name('blog');

Route::get('/blog/{slug}', function ($slug) use ($platforms, $loadPosts) {
    $posts = $loadPosts();
    $post = collect($posts)->firstWhere('slug', $slug);
    abort_unless($post, 404);

    return view('welcome', [
        'page' => 'blog-post',
        'platforms' => $platforms,
        'posts' => $posts,
        'post' => $post,
        'relatedPosts' => collect($posts)
            ->where('slug', '!=', $slug)
            ->sortByDesc(function ($item) use ($post) {
                return $item['category'] === $post['category'];
            })
            ->take(3),
        'result' => null,
    ]);
})->name('blog.show');

Route::get('/privacy', function () use ($platforms, $loadPosts) {
    return view('welcome', [
        'page' => 'privacy',
        'platforms' => $platforms,
        'posts' => $loadPosts(),
        'result' => null,
    ]);
})->name('privacy');

Route::get('/sitemap.xml', function () use ($loadPosts) {
    $posts = $loadPosts();
    $latestPostDate = collect($posts)->pluck('published')->filter()->map(function ($date) {
        return date('Y-m-d', strtotime($date));
    })->sortDesc()->first() ?: now()->toDateString();
    $urls = collect([
        ['loc' => route('home'), 'lastmod' => $latestPostDate, 'changefreq' => 'daily', 'priority' => '1.0'],
        ['loc' => route('platforms'), 'lastmod' => $latestPostDate, 'changefreq' => 'weekly', 'priority' => '0.8'],
        ['loc' => route('blog'), 'lastmod' => $latestPostDate, 'changefreq' => 'daily', 'priority' => '0.9'],
        ['loc' => route('privacy'), 'lastmod' => $latestPostDate, 'changefreq' => 'yearly', 'priority' => '0.4'],
    ])->merge(collect($posts)->map(function ($post) {
        return [
            'loc' => route('blog.show', $post['slug']),
            'lastmod' => date('Y-m-d', strtotime($post['published'])),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ];
    }));

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
