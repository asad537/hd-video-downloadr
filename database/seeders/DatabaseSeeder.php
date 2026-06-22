<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(['email' => 'admin@hdvideodownloader.com'], [
            'name' => 'HDVideoDownloader Admin',
            'password' => Hash::make('Admin@12345'),
        ]);

        $images = [
            'Formats' => '/images/blog/formats-codecs.png',
            'Video Quality' => '/images/blog/formats-codecs.png',
            'HD Video' => '/images/blog/downloader-general.png',
            'YouTube' => '/images/blog/platform-guides.png',
            'TikTok' => '/images/blog/platform-guides.png',
            'Instagram' => '/images/blog/platform-guides.png',
            'Facebook' => '/images/blog/platform-guides.png',
            'X / Twitter' => '/images/blog/platform-guides.png',
            'Vimeo' => '/images/blog/platform-guides.png',
            'Safety' => '/images/blog/safe-downloads.png',
            'Devices' => '/images/blog/devices-playback.png',
            'Troubleshooting' => '/images/blog/downloader-general.png',
            'How To' => '/images/blog/downloader-general.png',
            'Productivity' => '/images/blog/devices-playback.png',
        ];

        foreach (config('blog') as $index => $post) {
            $tips = collect($post['tips'])->map(function ($tip) { return '<li>' . e($tip) . '</li>'; })->implode('');
            $content = '<p>' . e($post['description']) . '</p>'
                . '<h2>What you should know first</h2><p>The available result depends on the original public upload, the formats exposed by the source, and playback support on your device. Start with the complete public video URL and choose a direct format that matches your screen and storage needs.</p>'
                . '<h2>Practical recommendations</h2><ul>' . $tips . '</ul>'
                . '<h2>Quality and compatibility</h2><p>MP4 is usually the simplest choice across phones, laptops, tablets, and televisions. Higher resolution can preserve more detail, but it also requires more storage. Always preview a saved file before removing another copy.</p>'
                . '<h2>Responsible downloading</h2><p>Download only content you own or have permission to save. Public access does not automatically grant permission to republish, redistribute, or remove creator attribution.</p>';

            BlogPost::updateOrCreate(['slug' => $post['slug']], [
                'title' => $post['title'], 'category' => $post['category'], 'excerpt' => $post['excerpt'],
                'meta_title' => $post['title'], 'meta_description' => $post['description'], 'content' => $content,
                'image' => $images[$post['category']] ?? '/images/blog/downloader-general.png',
                'image_alt' => $post['title'] . ' illustrated guide', 'read_minutes' => (int) $post['read'],
                'is_published' => true, 'published_at' => now()->subDays(29 - $index),
            ]);
        }

        foreach ([
            'site_name' => 'HDVideoDownloader',
            'hero_title' => 'Free All Video Downloader',
            'hero_subtitle' => 'Download videos, reels, shorts, and audio from your favorite platforms. Paste a public video link below to get started.',
            'default_meta_description' => 'Download public videos in available HD formats with HDVideoDownloader.',
        ] as $key => $value) SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
