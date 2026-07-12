<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SeoHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $path = trim($request->path(), '/');

        if ($request->is('admin', 'admin/*', 'analyze', 'download-file', 'prepare-plugin-download')) {
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        }

        if ($path === 'sitemap.xml') {
            $response->headers->set('Cache-Control', 'public, max-age=3600');
        }

        return $response;
    }
}
