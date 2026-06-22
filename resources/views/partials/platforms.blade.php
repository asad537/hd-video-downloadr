<section class="content-band">
    <div class="wrap">
        <div class="section-head">
            <h2>Supported platforms</h2>
            <p>Designed for popular public video sources, with visual platform cards users can scan quickly.</p>
        </div>
        <div class="grid platform-grid">
            @foreach ($platforms as $platform)
                <div class="platform-card">
                    <div class="platform-icon" style="background: {{ $platform['accent'] }}"><img src="https://cdn.simpleicons.org/{{ $platform['icon'] }}/ffffff" alt="{{ $platform['name'] }} icon" loading="lazy" style="width:22px;height:22px;object-fit:contain"></div>
                    <h3>{{ $platform['name'] }}</h3>
                    <p>Paste a public {{ $platform['domain'] }} video link and preview available save formats.</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
