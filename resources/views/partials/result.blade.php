<div class="result">
    @php
        $videoFormats = collect($result['resources'] ?? [])->where('category', 'video');
        $audioFormats = collect($result['resources'] ?? [])->where('category', 'audio');
        $duration = (int) ($result['duration'] ?? 0);
    @endphp
    <div class="result-layout">
        <aside class="media-summary">
            @if(!empty($result['thumbnail']))
                <img class="media-thumb" src="{{ $result['thumbnail'] }}" alt="{{ $result['title'] ?? 'Video thumbnail' }}">
            @else
                <div class="media-thumb"></div>
            @endif
            <div class="media-platform">{{ $result['platform'] }} · {{ $result['host'] }}</div>
            <h2 class="media-title">{{ $result['title'] ?? 'Video Ready' }}</h2>
            @if($duration > 0)
                <span class="media-duration">Time {{ gmdate($duration >= 3600 ? 'H:i:s' : 'i:s', $duration) }}</span>
            @endif
        </aside>
        <div class="format-list">
            @if($videoFormats->isNotEmpty())
                <section class="format-section">
                    <h3 class="format-heading"><span class="format-heading-mark">▶</span>Video</h3>
                    @foreach($videoFormats as $format)
                        @php
                            $extension = strtolower($format['format'] ?: 'mp4');
                            $filename = \Illuminate\Support\Str::slug($result['title'] ?? 'video') . '-' . strtolower($format['quality']) . '.' . $extension;
                            $source = !empty($format['download_url']) ? rtrim(strtr(base64_encode($format['download_url']), '+/', '-_'), '=') : null;
                            $downloadUrl = $source ? \Illuminate\Support\Facades\URL::temporarySignedRoute('media.download', now()->addMinutes(20), ['source' => $source, 'name' => $filename]) : null;
                            $prepareUrl = !empty($format['prepare_token']) ? \Illuminate\Support\Facades\URL::temporarySignedRoute('plugin.prepare', now()->addMinutes(25), ['token' => $format['prepare_token'], 'name' => $filename]) : null;
                        @endphp
                        <div class="format-row">
                            <span class="format-badge">{{ $format['format'] }}</span>
                            <span class="format-quality">{{ strtoupper($format['quality']) }}</span>
                            <span class="format-size">{{ $format['size'] }}</span>
                            @if($downloadUrl)
                                <a class="download-link direct-download" href="{{ $downloadUrl }}"><span class="download-arrow">↓</span>Download</a>
                            @elseif($prepareUrl)
                                <button class="download-link prepare-download" type="button" data-prepare-url="{{ $prepareUrl }}"><span class="download-arrow">↓</span>Download</button>
                            @endif
                        </div>
                    @endforeach
                </section>
            @endif
            @if($audioFormats->isNotEmpty())
                <section class="format-section">
                    <h3 class="format-heading"><span class="format-heading-mark">♫</span>Music</h3>
                    @foreach($audioFormats as $format)
                        @php
                            $extension = strtolower($format['format'] ?: 'mp3');
                            $filename = \Illuminate\Support\Str::slug($result['title'] ?? 'audio') . '-' . strtolower($format['quality']) . '.' . $extension;
                            $source = !empty($format['download_url']) ? rtrim(strtr(base64_encode($format['download_url']), '+/', '-_'), '=') : null;
                            $downloadUrl = $source ? \Illuminate\Support\Facades\URL::temporarySignedRoute('media.download', now()->addMinutes(20), ['source' => $source, 'name' => $filename]) : null;
                            $prepareUrl = !empty($format['prepare_token']) ? \Illuminate\Support\Facades\URL::temporarySignedRoute('plugin.prepare', now()->addMinutes(25), ['token' => $format['prepare_token'], 'name' => $filename]) : null;
                        @endphp
                        <div class="format-row">
                            <span class="format-badge">{{ $format['format'] }}</span>
                            <span class="format-quality">{{ strtoupper($format['quality']) }}</span>
                            <span class="format-size">{{ $format['size'] }}</span>
                            @if($downloadUrl)
                                <a class="download-link direct-download" href="{{ $downloadUrl }}"><span class="download-arrow">↓</span>Download</a>
                            @elseif($prepareUrl)
                                <button class="download-link prepare-download" type="button" data-prepare-url="{{ $prepareUrl }}"><span class="download-arrow">↓</span>Download</button>
                            @endif
                        </div>
                    @endforeach
                </section>
            @endif
            @if($videoFormats->isEmpty() && $audioFormats->isEmpty())
                <p class="empty-formats">No direct download formats were found for this link.</p>
            @endif
        </div>
    </div>
    <p class="result-note">Always download only content you own or have permission to save.</p>
</div>
