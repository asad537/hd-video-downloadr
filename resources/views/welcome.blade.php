<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $page === 'blog-post' ? $post['description'] : ($siteSettings['default_meta_description'] ?? 'HDVideoDownloader is an all-in-one video downloader interface for public video links, HD formats, and supported platforms.') }}">
    <title>{{ $page === 'blog-post' ? $post['title'] . ' | ' . ($siteSettings['site_name'] ?? 'HDVideoDownloader') : ($page === 'home' ? 'HD Video Downloader - All in One Video Saver' : ucwords(str_replace('-', ' ', $page)) . ' - HD Video Downloader') }}</title>
    <link rel="canonical" href="{{ $page === 'blog-post' ? route('blog.show', $post['slug']) : url()->current() }}">
    @if($page === 'home')
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    'name' => $siteSettings['site_name'] ?? 'HDVideoDownloader',
                    'url' => url('/'),
                ],
                [
                    '@type' => 'WebApplication',
                    'name' => $siteSettings['site_name'] ?? 'HDVideoDownloader',
                    'url' => url('/'),
                    'applicationCategory' => 'MultimediaApplication',
                    'operatingSystem' => 'Any',
                    'description' => $siteSettings['hero_subtitle'] ?? 'Download videos, reels, shorts, and audio from your favorite platforms.',
                    'offers' => [
                        '@type' => 'Offer',
                        'price' => '0',
                        'priceCurrency' => 'USD'
                    ]
                ],
                [
                    '@type' => 'FAQPage',
                    'mainEntity' => [
                        [
                            '@type' => 'Question',
                            'name' => 'Do I need to install an app?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'No. The downloader runs in your browser on mobile and desktop devices.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Which video qualities are available?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Available formats depend on the source and may include SD, 720p, 1080p, and audio-only options.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Is HDVideoDownloader free?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Yes, the basic public-link downloader experience is free to use.'
                            ]
                        ],
                        [
                            '@type' => 'Question',
                            'name' => 'Can I download any video?',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Only download content you own or have permission to save, and follow the source platform\'s terms.'
                            ]
                        ]
                    ]
                ]
            ]
        ], JSON_UNESCAPED_SLASHES) !!}</script>
    @elseif($page === 'blog-post')
        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $post['title'] }}">
        <meta property="og:description" content="{{ $post['excerpt'] }}">
        <meta property="og:image" content="{{ asset($post['image']) }}">
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => $post['title'],
            'description' => $post['description'],
            'image' => asset($post['image']),
            'datePublished' => date('Y-m-d', strtotime($post['published'])),
            'author' => ['@type' => 'Organization', 'name' => 'HDVideoDownloader'],
            'publisher' => ['@type' => 'Organization', 'name' => 'HDVideoDownloader'],
            'mainEntityOfPage' => route('blog.show', $post['slug']),
        ], JSON_UNESCAPED_SLASHES) !!}</script>
    @endif
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#101828; --muted:#667085; --line:#e4e7ec; --soft:#f6f8fb; --paper:#fff; --brand:#fa3f3f; --brand-dark:#c91f31; --teal:#12b3a8; --blue:#2563eb; --gold:#f4b740; --shadow:0 24px 80px rgba(16,24,40,.12); }
        * { box-sizing: border-box; }
        body { margin:0; color:var(--ink); background:#fbfcfe; font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; }
        a { color:inherit; text-decoration:none; }
        .wrap { width:min(1160px, calc(100% - 36px)); margin:0 auto; }
        .topbar { position:sticky; top:0; z-index:20; border-bottom:1px solid rgba(228,231,236,.8); background:rgba(255,255,255,.9); backdrop-filter:blur(16px); }
        .nav { display:flex; align-items:center; justify-content:space-between; min-height:76px; gap:24px; }
        .brand { display:inline-flex; align-items:center; gap:11px; font-weight:800; }
        .brand-mark { width:38px; height:38px; border-radius:8px; display:grid; place-items:center; color:white; background:linear-gradient(135deg,var(--brand),var(--blue)); box-shadow:0 10px 30px rgba(250,63,63,.28); font-size:15px; }
        .nav-links { display:flex; align-items:center; gap:8px; flex-wrap:wrap; justify-content:flex-end; }
        .nav-links a { padding:10px 13px; border-radius:8px; color:#475467; font-size:14px; font-weight:700; }
        .nav-links a.active, .nav-links a:hover { color:var(--ink); background:#f2f4f7; }
        .hero { overflow:hidden; padding:64px 0 38px; background:radial-gradient(circle at 14% 20%,rgba(18,179,168,.12),transparent 28%), radial-gradient(circle at 84% 12%,rgba(37,99,235,.12),transparent 24%), linear-gradient(180deg,#fff 0%,#f7f9fc 100%); }
        .hero-grid { display:grid; grid-template-columns:minmax(0,1.08fr) minmax(340px,.92fr); gap:44px; align-items:center; }
        .eyebrow { display:inline-flex; align-items:center; gap:9px; color:#344054; font-size:13px; font-weight:800; padding:8px 12px; border:1px solid var(--line); border-radius:999px; background:white; }
        .pulse { width:9px; height:9px; border-radius:50%; background:var(--teal); box-shadow:0 0 0 6px rgba(18,179,168,.12); }
        h1 { margin:20px 0 14px; font-size:clamp(40px,6vw,76px); line-height:.96; letter-spacing:0; }
        .hero-copy { max-width:660px; color:var(--muted); font-size:18px; line-height:1.7; margin:0 0 24px; }
        .download-panel { background:var(--paper); border:1px solid var(--line); border-radius:8px; box-shadow:var(--shadow); padding:14px; }
        .url-form { display:grid; grid-template-columns:1fr auto; gap:10px; }
        .url-form input { min-width:0; width:100%; border:1px solid #d0d5dd; border-radius:8px; padding:17px 16px; font-size:16px; outline:none; }
        .url-form input:focus { border-color:var(--blue); box-shadow:0 0 0 4px rgba(37,99,235,.12); }
        .button { border:0; border-radius:8px; padding:0 22px; min-height:56px; color:white; background:var(--ink); font-weight:800; cursor:pointer; box-shadow:0 14px 30px rgba(16,24,40,.18); }
        .error { margin:10px 2px 0; color:var(--brand-dark); font-size:14px; font-weight:700; }
        .result { margin-top:14px; border:1px solid #d9f1ee; border-radius:8px; padding:16px; background:#f1fbfa; }
        .result-head { display:flex; justify-content:space-between; gap:14px; align-items:center; flex-wrap:wrap; }
        .result strong { display:block; margin-bottom:4px; }
        .chips { display:flex; gap:8px; flex-wrap:wrap; margin-top:14px; }
        .chip { border:1px solid #b9e6df; background:white; border-radius:999px; padding:8px 11px; font-size:13px; font-weight:800; color:#08766f; }
        .note { color:var(--muted); font-size:13px; line-height:1.6; margin:12px 2px 0; }
        .mockup { min-height:470px; border-radius:8px; border:1px solid rgba(255,255,255,.48); background:linear-gradient(135deg,#172033,#29344d 42%,#0f766e); box-shadow:var(--shadow); padding:18px; color:white; }
        .mock-browser { border-radius:8px; overflow:hidden; background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.16); }
        .mock-top { display:flex; gap:7px; padding:13px; background:rgba(255,255,255,.12); }
        .dot { width:10px; height:10px; border-radius:50%; background:#ff6b6b; }
        .dot:nth-child(2) { background:var(--gold); } .dot:nth-child(3) { background:#26d07c; }
        .video-art { padding:22px; }
        .video-frame { aspect-ratio:16/10; border-radius:8px; background:linear-gradient(135deg,rgba(250,63,63,.85),rgba(37,99,235,.86)), url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='900' height='560' viewBox='0 0 900 560'%3E%3Cpath d='M0 0h900v560H0z' fill='%2320273d'/%3E%3Cpath d='M80 380c110-90 190-70 285-20s210 90 455-72v272H80z' fill='%2300b3a8' opacity='.42'/%3E%3Ccircle cx='688' cy='126' r='82' fill='%23ffcc55' opacity='.75'/%3E%3C/svg%3E"); background-size:cover; display:grid; place-items:center; box-shadow:inset 0 0 0 1px rgba(255,255,255,.22); }
        .play { width:72px; height:72px; border-radius:50%; display:grid; place-items:center; background:rgba(255,255,255,.94); color:var(--brand); font-size:26px; }
        .quality-row { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-top:16px; }
        .quality { background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.18); border-radius:8px; padding:13px; font-weight:800; }
        .quality span { display:block; margin-top:4px; color:rgba(255,255,255,.7); font-size:12px; }
        section { padding:56px 0; }
        .section-head { display:flex; justify-content:space-between; gap:24px; align-items:end; margin-bottom:24px; }
        .section-head h2 { margin:0; font-size:clamp(28px,4vw,44px); }
        .section-head p { margin:0; max-width:560px; color:var(--muted); line-height:1.7; }
        .grid { display:grid; gap:16px; }
        .platform-grid { grid-template-columns:repeat(4,minmax(0,1fr)); }
        .platform-card, .post-card, .feature-card { background:white; border:1px solid var(--line); border-radius:8px; padding:20px; }
        .platform-icon { width:44px; height:44px; border-radius:8px; display:grid; place-items:center; color:white; font-weight:900; margin-bottom:15px; }
        .platform-card h3, .post-card h3, .feature-card h3 { margin:0 0 8px; font-size:18px; }
        .platform-card p, .post-card p, .feature-card p { margin:0; color:var(--muted); line-height:1.6; font-size:14px; }
        .features, .blog-grid { grid-template-columns:repeat(3,minmax(0,1fr)); }
        .feature-card b { color:var(--teal); }
        .read { display:inline-flex; margin-top:18px; font-size:13px; font-weight:800; color:var(--blue); }
        .page-hero { padding:54px 0 22px; background:#f7f9fc; border-bottom:1px solid var(--line); }
        .page-hero h1 { font-size:clamp(36px,5vw,58px); margin-bottom:12px; }
        .content-band { background:white; }
        .privacy-box { max-width:820px; background:white; border:1px solid var(--line); border-radius:8px; padding:28px; color:var(--muted); line-height:1.8; }
        footer { padding:34px 0; border-top:1px solid var(--line); color:var(--muted); background:white; }
        .footer-row { display:flex; justify-content:space-between; gap:20px; flex-wrap:wrap; }
        @media (max-width:860px) { .hero-grid, .features, .blog-grid, .platform-grid { grid-template-columns:1fr; } .hero{padding-top:34px;} .mockup{min-height:auto;} .section-head{display:block;} .section-head p{margin-top:10px;} }
        @media (max-width:620px) { .wrap{width:min(100% - 24px,1160px);} .nav{align-items:flex-start; flex-direction:column; padding:14px 0;} .nav-links{justify-content:flex-start;} .url-form{grid-template-columns:1fr;} .button{width:100%;} .quality-row{grid-template-columns:1fr;} }
    </style>
    <style>
        :root { --ink:#172033; --muted:#677185; --line:#e8ebf0; --soft:#f7f8fa; --brand:#ff3d57; --brand-dark:#d82640; --teal:#17b897; --blue:#5267df; --shadow:0 18px 48px rgba(24,32,51,.09); }
        body { background:#fff; }
        .topbar { position:sticky; top:0; z-index:30; background:rgba(255,255,255,.86); border-bottom:1px solid rgba(218,225,232,.78); backdrop-filter:blur(18px); box-shadow:0 8px 30px rgba(27,39,58,.05); }
        .nav { min-height:76px; }
        .brand { font-size:20px; }
        .brand-mark { width:40px; height:40px; border-radius:12px; background:linear-gradient(145deg,#ff5266,#f32649); box-shadow:0 10px 24px rgba(243,38,73,.23); }
        .nav-links a { font-weight:600; }
        .nav-links a { position:relative; }
        .nav-links a.active, .nav-links a:hover { color:var(--brand); background:transparent; }
        .nav-links a.active::after { content:''; position:absolute; left:13px; right:13px; bottom:3px; height:2px; border-radius:2px; background:var(--brand); }
        .hero {
            position:relative;
            padding:78px 0 48px;
            text-align:center;
            background:
                linear-gradient(rgba(255,255,255,.3),rgba(255,255,255,.3)),
                linear-gradient(135deg,#eafbf4 0%,#eaf4ff 48%,#fff0ee 100%);
            border-bottom:1px solid rgba(210, 220, 228, .72);
        }
        .hero-center { max-width:930px; margin:0 auto; }
        .hero .eyebrow { padding:8px 13px; border:1px solid rgba(255,61,87,.18); background:rgba(255,255,255,.66); color:var(--brand); text-transform:uppercase; letter-spacing:.08em; box-shadow:0 8px 25px rgba(35,62,83,.05); }
        .hero .eyebrow::before { content:''; width:7px; height:7px; border-radius:50%; background:var(--teal); box-shadow:0 0 0 5px rgba(23,184,151,.12); }
        .hero h1 { margin:16px auto 12px; max-width:850px; font-size:clamp(40px,6vw,66px); line-height:1.08; }
        .hero h1 span { color:#087d6a; }
        .hero-copy { max-width:690px; margin:0 auto 30px; font-size:17px; }
        .download-panel { max-width:900px; margin:0 auto; padding:10px; border:1px solid rgba(255,255,255,.96); border-radius:18px; background:rgba(255,255,255,.98); backdrop-filter:none; box-shadow:0 15px 40px rgba(35,62,83,.12), inset 0 1px 0 #fff; transform:translateZ(0); will-change:transform; }
        .download-panel.has-result { max-width:1120px; }
        .url-form { gap:8px; }
        .url-form input { min-height:62px; padding:18px 20px; border:1px solid transparent; border-radius:12px; background:#f3f6f8; }
        .url-form input:hover { background:#eef2f5; }
        .url-form input:focus { background:#fff; }
        .button { min-width:165px; min-height:62px; border-radius:12px; background:linear-gradient(135deg,#17b897,#0da982); box-shadow:0 12px 28px rgba(23,184,151,.24); font-size:16px; transition:transform .2s ease,box-shadow .2s ease; }
        .button:hover { background:linear-gradient(135deg,#14ad8e,#078f70); transform:translateY(-1px); box-shadow:0 16px 32px rgba(23,184,151,.3); }
        .hero .note { margin-top:15px; }
        .platform-strip { display:flex; justify-content:center; align-items:center; flex-wrap:wrap; gap:12px; margin:34px auto 0; }
        .platform-pill { display:flex; align-items:center; gap:8px; padding:9px 14px; border:1px solid rgba(223,228,235,.9); border-radius:999px; background:rgba(255,255,255,.82); color:#4a5568; font-size:13px; font-weight:700; box-shadow:0 8px 22px rgba(31,45,65,.06); transition:transform .2s ease,box-shadow .2s ease; }
        .platform-pill:hover { transform:translateY(-2px); box-shadow:0 12px 28px rgba(31,45,65,.1); }
        .platform-dot { width:28px; height:28px; display:grid; place-items:center; flex:0 0 28px; border-radius:50%; }
        .platform-dot img { width:15px; height:15px; display:block; object-fit:contain; }
        .result { text-align:left; box-shadow:none; }
        .result { padding:0; overflow:hidden; border:1px solid #dce5e2; border-radius:14px; background:#fff; }
        .result-layout { display:grid; grid-template-columns:minmax(230px, .72fr) minmax(0, 1.55fr); }
        .media-summary { padding:24px; border-right:1px solid var(--line); background:#fff; }
        .media-thumb { width:100%; aspect-ratio:16/9; display:block; object-fit:cover; border-radius:10px; background:#edf0f3; }
        .media-platform { margin:18px 0 8px; color:var(--teal); font-size:12px; font-weight:800; text-transform:uppercase; }
        .media-title { margin:0; font-size:18px; line-height:1.55; }
        .media-duration { display:inline-flex; align-items:center; gap:7px; margin-top:14px; padding:8px 11px; border-radius:8px; background:#def8ec; color:#08785f; font-size:14px; font-weight:800; }
        .format-section + .format-section { border-top:1px solid var(--line); }
        .format-heading { display:flex; align-items:center; gap:10px; margin:0; padding:20px 24px; border-bottom:1px solid var(--line); font-size:21px; }
        .format-heading-mark { width:32px; height:32px; display:grid; place-items:center; border-radius:8px; color:#fff; background:var(--teal); font-size:13px; }
        .format-row { display:grid; grid-template-columns:90px minmax(90px, 1fr) minmax(90px, .8fr) auto; align-items:center; gap:12px; min-height:82px; padding:14px 24px; border-bottom:1px solid var(--line); }
        .format-row:last-child { border-bottom:0; }
        .format-badge { justify-self:start; min-width:58px; padding:8px 9px; border-radius:8px; background:#ffaf2f; color:#fff; text-align:center; font-weight:800; }
        .format-quality, .format-size { font-weight:800; color:#303746; }
        .format-size { color:#5e687b; }
        .download-link { position:relative; display:inline-flex; align-items:center; justify-content:center; gap:8px; min-width:142px; min-height:48px; padding:0 16px; border:2px solid #08ba54; border-radius:10px; color:#08a94d; background:#fff; font-weight:800; }
        .download-link:hover { color:#fff; background:#08ba54; }
        .download-link.is-loading { border-color:#cdd4df; color:#7b8494; background:#f4f6f8; cursor:wait; }
        .download-arrow { font-size:20px; line-height:1; }
        .empty-formats { padding:24px; color:var(--muted); }
        .result-note { margin:0; padding:14px 24px; border-top:1px solid var(--line); background:#fafbfc; color:var(--muted); font-size:12px; }
        .trust-bar { border-top:1px solid var(--line); border-bottom:1px solid var(--line); background:#fff; }
        .trust-grid { display:grid; grid-template-columns:repeat(3,1fr); }
        .trust-item { padding:22px; text-align:center; border-right:1px solid var(--line); }
        .trust-item:last-child { border-right:0; }
        .trust-item strong { display:block; margin-bottom:5px; font-size:15px; }
        .trust-item span { color:var(--muted); font-size:13px; }
        section { padding:70px 0; }
        .section-head { display:block; text-align:center; max-width:720px; margin:0 auto 34px; }
        .section-head h2 { font-size:clamp(30px,4vw,42px); }
        .section-head p { margin:12px auto 0; }
        .feature-card, .platform-card, .post-card { border-color:var(--line); border-radius:12px; box-shadow:none; }
        .feature-card { padding:28px; }
        .feature-icon { width:46px; height:46px; display:grid; place-items:center; margin-bottom:18px; border-radius:50%; background:#edf9f6; color:var(--teal); font-size:21px; font-weight:800; }
        .steps-section { background:#f7f8fa; }
        /* Steps layout — Screenshot 2 style: icon box + dashed connector */
        .steps-flow {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0;
            margin-top: 48px;
        }
        .step {
            flex: 1;
            position: relative;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 24px;
        }
        /* Dashed connector between steps */
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 36px;
            left: calc(50% + 52px);
            width: calc(100% - 104px);
            height: 0;
            border-top: 2px dashed var(--line);
            pointer-events: none;
        }
        /* Icon box — square with rounded corners */
        .step-icon-box {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(23,184,151,.08);
            border: 1.5px solid rgba(23,184,151,.22);
            color: var(--teal);
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
            transition: background 0.25s ease, border-color 0.25s ease, transform 0.25s cubic-bezier(0.34,1.56,0.64,1);
        }
        .step:hover .step-icon-box {
            background: rgba(23,184,151,.14);
            border-color: var(--teal);
            transform: translateY(-4px);
        }
        .step-icon-box svg {
            width: 26px;
            height: 26px;
            stroke: currentColor;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .step h3 { margin:0 0 10px; font-size:18px; font-weight:800; }
        .step p  { margin:0; color:var(--muted); line-height:1.65; font-size:14px; max-width:240px; }
        .faq { max-width:820px; margin:0 auto; }
        .faq details { border-bottom:1px solid var(--line); }
        .faq summary { padding:20px 4px; cursor:pointer; font-weight:700; list-style:none; }
        .faq summary::-webkit-details-marker { display:none; }
        .faq summary::after { content:'+'; float:right; color:var(--brand); font-size:22px; }
        .faq details[open] summary::after { content:'−'; }
        .faq p { margin:0; padding:0 34px 20px 4px; color:var(--muted); line-height:1.7; }
        .content-band { background:#fff; }
        footer { background:#172033; color:#c8cfdb; border:0; }
        @media (max-width:860px) { .trust-grid, .steps { grid-template-columns:1fr; } .trust-item { border-right:0; border-bottom:1px solid var(--line); } .trust-item:last-child { border-bottom:0; } .result-layout{grid-template-columns:1fr;} .media-summary{border-right:0; border-bottom:1px solid var(--line);} }
        @media (max-width:620px) { .hero{padding:48px 0 32px;} .nav{align-items:center; flex-direction:row;} .nav-links a:not(:first-child){display:none;} .brand{font-size:17px;} .download-panel{border-radius:12px;} .url-form{grid-template-columns:1fr;} .button{width:100%;} .platform-strip{gap:8px;} .platform-pill{padding:7px 10px;} .format-row{grid-template-columns:62px 1fr auto; gap:8px; padding:13px 14px;} .format-size{grid-column:2;} .download-link{grid-column:3; grid-row:1 / span 2; min-width:48px; width:48px; padding:0; font-size:0;} .download-arrow{font-size:22px;} .format-heading{padding:17px 14px;} }
    </style>
    <style>
        :root {
            --ink:#f7f9fc;
            --muted:#98a2b3;
            --line:#293241;
            --soft:#151a22;
            --paper:#11161d;
            --brand:#ff4d67;
            --brand-dark:#ff6b7f;
            --teal:#22d3a7;
            --blue:#60a5fa;
            --gold:#f7b84b;
            --shadow:0 26px 80px rgba(0,0,0,.42);
        }
        html { color-scheme:dark; background:#090c11; }
        body { color:var(--ink); background:#090c11; }
        .topbar {
            background:rgba(12,17,23,0.9);
            border-bottom:1px solid rgba(255,255,255,.05);
            box-shadow:0 12px 36px rgba(0,0,0,.3);
            backdrop-filter:blur(12px);
            padding:5px 0;
        }
        .brand-mark {
            background:linear-gradient(135deg,#39e1b6,#13b98f);
            box-shadow:0 8px 24px rgba(57,225,182,.25), inset 0 1px 0 rgba(255,255,255,.3);
            color:#04130f;
            border-radius:10px;
        }
        .brand-mark svg { width:22px; height:22px; display:block; }
        .brand-name { color:#fff; font-weight:800; font-size:22px; letter-spacing:-0.5px; }
        .brand-name > span { color:#39e1b6; font-weight:800; }
        .nav-links a { color:#a0aaba; font-size:15px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; transition:color .2s; }
        .nav-links a.active, .nav-links a:hover { color:#fff; }
        .nav-links a.active::after { background:#39e1b6; box-shadow:0 0 10px rgba(57,225,182,.5); bottom:-5px; }
        .hero {
            background:
                radial-gradient(circle at 16% 5%,rgba(34,211,167,.14),transparent 30%),
                radial-gradient(circle at 82% 10%,rgba(96,165,250,.12),transparent 28%),
                radial-gradient(circle at 76% 86%,rgba(255,77,103,.08),transparent 25%),
                linear-gradient(180deg,#0d1219 0%,#090c11 100%);
            border-bottom:1px solid rgba(255,255,255,.08);
        }
        .hero::before {
            content:'';
            position:absolute;
            inset:0;
            pointer-events:none;
            opacity:.18;
            background-image:linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px);
            background-size:52px 52px;
            mask-image:linear-gradient(to bottom,black,transparent 78%);
        }
        .hero-center { position:relative; z-index:1; }
        .hero .eyebrow {
            color:#74f0cf;
            background:rgba(18,27,34,.72);
            border-color:rgba(34,211,167,.25);
            box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 12px 35px rgba(0,0,0,.25);
        }
        .hero h1 { color:#f8fafc; text-shadow:0 8px 35px rgba(0,0,0,.35); }
        .hero h1 span { color:#31d6ae; }
        .hero-copy { color:#9da8b8; }
        .download-panel {
            background:#10161d;
            border:1px solid rgba(255,255,255,.05);
            backdrop-filter:none;
            box-shadow:0 15px 40px rgba(0,0,0,.3),inset 0 1px 0 rgba(255,255,255,.03);
            transform:translateZ(0);
            will-change:transform;
        }
        .url-form input {
            color:#f8fafc;
            background:#0b1016;
            border-color:#293340;
            box-shadow:inset 0 1px 8px rgba(0,0,0,.2);
        }
        .url-form input::placeholder { color:#687386; }
        .url-form input:hover { background:#0d131a; border-color:#394555; }
        .url-form input:focus { color:#fff; background:#0b1016; border-color:var(--teal); box-shadow:0 0 0 4px rgba(34,211,167,.11); }
        .button { color:#04130f; background:linear-gradient(135deg,#39e1b6,#13b98f); box-shadow:0 14px 34px rgba(19,185,143,.22),inset 0 1px 0 rgba(255,255,255,.4); }
        .button:hover { background:linear-gradient(135deg,#5ce9c5,#20c99d); box-shadow:0 18px 40px rgba(19,185,143,.32); }
        .note { color:#7f8a9b; }
        .platform-pill {
            color:#c3cad5;
            background:rgba(15,20,27,.82);
            border-color:rgba(255,255,255,.09);
            box-shadow:0 10px 28px rgba(0,0,0,.22),inset 0 1px 0 rgba(255,255,255,.04);
        }
        .platform-pill:hover { color:#fff; border-color:rgba(34,211,167,.3); background:#151c24; box-shadow:0 14px 34px rgba(0,0,0,.32); }
        .trust-bar, .content-band { color:var(--ink); background:#0d1117; border-color:#202733; }
        .trust-item { border-color:#202733; }
        .trust-item span, .section-head p, .platform-card p, .post-card p, .feature-card p, .step p, .faq p { color:var(--muted); }
        section { background:#0d1117; }
        section:nth-of-type(even), .steps-section { background:#10151c; }
        .feature-card, .platform-card, .post-card, .privacy-box {
            color:var(--ink);
            background:#141a22;
            border-color:#29313d;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.035),0 16px 40px rgba(0,0,0,.14);
        }
        .feature-card:hover, .platform-card:hover, .post-card:hover { transform:translateY(-3px); border-color:#3a4656; box-shadow:0 20px 46px rgba(0,0,0,.28); }
        .feature-card, .platform-card, .post-card { transition:transform .2s ease,border-color .2s ease,box-shadow .2s ease; }
        .blog-grid { align-items:stretch; }
        .post-card { display:flex; flex-direction:column; padding:0; overflow:hidden; }
        .post-cover { position:relative; display:block; aspect-ratio:16/9; overflow:hidden; background:#090d12; }
        .post-cover::after { content:''; position:absolute; inset:0; border-bottom:1px solid rgba(255,255,255,.08); background:linear-gradient(180deg,transparent 58%,rgba(4,8,12,.5)); }
        .post-cover img { width:100%; height:100%; display:block; object-fit:cover; transition:transform .35s ease,filter .35s ease; }
        .post-card:hover .post-cover img { transform:scale(1.035); filter:brightness(1.08); }
        .post-content { display:flex; flex:1; flex-wrap:wrap; align-items:center; padding:20px; }
        .post-content h3, .post-content p { width:100%; }
        .post-meta { width:100%; display:flex; justify-content:space-between; gap:12px; margin-bottom:12px; color:#7f8a9b; font-size:11px; font-weight:700; text-transform:uppercase; }
        .post-meta span:first-child { color:#44dcb8; }
        .post-content .read { margin-top:18px; color:#48dfba; }
        .read-time { margin:18px 0 0 auto; color:#788394; font-size:12px; }
        .home-blog { padding:80px 0 86px; background:#0b0e13; border-top:1px solid #202832; }
        .home-blog-head { max-width:680px; margin:0 auto 42px; text-align:center; }
        .home-blog-label { display:inline-flex; margin-bottom:13px; padding:7px 16px; border:1px solid rgba(255,77,103,.45); border-radius:999px; color:var(--brand); font-size:11px; font-weight:800; }
        .home-blog-head h2 { margin:0 0 12px; font-size:34px; }
        .home-blog-head p { margin:0; color:#929cab; font-size:14px; }
        .editorial-blog-grid { display:grid; grid-template-columns:minmax(0,1.05fr) minmax(0,.95fr); gap:56px; align-items:start; }
        .featured-post-image, .side-post-image { display:block; overflow:hidden; border:1px solid #2b3440; border-radius:8px; background:#151b22; }
        .featured-post-image { aspect-ratio:16/9; margin-bottom:16px; }
        .featured-post-image img, .side-post-image img { width:100%; height:100%; display:block; object-fit:cover; transition:transform .35s ease,filter .35s ease; }
        .featured-post:hover img, .side-post:hover img { transform:scale(1.035); filter:brightness(1.08); }
        .editorial-meta { display:flex; align-items:center; justify-content:space-between; gap:16px; color:#8993a2; font-size:11px; }
        .featured-post h3 { margin:13px 0 9px; font-size:21px; line-height:1.35; }
        .featured-post p, .side-post p { margin:0; color:#8f99a8; font-size:13px; line-height:1.65; }
        .side-posts { display:grid; gap:16px; }
        .side-post { display:grid; grid-template-columns:132px minmax(0,1fr); gap:18px; align-items:center; min-height:112px; }
        .side-post-image { width:132px; aspect-ratio:1.15/1; }
        .side-post h3 { margin:9px 0 5px; font-size:15px; line-height:1.4; }
        .side-post p { display:-webkit-box; overflow:hidden; -webkit-box-orient:vertical; -webkit-line-clamp:2; font-size:11px; }
        .view-all-posts { justify-self:end; display:inline-flex; gap:7px; margin-top:10px; color:var(--brand); font-size:13px; font-weight:800; }
        .view-all-posts:hover { color:#ff8294; }
        
        @media (max-width: 900px) {
            .dark-top-grid, .dark-bottom-grid { grid-template-columns: 1fr; }
            .dark-main-posts { grid-template-columns: 1fr; }
        }
        
        /* Dark Theme Blog Styles */
        .blog-page-hero { padding:100px 0 90px; text-align:center; background:#121212; position:relative; overflow:hidden; border-bottom:1px solid #2a2a2a; }
        .blog-page-hero::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at center, rgba(57,225,182,0.08) 0%, transparent 60%); pointer-events:none; }
        .blog-badge { display:inline-block; border:1px solid rgba(57,225,182,0.4); color:#39e1b6; background:rgba(57,225,182,0.1); padding:6px 18px; border-radius:999px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-bottom:20px; }
        .blog-page-hero h1 { color:#fff; font-size:clamp(32px, 5vw, 56px); line-height:1.1; margin:0 0 16px; font-weight:800; max-width:800px; margin-left:auto; margin-right:auto; }
        .blog-page-hero h1 span { color:#39e1b6; }
        .blog-page-hero p { color:#a0aaba; font-size:18px; max-width:600px; margin:0 auto; line-height:1.6; }
        
        .platforms-page-hero { padding:100px 0 90px; text-align:center; background:#101720; position:relative; overflow:hidden; border-bottom:1px solid #2a2a2a; }
        .platforms-page-hero::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 50% -20%, rgba(57,225,182,0.12) 0%, transparent 60%); pointer-events:none; }
        .platforms-page-hero h1 { color:#fff; font-size:clamp(36px, 6vw, 64px); line-height:1.1; margin:0 0 16px; font-weight:800; }
        .platforms-page-hero h1 span { color:#39e1b6; }
        .platforms-page-hero p { color:#a0aaba; font-size:18px; max-width:560px; margin:0 auto; line-height:1.6; }
        
        .privacy-hero { padding:100px 0 90px; text-align:center; background:#101720; position:relative; overflow:hidden; border-bottom:1px solid #2a2a2a; }
        .privacy-hero::before { content:''; position:absolute; inset:0; background:radial-gradient(circle at 50% -20%, rgba(57,225,182,0.12) 0%, transparent 60%); pointer-events:none; }
        .privacy-hero h1 { color:#fff; font-size:clamp(36px, 6vw, 64px); line-height:1.1; margin:0 0 16px; font-weight:800; }
        .privacy-hero h1 span { color:#39e1b6; }
        .privacy-hero p { color:#a0aaba; font-size:18px; max-width:560px; margin:0 auto; line-height:1.6; }
        
        .privacy-content-wrap { max-width:800px; margin:0 auto; padding:60px 20px 100px; }
        .privacy-box { background:#1a1a1a; border:1px solid #2a2a2a; border-radius:12px; padding:40px; color:#cfd6df; font-size:16px; line-height:1.8; box-shadow:0 10px 30px rgba(0,0,0,0.2); }
        .privacy-box h2 { color:#fff; font-size:24px; margin:30px 0 15px; }
        .privacy-box h2:first-child { margin-top:0; }
        .privacy-box p { margin:0 0 20px; }
        .privacy-box p:last-child { margin-bottom:0; }
        .privacy-box ul { padding-left:20px; margin-bottom:20px; }
        .privacy-box li { margin-bottom:10px; }
        
        .dark-blog-section { background:#1a1a1a; padding:60px 0 100px; color:#fff; }
        .dark-blog-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:40px; flex-wrap:wrap; gap:20px; }
        .dark-blog-title { position:relative; font-size:28px; color:#fff; margin:0; padding-bottom:10px; font-weight:700; }
        .dark-blog-title::after { content:''; position:absolute; bottom:0; left:0; width:60px; height:3px; background:#39e1b6; }
        .dark-search { position:relative; }
        .dark-search input { background:#252525; border:1px solid #333; color:#fff; padding:12px 20px 12px 40px; border-radius:30px; outline:none; width:280px; font-size:14px; }
        .dark-search input::placeholder { color:#888; }
        .dark-search::before { content:'⌕'; position:absolute; left:16px; top:50%; transform:translateY(-50%); color:#888; font-size:18px; }
        
        .dark-top-grid { display:grid; grid-template-columns:1.2fr 0.8fr; gap:30px; margin-bottom:60px; }
        .dark-post-card { display:flex; flex-direction:column; background:transparent; }
        .dark-post-cover { border-radius:12px; overflow:hidden; aspect-ratio:16/10; position:relative; margin-bottom:16px; display:block; }
        .dark-post-cover img { width:100%; height:100%; object-fit:cover; transition:transform .4s ease; }
        .dark-post-card:hover .dark-post-cover img { transform:scale(1.05); }
        .dark-post-meta { display:flex; justify-content:space-between; color:#a0aaba; font-size:12px; font-weight:600; margin-bottom:12px; }
        .dark-post-title { font-size:22px; color:#fff; margin:0 0 10px; line-height:1.3; }
        .dark-post-title a { color:#fff; text-decoration:none; transition:color .2s; }
        .dark-post-title a:hover { color:#39e1b6; }
        .dark-post-excerpt { color:#888; font-size:14px; line-height:1.6; margin:0; }
        
        .dark-side-stack { display:flex; flex-direction:column; gap:30px; }
        .dark-side-stack .dark-post-cover { aspect-ratio:16/10; }
        .dark-side-stack .dark-post-title { font-size:18px; }
        
        .dark-bottom-grid { display:grid; grid-template-columns:minmax(0, 1fr) 300px; gap:40px; }
        .dark-main-posts { display:grid; grid-template-columns:1fr 1fr; gap:30px; }
        .dark-main-posts .dark-post-title { font-size:18px; }
        .dark-sidebar { display:flex; flex-direction:column; gap:30px; }
        
        .dark-widget { background:#222; border:1px solid #333; border-radius:12px; padding:24px; }
        .dark-widget-title { font-size:18px; color:#fff; margin:0 0 20px; display:flex; align-items:center; gap:10px; font-weight:700; }
        .dark-widget-title span { color:#39e1b6; }
        .dark-category-list { list-style:none; padding:0; margin:0; }
        .dark-category-list li { display:flex; align-items:center; gap:16px; padding:12px 0; border-bottom:1px solid #333; color:#ccc; font-size:14px; font-weight:600; }
        .dark-category-list li:last-child { border-bottom:none; }
        .dark-category-icon { width:36px; height:36px; border-radius:50%; background:#333; display:grid; place-items:center; color:#fff; font-size:14px; }
        
        .dark-form-group { margin-bottom:16px; }
        .dark-form-group input, .dark-form-group textarea { width:100%; background:#1a1a1a; border:1px solid #333; color:#fff; padding:14px; border-radius:8px; outline:none; font-size:14px; }
        .dark-form-group input::placeholder, .dark-form-group textarea::placeholder { color:#777; }
        .dark-form-group textarea { height:100px; resize:none; }
        .dark-form-row { display:flex; gap:12px; }
        .dark-btn-primary { background:linear-gradient(135deg,#39e1b6,#13b98f); color:#04130f; border:none; padding:12px 24px; border-radius:8px; font-weight:700; cursor:pointer; width:100%; transition:box-shadow .2s, transform .2s; }
        .dark-btn-primary:hover { transform:translateY(-1px); box-shadow:0 12px 24px rgba(57,225,182,0.25); }
        .dark-btn-secondary { background:transparent; color:#fff; border:1px solid #fff; padding:12px 24px; border-radius:8px; font-weight:700; cursor:pointer; width:100%; transition:all .2s; }
        .dark-btn-secondary:hover { background:rgba(255,255,255,0.1); }
        
        @media (max-width: 900px) {
            .dark-top-grid, .dark-bottom-grid { grid-template-columns: 1fr; }
            .dark-main-posts { grid-template-columns: 1fr; }
            .article-layout { grid-template-columns: 1fr; }
            .article-hero-grid { grid-template-columns: 1fr; gap: 30px; }
            .article-aside { position: static; }
        }
        @media (max-width: 600px) {
            .blog-page-hero h1, .platforms-page-hero h1, .privacy-hero h1 { font-size: 32px; }
            .blog-page-hero { padding: 60px 20px; }
            .platforms-page-hero { padding: 60px 20px; }
            .privacy-hero { padding: 60px 20px; }
            .privacy-box { padding: 24px; }
            .dark-search input { width: 100%; }
            .dark-blog-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .dark-form-row { flex-direction: column; }
            .dark-widget { padding: 20px; }
            .article-hero h1 { font-size: 32px; }
        }
        .article-hero { padding:76px 0 56px; background:radial-gradient(circle at 12% 10%,rgba(34,211,167,.13),transparent 28%),linear-gradient(145deg,#101720,#080b10); border-bottom:1px solid #222b36; }
        .article-hero-grid { display:grid; grid-template-columns:minmax(0,1fr) minmax(380px,.85fr); gap:54px; align-items:center; }
        .article-back { display:inline-flex; margin-bottom:24px; color:#45ddb9; font-size:13px; font-weight:800; }
        .article-meta { display:flex; flex-wrap:wrap; gap:10px 18px; color:#8490a2; font-size:12px; font-weight:700; text-transform:uppercase; }
        .article-meta span:first-child { color:#45ddb9; }
        .article-hero h1 { margin:18px 0; font-size:clamp(38px,5vw,62px); line-height:1.05; }
        .article-hero p { margin:0; color:#a0aaba; font-size:17px; line-height:1.75; }
        .article-hero img { width:100%; height:auto; display:block; aspect-ratio:16/9; object-fit:cover; border:1px solid #303a48; border-radius:8px; box-shadow:0 26px 70px rgba(0,0,0,.4); }
        .article-layout { display:grid; grid-template-columns:minmax(0,760px) 240px; justify-content:center; gap:70px; padding-top:72px; padding-bottom:82px; }
        .article-body { color:#aeb7c5; font-size:16px; line-height:1.85; }
        .article-body h2 { margin:42px 0 14px; color:#f6f8fb; font-size:28px; line-height:1.25; }
        .article-body p { margin:0 0 20px; }
        .article-content ul { display:grid; gap:12px; margin:22px 0 30px; padding:0; list-style:none; }
        .article-content li { position:relative; padding:16px 18px 16px 48px; border:1px solid #293440; border-radius:8px; color:#d5dce5; background:#121820; }
        .article-content li::before { content:'✓'; position:absolute; left:18px; top:15px; color:#35d6ad; font-weight:900; }
        .article-lead { color:#d9dfe8; font-size:20px; line-height:1.7; }
        .article-checklist { display:grid; gap:12px; margin:22px 0 30px; padding:0; list-style:none; }
        .article-checklist li { position:relative; padding:16px 18px 16px 48px; border:1px solid #293440; border-radius:8px; color:#d5dce5; background:#121820; }
        .article-checklist li::before { content:'✓'; position:absolute; left:18px; top:15px; color:#35d6ad; font-weight:900; }
        .article-callout { margin:34px 0; padding:22px; color:#cfd6df; background:rgba(255,77,103,.08); border:1px solid rgba(255,77,103,.22); border-left:3px solid #ff526c; border-radius:8px; }
        .article-callout strong { color:#ff8294; }
        .article-cta { display:inline-flex; margin-top:6px; padding:14px 18px; border-radius:8px; color:#05140f; background:#35d6ad; font-weight:800; }
        .article-aside { position:sticky; top:112px; align-self:start; display:grid; gap:5px; padding:20px; border:1px solid #29323e; border-radius:8px; background:#11171e; }
        .article-aside strong { margin-bottom:9px; color:#f0f3f7; }
        .article-aside a { padding:9px 0; color:#8f9aaa; font-size:13px; border-bottom:1px solid #242c36; }
        .article-aside a:last-child { color:#45ddb9; border:0; }
        .related-section { border-top:1px solid #252d38; background:#10151c; }
        .feature-icon { color:#40dcb5; background:rgba(34,211,167,.1); border:1px solid rgba(34,211,167,.16); }
        /* Dark bento overrides */
        .bento-card { background:#141a22; border-color:#29313d; box-shadow:inset 0 1px 0 rgba(255,255,255,.03), 0 16px 40px rgba(0,0,0,.18); }
        .bento-card:hover { border-color:#3a4656; box-shadow:0 22px 50px rgba(0,0,0,.32); }
        .bento-card h3 { color:#f0f4f8; }
        .bento-icon-box { background:rgba(34,211,167,.07); border-color:rgba(34,211,167,.18); color:#22d3a7; }
        .bento-card.hl { background:linear-gradient(135deg,#39e1b6,#13b98f); border-color:transparent; box-shadow:0 14px 36px rgba(19,185,143,.28); }
        .bento-card.hl h3 { color:#04130f; }
        .bento-card.hl p  { color:rgba(4,19,15,.82); }
        .bento-card.hl .bento-icon-box { background:rgba(4,19,15,.08); border-color:rgba(4,19,15,.12); color:#04130f; }
        .bento-card.hl .bento-chip { background:rgba(4,19,15,.08); color:#04130f; }
        .bento-card.hl::after { color:rgba(4,19,15,.06); }
        .bento-circle { background:radial-gradient(circle,rgba(57,225,182,.05),transparent 70%); }
        .bento-globe  { color:rgba(255,255,255,.035); }
        .bento-devices svg { stroke:rgba(255,255,255,.3); }
        .step-icon-box {
            background: rgba(34,211,167,.07);
            border-color: rgba(34,211,167,.2);
            color: #22d3a7;
        }
        .step:hover .step-icon-box {
            background: rgba(34,211,167,.13);
            border-color: #22d3a7;
            box-shadow: 0 0 22px rgba(34,211,167,.15);
        }
        .step:not(:last-child)::after {
            border-top-color: rgba(255,255,255,.08);
        }
        .faq details { border-color:#28313e; }
        .faq summary { color:#e9edf3; }
        .page-hero { background:linear-gradient(135deg,#101720,#0a0e13); border-color:#252d38; }
        .page-hero h1 { color:#f8fafc; }
        .privacy-box { color:#a9b2c0; }
        footer { color:#8e99aa; background:#07090d; border-top:1px solid #202630; }
        .result { background:#0c1117; border-color:#2a3440; box-shadow:0 8px 24px rgba(0,0,0,.2); transform:translateZ(0); will-change:transform; }
        .media-summary { background:#0e141b; border-color:#29323e; }
        .media-thumb { background:#171e27; transform:translateZ(0); }
        .media-platform { color:#37d8b0; }
        .media-duration { color:#66e7c5; background:rgba(34,211,167,.1); border:1px solid rgba(34,211,167,.15); }
        .format-section + .format-section, .format-heading, .format-row, .result-note { border-color:#29323e; }
        .format-heading { background:#10161e; }
        .format-heading-mark { color:#06241d; background:#2dd4aa; }
        .format-row { background:#0c1117; transform:translateZ(0); }
        .format-row:hover { background:#111820; }
        .format-quality { color:#edf1f6; }
        .format-size, .empty-formats { color:#9aa5b5; }
        .format-badge { color:#251702; background:linear-gradient(135deg,#ffc45b,#f09b27); }
        .download-link { color:#34d399; background:#0d1418; border-color:#24c98f; }
        .download-link:hover { color:#03140f; background:#34d399; border-color:#34d399; }
        .download-link.is-loading { color:#7d8796; background:#171c23; border-color:#36404d; }
        .result-note { color:#7e899a; background:#10161d; }
        .error { color:#ff8192; }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .result-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        .loader-container {
            padding: 60px 20px;
            text-align: center;
            background: #0c1117;
            border-radius: 12px;
            border: 1px solid #2a3440;
            margin-top: 20px;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(57, 225, 182, 0.2);
            border-left-color: #39e1b6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loader-text {
            color: #a0aaba;
            font-size: 16px;
            font-weight: 600;
        }

        @media (max-width:620px) {
            .hero::before { background-size:36px 36px; }
            .topbar { background:rgba(9,12,17,.94); }
            .article-hero { padding:46px 0 34px; }
            .article-hero h1 { font-size:36px; }
            .article-layout { padding-top:42px; padding-bottom:52px; }
        }
        @media (max-width:900px) { .article-hero-grid, .article-layout { grid-template-columns:1fr; } .article-hero-grid { gap:30px; } .article-aside { display:none; } }
        @media (max-width:860px) { .editorial-blog-grid { grid-template-columns:1fr; gap:34px; } }
        @media (max-width:560px) { .home-blog { padding:56px 0; } .home-blog-head { margin-bottom:28px; } .home-blog-head h2 { font-size:29px; } .side-post { grid-template-columns:104px minmax(0,1fr); gap:13px; } .side-post-image { width:104px; } .side-post h3 { font-size:14px; } .editorial-meta { gap:8px; } }
    </style>
</head>
<body>
    <header class="topbar">
        <nav class="wrap nav">
            <a class="brand" href="{{ route('home') }}" aria-label="HDVideoDownloader home">@include('partials.logo-mark')<span class="brand-name">HDVideo<span>Downloader</span></span></a>
            <div class="nav-links">
                <a class="{{ $page === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Downloader</a>
                <a class="{{ $page === 'platforms' ? 'active' : '' }}" href="{{ route('platforms') }}">Supported Platforms</a>
                <a class="{{ in_array($page, ['blog', 'blog-post']) ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
                <a class="{{ $page === 'privacy' ? 'active' : '' }}" href="{{ route('privacy') }}">Privacy</a>
            </div>
        </nav>
    </header>

    @if ($page === 'home')
        <main>
            <div class="hero">
                <div class="wrap hero-center">
                        <span class="eyebrow">Free online tool</span>
                        @php $heroTitle = $siteSettings['hero_title'] ?? 'Free All Video Downloader'; @endphp
                        <h1>{{ \Illuminate\Support\Str::beforeLast($heroTitle, ' ') }} <span>{{ \Illuminate\Support\Str::afterLast($heroTitle, ' ') }}</span></h1>
                        <p class="hero-copy">{{ $siteSettings['hero_subtitle'] ?? 'Download videos, reels, shorts, and audio from your favorite platforms. Paste a public video link below to get started.' }}</p>
                        <div class="download-panel {{ $result ? 'has-result' : '' }}">
                            <form class="url-form" method="POST" action="{{ route('analyze') }}" id="analyze-form">
                                @csrf
                                <input id="video-url-input" name="video_url" type="url" value="{{ old('video_url') }}" placeholder="Paste a video URL here" aria-label="Video URL" required>
                                <button id="analyze-btn" class="button" type="submit">
                                    <svg style="display:inline-block;vertical-align:middle;margin-right:8px;flex-shrink:0" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    <span>Download</span>
                                </button>
                            </form>
                            @error('video_url')<div class="error" id="error-container">{{ $message }}</div>@else<div id="error-container" class="error" style="display:none;"></div>@enderror
                            <div id="result-container">
                                @if ($result)
                                    @include('partials.result', ['result' => $result])
                                @else
                                    <p class="note" id="default-note">Supports public video URLs. Respect each platform's terms, creator rights, and local copyright law.</p>
                                @endif
                            </div>
                        </div>
                        <div class="platform-strip" aria-label="Popular supported platforms">
                            @foreach (array_slice($platforms, 0, 6) as $platform)
                                <span class="platform-pill"><span class="platform-dot" style="background:{{ $platform['accent'] }}"><img src="https://cdn.simpleicons.org/{{ $platform['icon'] }}/ffffff" alt="" loading="lazy"></span>{{ $platform['name'] }}</span>
                            @endforeach
                        </div>
                </div>
            </div>
            <div class="trust-bar">
                <div class="wrap trust-grid">
                    <div class="trust-item"><strong>Fast link analysis</strong><span>Get available formats in seconds</span></div>
                    <div class="trust-item"><strong>No installation</strong><span>Works directly in your browser</span></div>
                    <div class="trust-item"><strong>HD quality</strong><span>Choose the best available resolution</span></div>
                </div>
            </div>
            <section>
                <div class="wrap">
                    <div class="section-head"><h2>Why choose HDVideoDownloader?</h2><p>A simple, fast, and private way to save public videos across mobile, tablet, and desktop browsers.</p></div>

                    <!-- Row 1 -->
                    <div class="bento-grid">

                        <!-- Card 1: Ultra-Fast Speeds (wide) -->
                        <div class="bento-card">
                            <div class="bento-circle" aria-hidden="true"></div>
                            <div>
                                <div class="bento-icon-box" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                                <h3>Ultra-Fast Speeds</h3>
                                <p>Our high-performance servers process video extraction in milliseconds, ensuring you get your files without the wait. Powered by distributed cloud technology.</p>
                            </div>
                        </div>

                        <!-- Card 2: High Quality (narrow, highlighted) -->
                        <div class="bento-card hl">
                            <div>
                                <div class="bento-icon-box" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                                </div>
                                <h3>High Quality</h3>
                                <p>Get full resolution support up to 4K UHD with lossless audio extraction features.</p>
                            </div>
                            <div class="bento-chips">
                                <span class="bento-chip">1080p</span>
                                <span class="bento-chip">4K UHD</span>
                                <span class="bento-chip">8K</span>
                            </div>
                        </div>

                    </div>

                    <!-- Row 2 -->
                    <div class="bento-grid-r2">

                        <!-- Card 3: Safe & Private (narrow) -->
                        <div class="bento-card">
                            <div>
                                <div class="bento-icon-box" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                </div>
                                <h3>Safe &amp; Private</h3>
                                <p>We value your privacy. No registration required, and all processed files are purged from our servers after 24 hours. SSL encrypted transfers.</p>
                            </div>
                        </div>

                        <!-- Card 4: Universal Compatibility (wide) -->
                        <div class="bento-card">
                            <div class="bento-globe" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                            </div>
                            <div>
                                <div class="bento-icon-box" aria-hidden="true">
                                    <svg viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                </div>
                                <h3>Universal Compatibility</h3>
                                <p>Works on any modern browser across Windows, macOS, Android, and iOS. No apps or extensions needed.</p>
                            </div>
                            <div class="bento-devices" aria-label="Supported devices">
                                <svg viewBox="0 0 24 24" title="Desktop"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                <svg viewBox="0 0 24 24" title="Mobile"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                                <svg viewBox="0 0 24 24" title="Tablet"><rect x="2" y="4" width="20" height="12" rx="2" ry="2"/><line x1="2" y1="20" x2="22" y2="20"/><line x1="12" y1="16" x2="12" y2="20"/></svg>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <section class="steps-section">
                <div class="wrap">
                    <div class="section-head"><h2>Download in 3 simple steps</h2><p>No account, complicated settings, or software installation required.</p></div>
                    <div class="steps-flow">

                        <!-- Step 1: Copy Link -->
                        <div class="step">
                            <div class="step-icon-box" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </div>
                            <h3>1. Copy Link</h3>
                            <p>Find the video you want to download and copy its URL from the browser's address bar.</p>
                        </div>

                        <!-- Step 2: Paste URL -->
                        <div class="step">
                            <div class="step-icon-box" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                            </div>
                            <h3>2. Paste URL</h3>
                            <p>Paste the link into the URL input field above and our engine will analyze the content immediately.</p>
                        </div>

                        <!-- Step 3: Download -->
                        <div class="step">
                            <div class="step-icon-box" aria-hidden="true">
                                <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </div>
                            <h3>3. Download</h3>
                            <p>Choose your preferred resolution and format, then click download to save it to your device.</p>
                        </div>

                    </div>
                </div>
            </section>
            @include('partials.platforms')
            <section>
                <div class="wrap">
                    <div class="section-head"><h2>Frequently asked questions</h2><p>Quick answers about using HDVideoDownloader.</p></div>
                    <div class="faq">
                        <details><summary>Do I need to install an app?</summary><p>No. The downloader runs in your browser on mobile and desktop devices.</p></details>
                        <details><summary>Which video qualities are available?</summary><p>Available formats depend on the source and may include SD, 720p, 1080p, and audio-only options.</p></details>
                        <details><summary>Is HDVideoDownloader free?</summary><p>Yes, the basic public-link downloader experience is free to use.</p></details>
                        <details><summary>Can I download any video?</summary><p>Only download content you own or have permission to save, and follow the source platform's terms.</p></details>
                    </div>
                </div>
            </section>
            @include('partials.blog')
        </main>
    @elseif ($page === 'platforms')
        <main>
            <div class="platforms-page-hero">
                <div class="wrap">
                    <span class="blog-badge">Integrations</span>
                    <h1>Download From <span>Anywhere</span></h1>
                    <p>HDVideoDownloader supports saving media from all your favorite social networks and video platforms. Paste a link and we'll handle the rest.</p>
                </div>
            </div>
            @include('partials.platforms')
        </main>
    @elseif ($page === 'blog')
        <main>
            <div class="blog-page-hero">
                <div class="wrap">
                    <span class="blog-badge">Blogs</span>
                    <h1>Insights, <span>Trends</span> &<br><span>Downloading</span> Inspiration</h1>
                    <p>Explore expert insights, industry trends, and downloading guides to help you get the best media quality across all platforms.</p>
                </div>
            </div>
            @include('partials.blog')
        </main>
    @elseif ($page === 'blog-post')
        <main class="article-page">
            <article>
                <header class="article-hero">
                    <div class="wrap article-hero-grid">
                        <div>
                            <a class="article-back" href="{{ route('blog') }}">← All guides</a>
                            <div class="article-meta"><span>{{ $post['category'] }}</span><time>{{ $post['published'] }}</time><span>{{ $post['read'] }}</span></div>
                            <h1>{{ $post['title'] }}</h1>
                            <p>{{ $post['excerpt'] }}</p>
                        </div>
                        <img src="{{ asset($post['image']) }}" alt="{{ $post['title'] }}" width="960" height="540">
                    </div>
                </header>
                <div class="wrap article-layout">
                    <div class="article-body">
                        <div class="article-content">{!! $post['content'] !!}</div>
                        <div class="article-callout"><strong>Important:</strong> Download only content you own or have permission to save. Public availability does not automatically grant permission to republish or redistribute a video.</div>
                        <h2>Use HDVideoDownloader</h2>
                        <p>Paste a supported public link into the downloader, review the direct formats detected from the source, and choose the option that fits your device. HDVideoDownloader does not require an account for the basic link-analysis flow.</p>
                        <a class="article-cta" href="{{ route('home') }}">Open video downloader →</a>
                    </div>
                    <aside class="article-aside">
                        <strong>In this guide</strong>
                        <a href="#">What you should know</a>
                        <a href="#">Practical recommendations</a>
                        <a href="#">Quality and formats</a>
                        <a href="{{ route('home') }}">Try the downloader</a>
                    </aside>
                </div>
            </article>
            <section class="related-section"><div class="wrap"><div class="section-head"><h2>Related guides</h2><p>Continue learning about video formats, quality, and safer downloads.</p></div><div class="grid blog-grid">@foreach($relatedPosts as $related)<article class="post-card"><a class="post-cover" href="{{ route('blog.show', $related['slug']) }}"><img src="{{ asset($related['image']) }}" alt="{{ $related['title'] }}" loading="lazy"></a><div class="post-content"><div class="post-meta"><span>{{ $related['category'] }}</span><span>{{ $related['read'] }}</span></div><h3>{{ $related['title'] }}</h3><p>{{ $related['excerpt'] }}</p><a class="read" href="{{ route('blog.show', $related['slug']) }}">Read guide →</a></div></article>@endforeach</div></div></section>
        </main>
    @else
        <main>
            <div class="privacy-hero">
                <div class="wrap">
                    <span class="blog-badge">Legal</span>
                    <h1>Privacy <span>Policy</span></h1>
                    <p>Learn how we handle your data and respect your privacy at HDVideoDownloader.</p>
                </div>
            </div>
            <section class="privacy-content-wrap">
                <div class="privacy-box">
                    <h2>Our Commitment</h2>
                    <p>HDVideoDownloader is designed as a link analysis and download interface. We do not ask users to create an account for the basic paste-link flow, ensuring your activity remains mostly anonymous.</p>
                    
                    <h2>Data Processing</h2>
                    <p>Submitted URLs may be processed temporarily to detect the platform and available formats. Do not paste private, sensitive, or unauthorized links. We do not store or keep records of the specific videos you download.</p>
                    
                    <h2>User Responsibilities</h2>
                    <p>By using our service, you agree to the following:</p>
                    <ul>
                        <li>Respect the terms of service of the respective platforms you download from.</li>
                        <li>Acknowledge and respect the rights of content creators.</li>
                        <li>Abide by the copyright laws applicable in your country.</li>
                    </ul>
                    <p>We provide the tool; you are responsible for how you use the downloaded content.</p>
                </div>
            </section>
        </main>
    @endif

    <footer><div class="wrap footer-row"><span>© {{ date('Y') }} HDVideoDownloader. All rights reserved.</span><span>Domain-ready brand: hdvideodownloader</span></div></footer>
    <script>
        function startFileDownload(url) {
            var a = document.createElement('a');
            a.href = url;
            a.download = '';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        document.addEventListener('click', async function (event) {
            // Let .direct-download links behave normally (native browser download)
            
            var prepareButton = event.target.closest('.prepare-download');
            if (!prepareButton || prepareButton.disabled) return;

            var originalHtml = prepareButton.innerHTML;
            prepareButton.disabled = true;
            prepareButton.classList.add('is-loading');
            prepareButton.innerHTML = 'Preparing...';

            try {
                var response = await fetch(prepareButton.dataset.prepareUrl, {
                    headers: { 'Accept': 'application/json' }
                });
                if (!response.ok) throw new Error('Preparation failed');
                var data = await response.json();
                if (!data.download_url) throw new Error('Download unavailable');
                startFileDownload(data.download_url);
                prepareButton.innerHTML = 'Started';
            } catch (error) {
                prepareButton.innerHTML = 'Try again';
            }

            window.setTimeout(function () {
                prepareButton.innerHTML = originalHtml;
                prepareButton.disabled = false;
                prepareButton.classList.remove('is-loading');
            }, 3000);
        });

        // AJAX Form Submission & Auto-Fetch
        const analyzeForm = document.getElementById('analyze-form');
        const urlInput = document.getElementById('video-url-input');
        const analyzeBtn = document.getElementById('analyze-btn');
        const resultContainer = document.getElementById('result-container');
        const errorContainer = document.getElementById('error-container');
        
        async function fetchResult(url) {
            if (!url || !/^https?:\/\//i.test(url)) return;
            if (analyzeBtn) {
                analyzeBtn.disabled = true;
                analyzeBtn.innerHTML = '<svg style="display:inline-block;vertical-align:middle;margin-right:8px;animation:spin 1s linear infinite" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="2" x2="12" y2="6"/><line x1="12" y1="18" x2="12" y2="22"/><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"/><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"/><line x1="2" y1="12" x2="6" y2="12"/><line x1="18" y1="12" x2="22" y2="12"/><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"/><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"/></svg><span>Analyzing...</span>';
            }
            if (errorContainer) {
                errorContainer.style.display = 'none';
                errorContainer.innerText = '';
            }
            
            const defaultNote = document.getElementById('default-note');
            if (defaultNote) defaultNote.style.display = 'none';
            
            if (resultContainer) {
                resultContainer.innerHTML = `
                    <div class="loader-container result-fade-in">
                        <div class="spinner"></div>
                        <div class="loader-text">Analyzing link and fetching formats...</div>
                    </div>
                `;
            }
            document.querySelector('.download-panel').classList.add('has-result');
            
            try {
                const formData = new FormData(analyzeForm);
                formData.set('video_url', url);
                
                const response = await fetch("{{ route('analyze') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const data = await response.json();
                if (data.success) {
                    if (resultContainer) resultContainer.innerHTML = `<div class="result-fade-in">${data.html}</div>`;
                } else {
                    if (errorContainer) {
                        errorContainer.innerText = data.error || 'Failed to retrieve video data.';
                        errorContainer.style.display = 'block';
                    }
                    document.querySelector('.download-panel').classList.remove('has-result');
                }
            } catch (error) {
                if (errorContainer) {
                    errorContainer.innerText = 'An error occurred while connecting to the server.';
                    errorContainer.style.display = 'block';
                }
                document.querySelector('.download-panel').classList.remove('has-result');
            } finally {
                if (analyzeBtn) {
                    analyzeBtn.disabled = false;
                    analyzeBtn.innerHTML = '<svg style="display:inline-block;vertical-align:middle;margin-right:8px;flex-shrink:0" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg><span>Download</span>';
                }
            }
        }

        if (analyzeForm && urlInput) {
            analyzeForm.addEventListener('submit', function(e) {
                e.preventDefault();
                fetchResult(urlInput.value.trim());
            });
            
            let typingTimer;
            urlInput.addEventListener('input', function() {
                clearTimeout(typingTimer);
                const val = this.value.trim();
                if (val && /^https?:\/\//i.test(val)) {
                    typingTimer = setTimeout(function() {
                        fetchResult(val);
                    }, 600); // 600ms debounce
                }
            });
            
            urlInput.addEventListener('paste', function(e) {
                setTimeout(function() {
                    const val = urlInput.value.trim();
                    if (val && /^https?:\/\//i.test(val)) {
                        fetchResult(val);
                    }
                }, 100);
            });
        }
    </script>
</body>
</html>
