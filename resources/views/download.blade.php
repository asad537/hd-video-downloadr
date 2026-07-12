<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Preload hero image for instant LCP -->
    <link rel="preload" as="image" href="/images/downloader.webp" type="image/webp" fetchpriority="high">
    <link rel="icon" type="image/svg+xml" href="/images/home/Favicon.svg">
    <link rel="apple-touch-icon" href="/images/home/Favicon.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php $seo = \App\Models\PageSeo::getFor('download'); @endphp
    <title>{{ $seo->meta_title ?? 'Download Video Saver — Fast & Secure' }}</title>
    @if($seo && $seo->meta_description)
    <meta name="description" content="{{ $seo->meta_description }}">
    @endif
    @if($seo && $seo->meta_keywords)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    @if($seo && $seo->meta_robots)
    <meta name="robots" content="{{ $seo->meta_robots }}">
    @endif
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- JSON-LD Schemas for Download Page -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "HD Video Downloader",
      "alternateName": [
        "HDVideoDownloader",
        "HD Video DL"
      ],
      "url": "https://hdvideodownloader.online/",
      "description": "HD Video Downloader helps users analyze supported public video links and review available media formats.",
      "publisher": {
        "@id": "https://hdvideodownloader.online/#organization"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "@id": "https://hdvideodownloader.online/#organization",
      "name": "HD Video Downloader",
      "alternateName": [
        "HDVideoDownloader",
        "HD Video DL"
      ],
      "url": "https://hdvideodownloader.online/",
      "logo": {
        "@type": "ImageObject",
        "url": "https://hdvideodownloader.online/images/Logo_Website.png"
      },
      "description": "HD Video Downloader helps users analyze supported public video links and review available media formats.",
      "sameAs": [
        "https://play.google.com/store/apps/details?id=com.jmdsol.videodownloader.videosaver"
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
          "item": "https://hdvideodownloader.online/"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Download",
          "item": "https://hdvideodownloader.online/download"
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
        "HD Video DL"
      ],
      "description": "HD Video Downloader helps users analyze supported public video links and review available media formats.",
      "operatingSystem": "Windows, macOS, Linux, Android, iOS",
      "applicationCategory": "MultimediaApplication",
      "url": "https://hdvideodownloader.online/download",
      "downloadUrl": "https://play.google.com/store/apps/details?id=com.jmdsol.videodownloader.videosaver",
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

    <style>
        :root {
            --primary: #FFB800;
            --primary-dark: #FF8C00;
            --secondary: #FF5722;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --bg-light: #F8FAFC;
            --text-dark: #111827;
            --border: #E5E7EB;
            --bg-off: #F9FAFB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background: #fff;
            line-height: 1.6;
            top: 0px !important;
            position: static !important;
        }

        /* ── Hero Redesign ── */
        .platform-hero {
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
            margin-bottom: 4rem;
        }

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

        .platform-hero picture {
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
            margin-top: 70px;
        }

        .platform-hero h1 {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            color: #111827;
            margin-bottom: 2rem;
            text-align: left;
        }

        .hero-subtext {
            font-size: 0.95rem;
            color: #000;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            max-width: 500px;
            text-align: left;
            font-weight: 500;
        }

        .hero-badge-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 800;
            color: #FFB800;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: 1.5px solid #F3F4F6;
        }

        .btn-hero-main {
            display: inline-block;
            background: #FFB800;
            color: #111827;
            padding: 0.7rem 2rem;
            border-radius: 50px;
            font-size: 0.95rem;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(255, 184, 0, 0.3);
            transition: all 0.3s ease;
            margin-bottom: 1.2rem;
        }

        .btn-hero-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 184, 0, 0.4);
            background: #FFA000;
        }

        .hero-footer-badges {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .footer-badge {
            background: #fff;
            border: 1.5px solid #F1F5F9;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #111827;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .footer-badge i {
            color: #FFB800;
            font-size: 0.9rem;
        }

        /* ── Instruction Section ── */
        .container {
            max-width: 1000px;
            margin: 4rem auto;
            padding: 0 1.5rem;
        }

        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 800;
            color: #000;
            margin-bottom: 3rem;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .step-card {
            background: #fff;
            padding: 2.5rem 1.5rem;
            border-radius: 20px;
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        .step-num {
            width: 45px;
            height: 45px;
            background: var(--primary);
            color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            margin: 0 auto 1.5rem;
            font-size: 1.2rem;
        }

        .step-card h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #000;
        }

        .step-card p {
            font-size: 0.95rem;
            color: #000;
            line-height: 1.45;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .platform-hero {
                display: block;
                height: auto;
                min-height: 0;
                max-height: none;
                padding: 0 0 1.35rem;
                margin: 84px 0 2rem;
                overflow: hidden;
                background: #fff;
                border-bottom-left-radius: 0;
                border-bottom-right-radius: 0;
                text-align: center;
            }

            .hero-bg-img {
                position: relative;
                top: auto;
                right: auto;
                display: block;
                width: 100%;
                height: auto;
                object-fit: contain;
                object-position: center top;
                z-index: 0;
            }

            .platform-hero .hero-container {
                max-width: 620px;
                padding: 0 2rem;
            }

            .hero-content {
                max-width: 100%;
                margin: 1.35rem auto 0;
            }

            .hero-badge-main,
            .btn-hero-main {
                display: none;
            }

            .platform-hero h1 {
                font-size: clamp(1.45rem, 6vw, 1.75rem);
                font-weight: 800;
                line-height: 1.16;
                color: #000;
                margin: 0 auto 1.45rem;
                max-width: 470px;
                text-align: center;
            }

            .hero-subtext {
                font-size: clamp(1.15rem, 4.15vw, 1.55rem);
                line-height: 1.48;
                color: #000;
                max-width: 515px;
                margin: 0 auto 1.9rem;
                font-weight: 400;
                text-align: center;
            }

            .hero-footer-badges {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: clamp(0.9rem, 3.2vw, 1.25rem);
                width: 100%;
                margin: 0 auto;
            }

            .footer-badge {
                min-height: 50px;
                justify-content: center;
                gap: 0.65rem;
                padding: 0.75rem 0.65rem;
                border: 0;
                border-radius: 999px;
                background: #fff;
                color: #000;
                font-size: clamp(0.95rem, 3.2vw, 1.13rem);
                font-weight: 800;
                box-shadow: 0 5px 14px rgba(15, 23, 42, 0.13);
                white-space: nowrap;
            }

            .footer-badge i {
                color: #FFB800;
                font-size: clamp(1.05rem, 3.6vw, 1.35rem);
            }

            .dl-icon-main {
                font-size: 2.5rem;
            }

            .btn-download-main {
                padding: 1rem 2rem;
                font-size: 1rem;
            }

            .steps-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 1.8rem;
            }

            /* Make icons visible on mobile */
            .bg-icon {
                opacity: 0.5 !important;
                display: block !important;
            }
        }

        /* ── Screenshots Showcase ── */
        @media (max-width: 430px) {
            .platform-hero {
                margin-top: 78px;
            }

            .platform-hero .hero-container {
                padding: 0 1.45rem;
            }

            .hero-content {
                margin-top: 1.15rem;
            }

            .hero-subtext {
                margin-bottom: 1.5rem;
            }

            .hero-footer-badges {
                gap: 0.7rem;
            }

            .footer-badge {
                min-height: 46px;
                padding: 0.65rem 0.45rem;
                gap: 0.45rem;
            }
        }

        .instruction-list {
            list-style: none;
            padding: 0;
            margin-bottom: 3rem;
            text-align: left;
        }

        .instruction-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 2rem;
        }

        .instruction-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            top: 0;
            font-size: 1.5rem;
            line-height: 1;
            color: #000;
        }

        .instruction-list li strong {
            display: block;
            font-size: 1.25rem;
            font-weight: 800;
            color: #000;
            margin-bottom: 0.8rem;
        }

        .instruction-list li p {
            font-size: 1rem;
            color: #000;
            line-height: 1.45;
            max-width: 800px;
        }

        .screenshots-flex {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            margin-top: 4rem;
        }

        .screenshot-card {
            width: 100%;
            max-width: 200px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            aspect-ratio: 9 / 18.5;
            /* Consistent mobile aspect ratio */
        }

        .screenshot-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            border-radius: 20px;
        }

        @media (max-width: 768px) {
            .screenshots-flex {
                gap: 1.5rem;
                margin-top: 2rem;
            }

            .screenshot-card {
                max-width: 160px;
            }

            .instruction-list li strong {
                font-size: 1.1rem;
            }
        }


    </style>
