<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Preload hero image for instant LCP -->
    <link rel="preload" as="image" href="/images/faqs.webp" type="image/webp" fetchpriority="high">
    <link rel="icon" type="image/webp" href="/images/Fav-logo.webp">
    <link rel="apple-touch-icon" href="/images/logofinal.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $seo = \App\Models\PageSeo::getFor('faqs'); @endphp
    <title>{{ $seo->meta_title ?? ($settings->faq_meta_title ?? 'Frequently Asked Questions — Video Saver') }}</title>
    @if($seo && $seo->meta_description)
    <meta name="description" content="{{ $seo->meta_description }}">
    @else
    <meta name="description" content="{{ $settings->faq_meta_description ?? '' }}">
    @endif
    @if($seo && $seo->meta_keywords)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @else
    <meta name="keywords" content="{{ $settings->faq_meta_keywords ?? '' }}">
    @endif
    @if($seo && $seo->meta_robots)
    <meta name="robots" content="{{ $seo->meta_robots }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- JSON-LD Schemas for FAQ Page -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Video Saver",
      "alternateName": [
        "HD Video Saver",
        "HDVideoSaver",
        "HVS Downloader"
      ],
      "url": "https://hdvideosaver.com",
      "logo": {
        "@type": "ImageObject",
        "url": "https://hdvideosaver.com/images/logofinal.png"
      },
      "description": "Video Saver is a free online video downloader that lets users download videos, reels, shorts, and audio clips in MP4 or MP3 format from supported platforms.",
      "sameAs": [
        "https://play.google.com/store/apps/details?id=com.jmdsol.videodownloader.videosaver"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "name": "Frequently Asked Questions - Video Saver",
      "url": "https://hdvideosaver.com/faq/",
      "description": "Find answers to frequently asked questions about Video Saver — how it works, supported platforms, troubleshooting, and general usage.",
      "publisher": {
        "@id": "https://hdvideosaver.com/#organization"
      },
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How does this video downloader work?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Video Saver works by fetching the direct media file link from the URL you provide. Once you paste a link, our system analyzes the platform and provides you with various download options in different resolutions and formats."
          }
        },
        {
          "@type": "Question",
          "name": "Do I need to create an account?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No. Video Saver is designed for maximum privacy and convenience. You can download any video without registering, signing up, or providing any personal information."
          }
        },
        {
          "@type": "Question",
          "name": "Is this service free to use?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Absolutely. Our service is 100% free. We sustain the platform through minimal ads to keep the servers running without charging our users."
          }
        },
        {
          "@type": "Question",
          "name": "Which devices are supported?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Video Saver is a web-based tool, meaning it works on any device with a browser. You can use it on Windows, macOS, Android, and iOS (iPhone/iPad)."
          }
        },
        {
          "@type": "Question",
          "name": "Can I download YouTube videos in 4K?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, if the original video is available in 4K, Video Saver will provide you with the option to download it in that resolution."
          }
        },
        {
          "@type": "Question",
          "name": "Does it work with private Instagram profiles?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "For security and privacy reasons, our downloader can only access public content. We do not support downloading videos from private accounts that you do not have permission to view."
          }
        },
        {
          "@type": "Question",
          "name": "Can I download TikTok videos without watermark?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes! One of our most popular features is the ability to download TikTok videos in high quality without any watermark."
          }
        },
        {
          "@type": "Question",
          "name": "Why is my download slow?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Download speed depends on your internet connection and the responsiveness of the original platform's servers. High-resolution videos (4K/1080p) also take longer to process."
          }
        },
        {
          "@type": "Question",
          "name": "The video plays instead of downloading?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "On some browsers (like Chrome or Safari), the video might open in a new tab. Simply right-click the video and select 'Save Video As...' or use the download button provided in the options menu."
          }
        },
        {
          "@type": "Question",
          "name": "Why did my download fail?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "A download might fail if the video has been deleted, is restricted in your region, or if the platform has changed its security settings. Try refreshing the page or using a different browser."
          }
        },
        {
          "@type": "Question",
          "name": "Is there a limit on the number of downloads?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No. You can download an unlimited number of videos and audio files with Video Saver. We do not impose any daily or monthly limits."
          }
        },
        {
          "@type": "Question",
          "name": "What video formats are supported?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We primarily support MP4 for video and MP3 for audio. Depending on the source, you may also see options for WEBM, M4A, and different resolution tiers."
          }
        },
        {
          "@type": "Question",
          "name": "Can I download audio only?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes! For most platforms like YouTube and SoundCloud, Video Saver provides a 'Music' section where you can download the audio track as an MP3 file."
          }
        },
        {
          "@type": "Question",
          "name": "Is it legal to download videos?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Downloading videos for personal, offline viewing is generally considered fair use. However, you should not redistribute or use downloaded content for commercial purposes without permission from the creator."
          }
        },
        {
          "@type": "Question",
          "name": "How do I save videos to my iPhone?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "On iOS, use the Safari browser. After clicking download, the file will go to your 'Downloads' folder in the Files app. You can then move it to your Camera Roll."
          }
        },
        {
          "@type": "Question",
          "name": "Are the downloads safe and secure?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Absolutely. Video Saver does not require any software installation or extensions. All processing happens on our secure servers, and we never store your personal data."
          }
        }
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://hdvideosaver.com"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "FAQ",
          "item": "https://hdvideosaver.com/faq/"
        }
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Video Saver",
      "alternateName": [
        "HD Video Saver",
        "HDVideoSaver",
        "HVS Downloader"
      ],
      "url": "https://hdvideosaver.com",
      "description": "Video Saver is a free online video downloader that lets users download videos, reels, shorts, and audio clips in MP4 or MP3 format from supported platforms.",
      "publisher": {
        "@id": "https://hdvideosaver.com/#organization"
      }
    }
    </script>

        <style>
        :root {
            --primary: #39e1b6;
            --primary-glow: rgba(57,225,182,0.15);
            --text-dark: #f8fafc;
            --text-gray: #a0aaba;
            --bg-dark: #090c11;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-dark);
            overflow-x: hidden;
            top: 0 !important;
        }

        /* ── Dark Header ── */
        .platform-header {
            position: sticky;
            top: 0;
            z-index: 9999;
            background: rgba(9,12,17,0.92);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            backdrop-filter: blur(16px);
            padding: 0.8rem 0;
        }
        .platform-nav {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }
        .platform-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .platform-nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .platform-nav-links a {
            color: #a0aaba;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: color 0.2s;
        }
        .platform-nav-links a:hover,
        .platform-nav-links a.active { color: #fff; }

        /* Desktop Mega Menu */
        .nav-dropdown-wrap { position:relative; display:inline-flex; align-items:center; }
        .dropdown-trigger { color:#a0aaba; font-size:15px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; transition:color .2s; display:inline-flex; align-items:center; gap:4px; cursor:pointer; }
        .nav-dropdown-wrap:hover .dropdown-trigger, .dropdown-trigger.active { color:#fff; }
        .mega-menu {
            display: none;
            position: absolute;
            top: calc(100% + 16px);
            right: -20px;
            left: auto;
            transform: none;
            background: rgba(15, 20, 28, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(57,225,182,0.15);
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
            padding: 20px;
            min-width: 380px;
            z-index: 99999;
        }
        .mega-menu::before {
            content: '';
            position: absolute;
            top: -16px;
            left: 0;
            width: 100%;
            height: 16px;
            background: transparent;
        }
        .nav-dropdown-wrap:hover .mega-menu { display: block; }
        .mega-menu-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            margin-bottom: 12px;
        }
        .platform-nav-links .mega-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: #c3cad5;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
        }
        .platform-nav-links .mega-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
            transform: translateX(3px);
        }
        .platform-nav-links .mega-item .item-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            font-size: 16px;
        }
        /* Sub-Platform Child Menu */
        .platform-nav-links .mega-parent-wrap { position: relative; }
        .platform-nav-links .mega-child-menu {
            display: none;
            position: absolute;
            left: calc(100% + 6px);
            right: auto;
            top: 0;
            min-width: 240px;
            background: rgba(15, 20, 28, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(57,225,182,0.15);
            border-radius: 14px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.55);
            padding: 6px;
            z-index: 999999;
        }
        .platform-nav-links .mega-parent-wrap.has-kids:hover .mega-child-menu { display: block; }
        .platform-nav-links .mega-child-item { padding: 8px 12px; border-radius: 8px; font-size: 12px; }
        .platform-nav-links .mega-child-item .item-icon { width: 22px; height: 22px; font-size: 12px; }
        /* Mobile Hamburger */
        .hamburger { display:none; flex-direction:column; gap:5px; background:none; border:none; cursor:pointer; padding:5px; z-index:100; }
        .hamburger span { display:block; width:24px; height:2px; background:#fff; transition:all 0.3s ease; }
        
        @media (max-width:900px) {
            .platform-nav-links { display:none; }
            .hamburger { display:flex; }
        }

        /* Hero */
        .platform-hero {
            padding: 5rem 2rem 3rem;
            text-align: center;
            position: relative;
        }
        .platform-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 100%; max-width: 800px;
            height: 400px;
            background: radial-gradient(ellipse at top, rgba(57,225,182,0.15) 0%, rgba(9,12,17,0) 70%);
            pointer-events: none;
            z-index: -1;
        }
        .platform-hero-wrap {
            max-width: 800px;
            margin: 0 auto;
        }
        .platform-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(57,225,182,0.1);
            border: 1px solid rgba(57,225,182,0.2);
            border-radius: 50px;
            color: #39e1b6;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2rem;
        }
        .platform-hero h1 {
            font-size: clamp(32px, 5vw, 56px);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 1.25rem;
            color: #fff;
        }
        .platform-hero p {
            font-size: clamp(16px, 2vw, 18px);
            color: #a0aaba;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        /* FAQs */
        .platform-faq-wrap {
            max-width: 820px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .platform-faq-header {
            margin-bottom: 1.5rem;
        }
        .platform-faq-header h2 {
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
            line-height: 1.2;
        }
        .platform-faq-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .platform-faq-item {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            overflow: hidden;
            transition: border-color 0.25s ease, background 0.25s ease;
        }
        .platform-faq-item:hover {
            border-color: rgba(57,225,182,0.2);
            background: rgba(57,225,182,0.03);
        }
        .platform-faq-item[open] {
            border-color: rgba(57,225,182,0.3);
            background: rgba(57,225,182,0.04);
        }
        .platform-faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            cursor: pointer;
            list-style: none;
            color: #e2e8f0;
            font-weight: 700;
            font-size: 1rem;
            user-select: none;
        }
        .platform-faq-question::-webkit-details-marker { display: none; }
        .platform-faq-item[open] .platform-faq-question { color: #39e1b6; }
        .faq-toggle-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }
        .faq-toggle-icon svg {
            width: 14px;
            height: 14px;
            stroke: #a0aaba;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: transform 0.25s ease, stroke 0.25s ease;
        }
        .platform-faq-item[open] .faq-toggle-icon {
            background: rgba(57,225,182,0.12);
            border-color: rgba(57,225,182,0.3);
        }
        .platform-faq-item[open] .faq-toggle-icon svg {
            transform: rotate(180deg);
            stroke: #39e1b6;
        }
        .platform-faq-answer {
            padding: 0 1.5rem 1.5rem;
            color: #a0aaba;
            font-size: 0.95rem;
            line-height: 1.75;
        }
        .platform-faq-answer p { margin: 0; }
    </style>
    <style>h1{font-size:3rem !important;}h2{font-size:2rem !important;}h3{font-size:1.5rem !important;}p{font-size:1.2rem !important;}</style>
</head>

<body>
    @include('partials.navbar')

    <section class="platform-hero" style="margin-bottom: 2rem;">
        <div class="platform-hero-wrap">
            <span class="platform-hero-badge" style="margin-bottom:1.5rem;"><i class="fas fa-question-circle"></i> Find Answers</span>
            <h1>{{ $settings->faq_h1 ?? 'Answers to Your Common Questions' }}</h1>
            <p>{{ $settings->faq_description ?? 'Find everything you need to know about downloading videos, quality settings, and platform support.' }}</p>
        </div>
    </section>

    <main class="platform-faq-wrap" style="padding-bottom: 6rem;">
        @forelse($faqs as $category => $items)
            <div class="platform-faq-header" style="margin-top: 3rem; margin-bottom: 1.5rem; text-align:left;">
                <h2 style="font-size: 24px; margin-bottom:0;">{{ $category }}</h2>
            </div>
            <div class="platform-faq-list">
                @foreach($items as $faq)
                    <details class="platform-faq-item">
                        <summary class="platform-faq-question">
                            <span>{{ $faq->question }}</span>
                            <div class="faq-toggle-icon">
                                <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </summary>
                        <div class="platform-faq-answer">
                            <p>{{ $faq->answer }}</p>
                        </div>
                    </details>
                @endforeach
            </div>
        @empty
            <div style="text-align:center; padding:5rem 0;">
                <i class="fas fa-search" style="font-size:3rem; color:#a0aaba; margin-bottom:1.5rem;"></i>
                <p style="color:#a0aaba; line-height: 1.45;">No FAQs found at the moment.</p>
            </div>
        @endforelse
    </main>

    @include('partials.footer')
</body>

</html>
