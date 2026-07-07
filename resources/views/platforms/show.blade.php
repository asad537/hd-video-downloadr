<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Preload hero image for instant LCP -->
    <link rel="preload" as="image" href="/images/supporteds.webp" type="image/webp" fetchpriority="high">
    <link rel="icon" type="image/svg+xml" href="/images/home/Favicon.svg">
    <link rel="apple-touch-icon" href="/images/home/Favicon.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $platform->meta_title ?: $platform->name . ' - Video Saver' }}</title>
    <meta name="description" content="{{ $platform->meta_description }}">
    @if($platform->meta_keywords)
    <meta name="keywords" content="{{ $platform->meta_keywords }}">
    @endif
    @if($platform->meta_robots)
    <meta name="robots" content="{{ $platform->meta_robots }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- JSON-LD Schemas for Platform Page -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "https://hdvideodownloader.online/#organization",
      "name": "HD Video Downloader",
      "alternateName": [
        "HDVideoDownloader",
        "HD Video DL",
        "HDVDownloader"
      ],
      "url": "https://hdvideodownloader.online/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://hdvideodownloader.online/images/Logo_Website.png"
      },
      "description": "HD Video Downloader is a free online video downloader that lets users download videos, reels, shorts, and audio clips in MP4 or MP3 format from platforms like YouTube, TikTok, Facebook, Instagram, and more."
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "HD Video Downloader",
      "alternateName": [
        "HDVideoDownloader",
        "HD Video DL",
        "HDVDownloader"
      ],
      "url": "https://hdvideodownloader.online/",
      "description": "HD Video Downloader is a free online video downloader that lets users download videos, reels, shorts, and audio clips in MP4 or MP3 format from platforms like YouTube, TikTok, Facebook, Instagram, and more.",
      "publisher": {
        "@id": "https://hdvideodownloader.online/#organization"
      }
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
          "item": "https://hdvideodownloader.online/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "{{ $platform->name }} Video Downloader",
          "item": "https://hdvideodownloader.online/{{ $platform->slug }}/"
        }
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "SoftwareApplication",
      "name": "HD Video Downloader",
      "alternateName": [
        "HDVideoDownloader",
        "HD Video DL",
        "HDVDownloader"
      ],
      "description": "HD Video Downloader is a free online video downloader that lets users download videos, reels, shorts, and audio clips in MP4 or MP3 format from platforms like YouTube, TikTok, Facebook, Instagram, and more.",
      "operatingSystem": "Windows, macOS, Linux, Android, iOS",
      "applicationCategory": "MultimediaApplication",
      "url": "https://hdvideodownloader.online/",
      "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "USD"
      },
      "publisher": {
        "@id": "https://hdvideodownloader.online/#organization"
      }
    }
    </script>
    @if(count($faqs) > 0)
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "name": "Frequently Asked Questions - {{ $platform->name }}",
      "url": "{{ url('/' . $platform->slug) }}/",
      "publisher": {
        "@id": "https://hdvideodownloader.online/#organization"
      },
      "mainEntity": [
        @foreach($faqs as $index => $faq)
        {
          "@type": "Question",
          "name": "{{ strip_tags($faq->question) }}",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "{{ strip_tags($faq->answer) }}"
          }
        }{{ !$loop->last ? ',' : '' }}
        @endforeach
      ]
    }
    </script>
    @endif

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
        .platform-brand-name {
            color: #fff;
            font-weight: 800;
            font-size: 1.2rem;
            letter-spacing: -0.5px;
        }
        .platform-brand-name span { color: #39e1b6; }
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
        .platform-nav-links a.active { color: #39e1b6; }

        /* ── Desktop Mega Menu Styles ── */
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
            transition: all 0.18s ease;
            border: 1px solid transparent;
            text-transform: none;
            letter-spacing: normal;
        }
        .platform-nav-links .mega-item:hover {
            background: rgba(57,225,182,0.08);
            border-color: rgba(57,225,182,0.2);
            color: #fff;
            transform: translateX(3px);
        }
        .mega-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(57,225,182,0.08);
            border: 1px solid rgba(57,225,182,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #39e1b6;
            font-size: 15px;
            flex-shrink: 0;
            transition: background 0.18s, border-color 0.18s;
        }
        .platform-nav-links .mega-item:hover .mega-icon {
            background: rgba(57,225,182,0.16);
            border-color: rgba(57,225,182,0.35);
        }
        .mega-footer {
            border-top: 1px solid rgba(255,255,255,0.06);
            padding-top: 12px;
            text-align: center;
        }
        .platform-nav-links .mega-all-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #39e1b6;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: gap 0.2s;
            text-transform: none;
            letter-spacing: normal;
        }
        .platform-nav-links .mega-all-link:hover { gap: 10px; color:#fff; }
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
        .platform-nav-links .mega-child-item { padding: 8px 12px; border-radius: 8px; }
        .platform-nav-links .mega-child-item .mega-icon { width: 26px; height: 26px; font-size: 12px; border-radius: 7px; }
        /* ── Dark Hero ── */
        .platform-hero {
            background:
                radial-gradient(circle at 20% 50%, rgba(57,225,182,0.12) 0%, transparent 40%),
                radial-gradient(circle at 80% 20%, rgba(96,165,250,0.08) 0%, transparent 35%),
                linear-gradient(180deg, #0d1219 0%, #090c11 100%);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 80px 0 90px;
            text-align: center;
        }
        .platform-hero-wrap {
            max-width: 760px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .platform-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(57,225,182,0.08);
            border: 1px solid rgba(57,225,182,0.25);
            color: #39e1b6;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 7px 16px;
            border-radius: 999px;
            margin-bottom: 1.5rem;
        }
        .platform-hero h1 {
            font-size: clamp(36px, 6vw, 64px);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 1.2rem;
        }
        .platform-hero p {
            font-size: 1.1rem;
            color: #a0aaba;
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto;
        }

        /* ── Dark Downloader & Trust Bar ── */
        .download-panel-wrap { margin-top: -30px; position: relative; z-index: 10; margin-bottom: 50px; }
        .download-panel {
            max-width: 900px; margin: 0 auto; padding: 10px;
            border: 1px solid rgba(255,255,255,0.06); border-radius: 18px;
            background: rgba(13,17,23,0.98);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.03);
        }
        .download-panel.has-result { max-width: 1120px; }
        .url-form { display: grid; gap: 8px; grid-template-columns: 1fr; }
        .url-form input {
            min-height: 62px; padding: 18px 20px;
            border: 1px solid rgba(255,255,255,0.05); border-radius: 12px;
            background: rgba(255,255,255,0.02); color: #fff;
        }
        .url-form input::placeholder { color: #687386; }
        .url-form input:hover { background: #0d131a; border-color: #394555; }
        .url-form input:focus { color: #fff; background: #0b1016; border-color: #39e1b6; box-shadow: 0 0 0 4px rgba(57,225,182,0.11); outline: none; }
        .button {
            min-width: 165px; min-height: 62px; border-radius: 12px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #39e1b6, #13b98f); color: #04130f; font-weight: 800; font-size: 16px;
            box-shadow: 0 14px 34px rgba(19,185,143,0.22), inset 0 1px 0 rgba(255,255,255,0.4);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .button:hover {
            background: linear-gradient(135deg, #5ce9c5, #20c99d);
            transform: translateY(-1px); box-shadow: 0 18px 40px rgba(19,185,143,0.32);
        }
        .note { color: #7f8a9b; text-align: center; margin-top: 15px; font-size: 13px; }
        
        .platform-strip {
            display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 12px; margin: 34px auto 0;
        }
        .platform-pill {
            display: flex; align-items: center; gap: 8px; padding: 9px 14px;
            border: 1px solid rgba(255,255,255,0.09); border-radius: 999px;
            background: rgba(15,20,27,0.82); color: #c3cad5; font-size: 13px; font-weight: 700;
            box-shadow: 0 10px 28px rgba(0,0,0,0.22), inset 0 1px 0 rgba(255,255,255,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s, border-color 0.2s, color 0.2s;
        }
        .platform-pill:hover {
            color: #fff; border-color: rgba(57,225,182,0.3); background: #151c24;
            transform: translateY(-2px); box-shadow: 0 14px 34px rgba(0,0,0,0.32);
        }
        .platform-dot { width: 28px; height: 28px; display: grid; place-items: center; flex: 0 0 28px; border-radius: 50%; }
        .platform-dot img { width: 15px; height: 15px; display: block; object-fit: contain; }

        .trust-bar {
            border-top: 1px solid #202733; border-bottom: 1px solid #202733;
            background: #0d1117; color: var(--text-dark);
            margin-bottom: 60px;
        }
        .trust-grid { display: grid; grid-template-columns: repeat(3, 1fr); max-width: 1100px; margin: 0 auto; }
        .trust-item { padding: 22px; text-align: center; border-right: 1px solid #202733; }
        .trust-item:last-child { border-right: 0; }
        .trust-item strong { display: block; margin-bottom: 5px; font-size: 15px; color: #fff; }
        .trust-item span { color: #a0aaba; font-size: 13px; }
        
        @media (max-width:860px) {
            .trust-grid { grid-template-columns: 1fr; }
            .trust-item { border-right: 0; border-bottom: 1px solid #202733; padding: 18px 10px; }
            .trust-item:last-child { border-bottom: 0; }
        }
        @media (min-width: 620px) {
            .url-form { grid-template-columns: 1fr auto; }
        }
        @media (max-width: 620px) {
            .platform-strip { justify-content: flex-start; overflow-x: auto; flex-wrap: nowrap; padding: 0 2px 8px; scrollbar-width: none; }
            .platform-strip::-webkit-scrollbar { display: none; }
            .platform-pill { flex: 0 0 auto; }
        }



        .container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* ── Hero ── */
        .hero {
            position: relative;
            width: 100%;
            height: 35vw;
            /* Height scales with width to maintain aspect ratio */
            min-height: 450px;
            max-height: 650px;
            display: flex;
            align-items: center;
            padding: 2vw 0;
            overflow: hidden;
            background-color: #fff5f6;
        }

        /* BG image — Exactly like homepage */
        .hero-bg-img {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center right;
            z-index: 0;
        }

        .hero picture {
            display: block;
            line-height: 0;
        }

        .hero-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 2;
        }

        .hero-content {
            max-width: 45%;
            margin-top: 110px;
        }

        .hero h1 {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #111827;
            margin-bottom: 2rem;
        }

        .hero-subtext {
            font-size: 1.05rem;
            color: #111827;
            line-height: 1.5;
            margin-bottom: 2.5rem;
            max-width: 600px;
            font-weight: 500;
        }

        .hero-mobile-title,
        .hero-mobile-actions {
            display: none;
        }

        @media (max-width: 1024px) {
            .hero {
                text-align: center;
                padding: 8rem 0 300px 0;
                height: auto;
                min-height: 600px;
            }

            .hero-bg-img {
                object-position: center bottom;
                object-fit: contain;
            }

            .hero-content {
                max-width: 100%;
            }

            .hero h1 {
                font-size: 2.2rem;
            }
        }

        /* ── Search Section ── */
        @media (max-width: 768px) {
            .hero {
                display: block;
                height: auto;
                min-height: 0;
                max-height: none;
                padding: 0 0 1.35rem;
                margin-top: 84px;
                overflow: hidden;
                background: #fff;
                text-align: center;
            }

            .hero-bg-img {
                position: relative;
                top: auto;
                right: auto;
                display: block;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center top;
                z-index: 0;
            }

            .hero picture {
                height: clamp(500px, 102vw, 590px);
                overflow: hidden;
            }

            .hero-container {
                max-width: 620px;
                padding: 0 2rem;
            }

            .hero-content {
                max-width: 100%;
                margin: 1.25rem auto 0;
            }

            .hero-kicker,
            .hero-desktop-title {
                display: none !important;
            }

            .hero-mobile-title,
            .hero-mobile-actions {
                display: block;
            }

            .hero h1 {
                font-size: clamp(2rem, 5.9vw, 2.35rem);
                font-weight: 800;
                line-height: 1.2;
                color: #000;
                margin: 0 auto 1.25rem;
                max-width: 500px;
                text-align: center;
            }

            .hero-subtext {
                font-size: clamp(1.12rem, 4.1vw, 1.5rem);
                line-height: 1.55;
                color: #000;
                max-width: 530px;
                margin: 0 auto 1.65rem;
                font-weight: 400;
                text-align: center;
            }

            .hero-mobile-actions {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: clamp(0.85rem, 3vw, 1.25rem);
                width: 100%;
                margin: 0 auto;
            }

            .hero-mobile-pill {
                min-height: 50px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.55rem;
                padding: 0.75rem 0.65rem;
                border-radius: 999px;
                background: #fff;
                color: #000;
                font-size: clamp(0.95rem, 3.2vw, 1.13rem);
                font-weight: 800;
                line-height: 1;
                box-shadow: 0 5px 14px rgba(15, 23, 42, 0.13);
                white-space: nowrap;
            }

            .hero-mobile-pill i {
                color: #FFB800;
                font-size: clamp(1.05rem, 3.6vw, 1.3rem);
            }
        }

        @media (max-width: 430px) {
            .hero {
                margin-top: 78px;
            }

            .hero-container {
                padding: 0 1.45rem;
            }

            .hero-content {
                margin-top: 1.05rem;
            }

            .hero-subtext {
                margin-bottom: 1.35rem;
            }

            .hero-mobile-actions {
                gap: 0.65rem;
            }

            .hero-mobile-pill {
                min-height: 46px;
                padding: 0.65rem 0.4rem;
                gap: 0.42rem;
            }
        }

        /* ── Platform Content ── */
        .content-section {
            padding: 0rem 0 2rem;
            background: #090c11; /* Match page bg */
        }
        
        .editor-content {
            max-width: 820px;
            margin: 0 auto;
            color: #a0aaba !important;
            font-size: 1.05rem;
            line-height: 1.8;
            padding: 0 2rem;
        }

        .editor-content h2 {
            margin: 42px 0 14px !important;
            color: #fff !important;
            font-size: 28px !important;
            line-height: 1.25 !important;
            font-weight: 800 !important;
        }

        .editor-content h3 {
            margin: 32px 0 14px !important;
            color: #fff !important;
            font-size: 22px !important;
            line-height: 1.3 !important;
            font-weight: 700 !important;
        }

        .editor-content p {
            margin: 0 0 20px !important;
            color: #a0aaba !important;
        }

        .editor-content ul, .editor-content ol {
            display: grid;
            gap: 12px;
            margin: 22px 0 30px !important;
            padding: 0 !important;
            list-style: none !important;
        }

        .editor-content li {
            position: relative;
            padding: 16px 18px 16px 48px !important;
            border: 1px solid rgba(255,255,255,0.07) !important;
            border-radius: 8px !important;
            color: #e2e8f0 !important;
            background: rgba(255,255,255,0.03) !important;
            margin: 0 !important;
        }

        .editor-content li::before {
            content: '✓' !important;
            position: absolute !important;
            left: 18px !important;
            top: 15px !important;
            color: #39e1b6 !important;
            font-weight: 900 !important;
        }
        
        .editor-content a {
            color: #39e1b6;
            text-decoration: none;
        }
        
        .editor-content a:hover {
            text-decoration: underline;
        }


        /* --- Shared UI CSS --- */

        .why-choose-section {
            padding: 3rem 0;
            background: #ffffff;
        }

        .why-choose-container {
            max-width: 1050px;
        }

        .why-choose-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .why-choose-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0F0F0F;
            margin-bottom: 0.75rem;
            letter-spacing: -0.02em;
        }

        .why-choose-desc {
            font-size: 0.93rem;
            color: #000;
            max-width: 620px;
            margin: 0 auto;
            line-height: 1.75;
            text-align: center !important;
        }

        .why-choose-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.2rem;
        }

        .why-choose-card {
            background: #ffffff;
            border: 1.5px solid #FFB800;
            border-radius: 18px;
            padding: 1.5rem 1.8rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .why-choose-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(255, 184, 0, 0.15);
        }

        .why-choose-icon {
            width: 60px;
            height: 60px;
            background: #FEF3C7;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .why-choose-icon img {
            width: 35px;
            height: 35px;
            object-fit: contain;
        }

        .why-choose-card span.why-choose-card-title {
            display: block;
            font-size: 1.2rem;
            font-weight: 700;
            color: #0F172A;
            margin-bottom: 0.45rem;
            text-align: left !important;
        }

        .why-choose-card p {
             font-size: 1rem !important;
            color: #000;
            line-height: 1.45;
            margin: 0;
            text-align: left !important;
        }

        @media (max-width: 991px) {
            .why-choose-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .why-choose-section {
                padding: 2rem 0;
            }

            .why-choose-header {
                margin-bottom: 1.4rem;
                text-align: left;
            }

            .why-choose-title {
                font-size: 1.35rem;
                margin-bottom: 0.6rem;
            }

            .why-choose-desc {
                max-width: 100%;
                margin: 0;
                font-size: 0.92rem;
                line-height: 1.6;
                text-align: left !important;
            }

            .why-choose-grid {
                grid-template-columns: 1fr;
                gap: 0.95rem;
            }

            .why-choose-card {
                border-radius: 16px;
                padding: 1.25rem 1.2rem;
            }
        }
    </style>
<style>h1{font-size:3rem !important;}h2{font-size:2rem !important;}h3{font-size:1.5rem !important;}p{font-size:1.2rem !important;}</style>
</head>

<body>
    @include('partials.navbar')

    <!-- Dark Header — matches homepage style -->
    <!-- Hero Section — dark homepage style -->
    <section class="platform-hero">
        <div class="platform-hero-wrap">
            <span class="platform-hero-badge"><i class="fas fa-rocket"></i> Supported Platforms</span>
            <h1>{{ $platform->h1 ?: $platform->name . ' Video Downloader' }}</h1>
            <p>{{ $platform->description ?: 'Download ' . $platform->name . ' videos, reels and audio clips in HD quality — fast, free and easy.' }}</p>
        </div>
    </section>
    <div class="download-panel-wrap">
        <div class="download-panel {{ isset($result) && $result ? 'has-result' : '' }}">
            <form class="url-form" method="POST" action="{{ route('analyze') }}" id="analyze-form">
                @csrf
                <input id="video-url-input" name="video_url" type="url" value="{{ old('video_url') }}" placeholder="Paste a video URL here" aria-label="Video URL" required>
                <button id="analyze-btn" class="button" type="submit">
                    <svg style="display:inline-block;vertical-align:middle;margin-right:8px;flex-shrink:0" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Download</span>
                </button>
            </form>
            @error('video_url')<div class="error" id="error-container" style="color:#ef4444;text-align:center;margin-top:10px;">{{ $message }}</div>@else<div id="error-container" class="error" style="display:none;color:#ef4444;text-align:center;margin-top:10px;"></div>@enderror
            <div id="result-container">
                @if (isset($result) && $result)
                    @include('partials.result', ['result' => $result])
                @else

                @endif
            </div>
        </div>
        
        <div class="platform-strip" aria-label="Popular supported platforms">
            @php
                $hardcodedPlatforms = [
                    ['name' => 'YouTube', 'domain' => 'youtube.com', 'accent' => '#ff3b30', 'icon' => 'youtube', 'slug' => 'youtube'],
                    ['name' => 'Facebook', 'domain' => 'facebook.com', 'accent' => '#1877f2', 'icon' => 'facebook', 'slug' => 'facebook'],
                    ['name' => 'Instagram', 'domain' => 'instagram.com', 'accent' => '#e1306c', 'icon' => 'instagram', 'slug' => 'instagram'],
                    ['name' => 'TikTok', 'domain' => 'tiktok.com', 'accent' => '#00b9d8', 'icon' => 'tiktok', 'slug' => 'tiktok'],
                    ['name' => 'Twitter / X', 'domain' => 'x.com', 'accent' => '#111827', 'icon' => 'x', 'slug' => 'twitter'],
                    ['name' => 'Vimeo', 'domain' => 'vimeo.com', 'accent' => '#1ab7ea', 'icon' => 'vimeo', 'slug' => 'vimeo'],
                ];
            @endphp
            @foreach ($hardcodedPlatforms as $p)
                <a href="{{ route('platforms.show', $p['slug']) }}/" style="text-decoration:none;">
                    <span class="platform-pill">
                        <span class="platform-dot" style="background:{{ $p['accent'] }}">
                            <img src="https://cdn.simpleicons.org/{{ $p['icon'] }}/ffffff" alt="{{ $p['name'] }}" loading="lazy" onerror="this.style.display='none'">
                        </span>
                        {{ $p['name'] }}
                    </span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="trust-bar">
        <div class="trust-grid">
            <div class="trust-item"><strong>Fast link analysis</strong><span>Get available formats in seconds</span></div>
            <div class="trust-item"><strong>No installation</strong><span>Works directly in your browser</span></div>
            <div class="trust-item"><strong>HD quality</strong><span>Choose the best available resolution</span></div>
        </div>
    </div>
    @if(!empty($platform->content))
        <section class="content-section">
            <div class="container">
                <div class="editor-content" id="platformContent">
                    {!! App\Models\Blog::renderEditorJS($platform->content) !!}
                    <div class="read-more-wrapper" style="text-align:left; margin-top: 2rem;">
                        <button id="readMoreBtn" class="platform-read-more">Read More</button>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            .platform-read-more {
                background: linear-gradient(135deg, #39e1b6, #13b98f);
                color: #04130f;
                border: none;
                padding: 10px 24px;
                border-radius: 30px;
                font-weight: 800;
                font-size: 14px;
                cursor: pointer;
                transition: transform 0.2s, box-shadow 0.2s;
                box-shadow: 0 8px 24px rgba(57,225,182,0.25);
                display: none;
            }
            .platform-read-more:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 30px rgba(57,225,182,0.35);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const content = document.getElementById('platformContent');
                const btn = document.getElementById('readMoreBtn');
                
                if (content) {
                    const children = Array.from(content.children).filter(child => !child.classList.contains('read-more-wrapper'));
                    // 3 elements usually covers 1 Heading + 2 Paragraphs
                    if (children.length > 3) {
                        for (let i = 3; i < children.length; i++) {
                            children[i].style.display = 'none';
                            children[i].classList.add('hidden-content');
                        }
                        btn.style.display = 'inline-block';
                        
                        btn.addEventListener('click', function() {
                            const hiddenEls = content.querySelectorAll('.hidden-content');
                            if (btn.innerText === 'Read More') {
                                hiddenEls.forEach(el => el.style.display = '');
                                btn.innerText = 'Read Less';
                            } else {
                                hiddenEls.forEach(el => el.style.display = 'none');
                                btn.innerText = 'Read More';
                                content.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            }
                        });
                    }
                }
            });
        </script>
    @endif

   
        </div>
    </section>

    @if(count($faqs) > 0)
        <section class="platform-faq-section">
            <div class="platform-faq-wrap">
                <div class="platform-faq-header">
                    <h2>Frequently Asked <span>Questions</span></h2>
                    <p>Everything you need to know about downloading {{ $platform->name }} videos</p>
                </div>
                <div class="platform-faq-list">
                    @foreach ($faqs as $faq)
                    <details class="platform-faq-item" name="platform_faq">
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
            </div>
        </section>
        <style>
            .platform-faq-section {
                background: #090c11;
                padding: 80px 0 100px;
                border-top: 1px solid rgba(255,255,255,0.05);
            }
            .platform-faq-wrap {
                max-width: 820px;
                margin: 0 auto;
                padding: 0 2rem;
            }
            .platform-faq-header {
                text-align: center;
                margin-bottom: 3rem;
            }
            .platform-faq-header h2 {
                font-size: clamp(28px, 4vw, 40px);
                font-weight: 800;
                color: #fff;
                margin-bottom: 12px;
                line-height: 1.2;
            }
            .platform-faq-header h2 span { color: #39e1b6; }
            .platform-faq-header p {
                color: #a0aaba;
                font-size: 1rem;
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
    @endif



    @include('partials.footer')

    <script>
        const input = document.getElementById('videoUrl');
        const fetchBtn = document.getElementById('fetchBtn');
        const loader = document.getElementById('loader');
        const resultsBox = document.getElementById('results');
        const errorDiv = document.getElementById('error');
        const csrf = document.querySelector('meta[name="csrf-token"]').content;

        async function fetchVideo(url) {
            if (!url) return;
            loader.style.display = 'block';
            resultsBox.style.display = 'none';
            errorDiv.style.display = 'none';

            try {
                const res = await fetch('/extract', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: JSON.stringify({ url })
                });
                const data = await res.json();
                if (data.error) throw new Error(data.error);
                renderResults(data);
            } catch (e) {
                errorDiv.textContent = e.message;
                errorDiv.style.display = 'block';
            } finally {
                loader.style.display = 'none';
            }
        }

        fetchBtn.addEventListener('click', () => fetchVideo(input.value.trim()));
        input.addEventListener('keydown', e => { if (e.key === 'Enter') fetchVideo(input.value.trim()); });

        function renderResults(data) {
            const videoMedias = data.medias.filter(m => m.type === 'video');
            const audioMedias = data.medias.filter(m => m.type === 'audio');

            function renderRow(m, title) {
                const dlUrl = `/proxy-download?url=${encodeURIComponent(m.url)}&title=${encodeURIComponent(title)}&ext=${m.extension}`;
                return `
                    <div style="display:grid; grid-template-columns: 60px 80px 100px 1fr; align-items:center; background:#fff; padding:12px 0; border-bottom:1px solid #F3F4F6;">
                        <span style="background:#00C853; color:#fff; padding:4px 0; border-radius:5px; font-size:0.75rem; font-weight:800; text-align:center; width:50px;">${m.extension.toUpperCase()}</span>
                        <span style="font-weight:700; color:#111827; font-size:0.9rem;">${m.quality}</span>
                        <span style="color:#000; font-size:0.85rem; font-weight:600;">${m.size || ''}</span>
                        <a href="${dlUrl}" style="background:#fff; color:#000; border:2px solid #FFB800; text-decoration:none; padding:8px 22px; border-radius:10px; font-weight:700; font-size:0.85rem; display:flex; align-items:center; gap:10px; transition:0.2s; width:fit-content; justify-self:end;">
                            <i class="fas fa-download" style="color:#FFB800; font-size:0.95rem;"></i> Download
                        </a>
                    </div>
                `;
            }

            let html = `
                <div style="display:flex; gap:40px; flex-wrap:wrap; align-items:flex-start; text-align:left;">
                    <!-- Sidebar -->
                    <div style="width: 280px; flex-shrink: 0;">
                        <div style="width:100%; aspect-ratio:16/9; border-radius:12px; overflow:hidden; margin-bottom:15px; background:#f3f4f6;">
                            <img src="/thumbnail-proxy?url=${encodeURIComponent(data.thumbnail)}" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <h3 style="font-weight:700; font-size:1.05rem; margin-bottom:15px; line-height:1.4; color:#111827;">${data.title}</h3>
                        <span style="background:#FFE082; color:#000; padding:6px 14px; border-radius:10px; font-weight:800; font-size:0.85rem; display:inline-flex; align-items:center; gap:8px;">
                            <i class="far fa-clock"></i> ${data.duration || '00:00'}
                        </span>
                    </div>

                    <!-- Content Area -->
                    <div style="flex:1; min-width:300px;">
                        <!-- Video Section -->
                        <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px; border-bottom:2px solid #F3F4F6; padding-bottom:10px;">
                            <i class="fas fa-film" style="color:#FFB800; font-size:1.3rem;"></i>
                            <h4 style="font-weight:800; font-size:1.3rem; color:#111827;">Video</h4>
                        </div>
                        <div style="display:flex; flex-direction:column; margin-bottom:35px;">
                            ${videoMedias.length ? videoMedias.map(m => renderRow(m, data.title)).join('') : '<p style="color:#000; font-size:0.9rem; line-height: 1.45;">No video formats available.</p>'}
                        </div>

                        <!-- Music Section -->
                        <div style="display:flex; align-items:center; gap:12px; margin-bottom:10px; border-bottom:2px solid #F3F4F6; padding-bottom:10px;">
                            <i class="fas fa-music" style="color:#FFB800; font-size:1.3rem;"></i>
                            <h4 style="font-weight:800; font-size:1.3rem; color:#111827;">Music</h4>
                        </div>
                        <div style="display:flex; flex-direction:column;">
                            ${audioMedias.length ? audioMedias.map(m => renderRow(m, data.title)).join('') : '<p style="color:#000; font-size:0.9rem; line-height: 1.45;">No audio formats available.</p>'}
                        </div>
                    </div>
                </div>
            `;

            resultsBox.innerHTML = html;
            resultsBox.style.display = 'block';
        }

        // Auto-Hide Google Translate Banner
        setInterval(function () {
            const banner = document.querySelector('.goog-te-banner-frame');
            if (banner) banner.remove();
            document.body.style.top = '0px';
        }, 500);
    </script>
</body>

</html>







