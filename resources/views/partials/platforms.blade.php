<section class="content-band">
    <div class="wrap">
        <div class="section-head">
            <h2>Supported platforms</h2>
            <p>Designed for popular public video sources, with visual platform cards users can scan quickly.</p>
        </div>
        <div class="grid platform-grid">
            @foreach ($platforms as $platform)
                <div class="platform-card" style="--platform-accent:{{ $platform['accent'] }}">
                    <div class="platform-card-top">
                        <div class="platform-icon"><img src="https://cdn.simpleicons.org/{{ $platform['icon'] }}/ffffff" alt="" loading="lazy"></div>
                        <span class="platform-arrow" aria-hidden="true">↗</span>
                    </div>
                    <div class="platform-card-copy">
                        <h3>{{ $platform['name'] }}</h3>
                        <p>Download public videos in available formats and quality.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
