<link rel="stylesheet" href="/css/navbar.css">
<header class="topbar">
    <nav class="wrap nav">
        <a class="brand" href="{{ route('home') }}" aria-label="HDVideoDownloader home">
            <img src="/images/Logo_Website.png" alt="HD Video Downloader" style="height: 60px; width: auto; object-fit: contain;">
        </a>
        <button class="menu-toggle" aria-label="Toggle menu"><span></span></button>
        <div class="nav-links">
            <a class="{{ ($page ?? "") === 'home' ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            @php
                $menuPlatforms = \App\Models\Platform::whereNull('parent_id')
                    ->where('status', 'active')
                    ->with('children')
                    ->orderBy('name')
                    ->get();
            @endphp
            <div class="nav-dropdown-wrap {{ ($page ?? "") === 'platforms' ? 'active' : '' }}">
                <a class="dropdown-trigger {{ ($page ?? "") === 'platforms' ? 'active' : '' }}" style="cursor:pointer;">Supported Platforms <svg style="display:inline-block;width:12px;height:12px;margin-left:3px;vertical-align:middle;stroke:currentColor;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg></a>
                <div class="mega-menu">
                    <div class="mega-menu-grid">
                        @foreach($menuPlatforms as $mp)
                        @php
                            $icoName = strtolower($mp->name);
                            if($icoName == 'twitter' || $icoName == 'x') $icoName = 'x';
                            
                            if(!empty($mp->icon) && strpos($mp->icon, 'fa-') !== false) {
                                $mpIconHtml = '<i class="'.$mp->icon.'"></i>';
                            } else {
                                $iconSlug = (!empty($mp->icon) && strpos($mp->icon, 'fa-') === false) ? strtolower($mp->icon) : $icoName;
                                $mpIconHtml = '<img src="https://cdn.simpleicons.org/'.$iconSlug.'/39e1b6" alt="" width="18" height="18" style="display:block;">';
                            }
                            $hasKids = $mp->children->isNotEmpty();
                        @endphp
                        <div style="position:relative;" class="mega-parent-wrap {{ $hasKids ? 'has-kids' : '' }}">
                            <a href="{{ route('platforms.show', $mp->slug) }}/" class="mega-item">
                                <div class="mega-icon">{!! $mpIconHtml !!}</div>
                                <span style="text-transform:uppercase;">{{ $mp->name }}</span>
                                @if($hasKids)
                                <i class="fas fa-chevron-right" style="margin-left:auto;font-size:0.65rem;color:#39e1b6;flex-shrink:0;"></i>
                                @endif
                            </a>
                            @if($hasKids)
                            <div class="mega-child-menu">
                                @foreach($mp->children as $child)
                                @php
                                    $cIconSource = !empty($child->icon) ? $child->icon : $mp->icon;
                                    $cIcoNameFallback = !empty($child->icon) ? strtolower($child->name) : strtolower($mp->name);
                                    if($cIcoNameFallback == 'twitter' || $cIcoNameFallback == 'x') $cIcoNameFallback = 'x';

                                    if(!empty($cIconSource) && strpos($cIconSource, 'fa-') !== false) {
                                        $cIconHtml = '<i class="'.$cIconSource.'"></i>';
                                    } else {
                                        $cIconSlug = (!empty($cIconSource) && strpos($cIconSource, 'fa-') === false) ? strtolower($cIconSource) : $cIcoNameFallback;
                                        $cIconHtml = '<img src="https://cdn.simpleicons.org/'.$cIconSlug.'/39e1b6" alt="" width="14" height="14" style="display:block;">';
                                    }
                                @endphp
                                <a href="{{ route('platforms.show', $child->slug) }}/" class="mega-item mega-child-item">
                                    <div class="mega-icon" style="width:28px;height:28px;">{!! $cIconHtml !!}</div>
                                    <span style="text-transform:uppercase;font-size:0.78rem;">{{ $child->name }}</span>
                                </a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <div class="mega-footer">
                        <a href="{{ route('platforms') }}" class="mega-all-link">View all platforms <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <a class="{{ in_array(($page ?? ''), ['blog', 'blog-post']) ? 'active' : '' }}" href="{{ route('blog') }}/">Blog</a>
            <a class="{{ ($page ?? "") === 'privacy' ? 'active' : '' }}" href="{{ route('privacy') }}/">Privacy</a>
            <!-- Language Selector -->
            <div class="lang-selector notranslate" id="langSelector" translate="no">
                <button class="lang-btn" id="langBtn" aria-haspopup="listbox" aria-expanded="false" aria-label="Select language">
                    <svg class="lang-globe" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    <span id="langLabel">English</span>
                    <svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                </button>
                <div class="lang-dropdown notranslate" id="langDropdown" role="listbox" aria-label="Languages" translate="no">
                    <div class="lang-dropdown-inner">
                        <div class="lang-option active" data-lang="en"    data-label="English"    role="option">English</div>
                        <div class="lang-option"        data-lang="ar"    data-label="العربية"    role="option">العربية</div>
                        <div class="lang-option"        data-lang="ur"    data-label="اردو"       role="option">اردو</div>
                        <div class="lang-option"        data-lang="hi"    data-label="हिंदी"      role="option">हिंदी</div>
                        <div class="lang-option"        data-lang="es"    data-label="Español"    role="option">Español</div>
                        <div class="lang-option"        data-lang="fr"    data-label="Français"   role="option">Français</div>
                        <div class="lang-option"        data-lang="pt"    data-label="Português"  role="option">Português</div>
                        <div class="lang-option"        data-lang="ko"    data-label="한국어"      role="option">한국어</div>
                        <div class="lang-option"        data-lang="tr"    data-label="Türkçe"     role="option">Türkçe</div>
                        <div class="lang-option"        data-lang="vi"    data-label="Tiếng Việt" role="option">Tiếng Việt</div>
                        <div class="lang-option"        data-lang="ru"    data-label="Русский"    role="option">Русский</div>
                        <div class="lang-option"        data-lang="it"    data-label="Italiano"   role="option">Italiano</div>
                        <div class="lang-option"        data-lang="de"    data-label="Deutsch"    role="option">Deutsch</div>
                        <div class="lang-option"        data-lang="zh-CN" data-label="中文"        role="option">中文</div>
                        <div class="lang-option"        data-lang="ja"    data-label="日本語"      role="option">日本語</div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const navLinks = document.querySelector('.nav-links');
        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', function() {
                menuToggle.classList.toggle('is-open');
                navLinks.classList.toggle('is-open');
            });
        }

        // Language Selector
        (function() {
            var selector = document.getElementById('langSelector');
            var btn      = document.getElementById('langBtn');
            var label    = document.getElementById('langLabel');
            var options  = document.querySelectorAll('.lang-option');
            if (!selector || !btn) return;

            // Toggle dropdown
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                var isOpen = selector.classList.toggle('open');
                btn.setAttribute('aria-expanded', isOpen);
            });

            // Close on outside click
            document.addEventListener('click', function(e) {
                if (!selector.contains(e.target)) {
                    selector.classList.remove('open');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });

            // Language option click
            options.forEach(function(opt) {
                opt.addEventListener('click', function() {
                    var lang     = this.getAttribute('data-lang');
                    var langName = this.getAttribute('data-label');

                    // Update active state
                    options.forEach(function(o) { o.classList.remove('active'); });
                    this.classList.add('active');

                    // Update button label
                    if (label) label.textContent = langName;

                    // Save to localStorage
                    localStorage.setItem('hd_lang', lang);
                    localStorage.setItem('hd_lang_label', langName);

                    // Close dropdown
                    selector.classList.remove('open');
                    btn.setAttribute('aria-expanded', 'false');

                    // Apply translation via Google Translate
                    applyGoogleTranslate(lang);
                });
            });

            // Restore saved language on page load
            var savedLang  = localStorage.getItem('hd_lang');
            var savedLabel = localStorage.getItem('hd_lang_label');
            if (savedLang && savedLang !== 'en') {
                if (label) label.textContent = savedLabel || savedLang;
                options.forEach(function(o) {
                    o.classList.toggle('active', o.getAttribute('data-lang') === savedLang);
                });
                applyGoogleTranslate(savedLang);
            }

            function applyGoogleTranslate(lang) {
                if (lang === 'en') {
                    document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    document.cookie = 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=' + location.hostname + ';';
                    location.reload();
                    return;
                }
                var val = '/en/' + lang;
                document.cookie = 'googtrans=' + val + '; path=/';
                document.cookie = 'googtrans=' + val + '; path=/; domain=' + location.hostname;

                if (!window._gtLoaded) {
                    window._gtLoaded = true;
                    window.googleTranslateElementInit = function() {
                        new google.translate.TranslateElement({ pageLanguage:'en', autoDisplay:false }, 'gt-root');
                    };
                    var s = document.createElement('script');
                    s.src = '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
                    document.head.appendChild(s);
                    var el = document.createElement('div');
                    el.id = 'gt-root';
                    el.style.display = 'none';
                    document.body.appendChild(el);
                } else {
                    location.reload();
                }
            }

            // Aggressively kill Google Translate bar every 50ms
            setInterval(function() {
                var f = document.querySelector('iframe.goog-te-banner-frame');
                if (f) f.style.setProperty('display','none','important');
                if (document.body.style.top && document.body.style.top !== '0px') {
                    document.body.style.setProperty('top','0','important');
                }
            }, 50);
        })();
    });
</script>