<style>h1{font-size:3rem !important;}h2{font-size:2rem !important;}h3{font-size:1.5rem !important;}p{font-size:1.2rem !important;}</style>
</head>

<body>

    @include('partials.header')
    @include('partials.navbar')

    <header class="platform-hero">
        <picture>
            <source media="(max-width: 768px)" srcset="/images/mobile/download-hero.jpg">
            <source srcset="/images/downloader.webp" type="image/webp">
            <img class="hero-bg-img" src="/images/downloader.jpg" alt="Download Guide Banner" fetchpriority="high" loading="eager">
        </picture>
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge-main">
                    <i class="fas fa-file-download"></i> Download Guide
                </div>
                <h1>{{ $settings->h1_heading ?? 'How to Install from Play Store' }}</h1>
                <p class="hero-subtext" style="line-height: 1.45;">{{ $settings->description ?? 'Follow these simple steps to download and install the app from Google Play Store.' }}</p>

                <a href="{{ $settings->btn_link ?? 'https://play.google.com/store/apps/details?id=com.jmdsol.videodownloader.videosaver' }}"
                    class="btn-hero-main">
                    {{ $settings->btn_text ?? 'Download Video Saver' }}
                </a>

                <div class="hero-footer-badges">
                    <div class="footer-badge"><i class="fas fa-hand-pointer"></i> Get</div>
                    <div class="footer-badge"><i class="fas fa-download"></i> Install</div>
                    <div class="footer-badge"><i class="fas fa-check"></i> Enjoy</div>
                </div>
            </div>
        </div>
    </header>

    <div class="container" style="max-width: 900px;">
        <h2 class="section-title">How to Install Video Saver</h2>

        <div class="install-instructions">
            <ul class="instruction-list">
                <li>
                    <strong>Tap on "Install"</strong>
                    <p style="line-height: 1.45;">When you find Video Saver on the Play Store, tap the “Install” button. The app will start
                        downloading and installing automatically on your device.</p>
                </li>
            </ul>
        </div>

        <div class="screenshots-flex">
            <div class="screenshot-card">
                <img src="/images/screen1.png" alt="Video Saver App Screenshot 1">
            </div>
            <div class="screenshot-card">
                <img src="/images/screen2.png" alt="Video Saver App Screenshot 2">
            </div>
        </div>

        {{-- Second Step --}}
        <div class="install-instructions" style="margin-top: 6rem;">
            <ul class="instruction-list">
                <li>
                    <strong>Open & Explore the App</strong>
                    <p style="line-height: 1.45;">Once installation is complete, tap “Open” to launch the app. You’ll land on the home screen,
                        where you can start saving videos and exploring features right away.</p>
                </li>
            </ul>
        </div>

        <div class="screenshots-flex">
            <div class="screenshot-card">
                <img src="/images/screen3.png" alt="Video Saver App Screenshot 3">
            </div>
            <div class="screenshot-card">
                <img src="/images/screen4.png" alt="Video Saver App Screenshot 4">
            </div>
        </div>
    </div>

   

    @include('partials.footer')

    <!-- Google Translate Scripts -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,ar,ur,hi,es,fr,pt,ko,tr,vi,ru,it',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
        </script>

</body>

</html>




