@extends('layouts.admin_master')

@section('title', 'Dashboard')

@section('header_icon')
    <i class="fas fa-th-large" style="color:#FFB800;"></i>
@endsection

@section('header_title', 'Dashboard Overview')

@section('breadcrumb')
    <!-- Already at root -->
@endsection

@push('styles')
    <style>
        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.2rem;margin-bottom:2rem;}
        .stat-card{background:#161B27;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:1.4rem;transition:transform 0.2s,border-color 0.2s;}
        .stat-card:hover{transform:translateY(-3px);border-color:rgba(255,184,0,0.2);}
        .stat-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem; line-height: 1.45; }
        .stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
        .stat-icon.yellow{background:rgba(255,184,0,0.15);color:#FFB800;}
        .stat-icon.green{background:rgba(34,197,94,0.15);color:#4ADE80;}
        .stat-icon.blue{background:rgba(99,102,241,0.15);color:#818CF8;}
        .stat-icon.red{background:rgba(239,68,68,0.15);color:#FCA5A5;}
        .stat-badge{font-size:0.72rem;font-weight:600;padding:0.2rem 0.5rem;border-radius:6px;background:rgba(34,197,94,0.1);color:#4ADE80;}
        .stat-value{font-size:1.9rem;font-weight:800;color:#fff;line-height:1;}
        .stat-label{font-size:0.78rem;color:rgba(255,255,255,0.4);margin-top:0.3rem;}
        
        .charts-row{display:grid;grid-template-columns:2fr 1fr;gap:1.2rem;margin-bottom:2rem;}
        .card{background:#161B27;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:1.5rem;}
        .card-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:1.2rem;}
        .card-header h3{font-size:0.95rem;font-weight:700;color:#fff;}
        .card-header span{font-size:0.75rem;color:rgba(255,255,255,0.35);}
        
        .bar-chart{display:flex;align-items:flex-end;gap:0.6rem;height:140px;}
        .bar-wrap{flex:1;display:flex;flex-direction:column;align-items:center;gap:0.4rem; line-height: 1.45; }
        .bar{width:100%;border-radius:6px 6px 0 0;background:linear-gradient(180deg,#FFB800,#FF8C00);min-height:4px;transition:height 0.5s;}
        .bar-label{font-size:0.65rem;color:rgba(255,255,255,0.3);}
        .bar-count{font-size:0.6rem;color:rgba(255,255,255,0.25);margin-bottom:2px;}
        
        .platform-list{display:flex;flex-direction:column;gap:0.75rem;}
        .platform-item{display:flex;align-items:center;gap:0.8rem;}
        .platform-dot{width:10px;height:10px;border-radius:3px;flex-shrink:0;}
        .platform-name{font-size:0.82rem;color:rgba(255,255,255,0.7);flex:1;}
        .platform-bar-wrap{width:80px;height:6px;background:rgba(255,255,255,0.06);border-radius:3px;overflow:hidden; line-height: 1.45; }
        .platform-bar{height:100%;border-radius:3px;transition:width 0.6s ease;}
        .platform-pct{font-size:0.75rem;color:rgba(255,255,255,0.4);min-width:30px;text-align:right;}

        .table-card{background:#161B27;border:1px solid rgba(255,255,255,0.06);border-radius:16px;overflow:hidden;}
        .table-head{display:flex;align-items:center;justify-content:space-between;padding:1.2rem 1.5rem;border-bottom:1px solid rgba(255,255,255,0.06);}
        .table-head h3{font-size:0.95rem;font-weight:700;color:#fff;}
        
        table{width:100%;border-collapse:collapse;}
        th{text-align:left;font-size:0.72rem;font-weight:600;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:0.06em;padding:0.75rem 1.5rem;background:rgba(255,255,255,0.02);}
        td{padding:0.9rem 1.5rem;font-size:0.83rem;color:rgba(255,255,255,0.7);border-top:1px solid rgba(255,255,255,0.04);}
        tr:hover td{background:rgba(255,255,255,0.02);}

        .platform-tag{display:inline-flex;align-items:center;gap:0.4rem;padding:0.25rem 0.7rem;border-radius:6px;font-size:0.75rem;font-weight:600;}
        .tag-youtube{background:rgba(255,0,0,0.12);color:#FF6B6B;}
        .tag-instagram{background:rgba(228,64,95,0.12);color:#E4405F;}
        .tag-tiktok{background:rgba(0,242,234,0.12);color:#00F2EA;}
        .tag-facebook{background:rgba(24,119,242,0.12);color:#1877F2;}
        .tag-other{background:rgba(107,114,128,0.15);color:#9CA3AF;}
        
        .status-dot{width:8px;height:8px;border-radius:50%;display:inline-block;margin-right:0.4rem;}
        .status-ok{background:#4ADE80;}
        .status-fail{background:#FCA5A5;}

        .quick-row{display:grid;grid-template-columns:repeat(3,1fr);gap:1.2rem;margin-top:1.2rem;}
        .quick-card{background:#161B27;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:1.2rem 1.5rem;display:flex;align-items:center;gap:1rem;}
        .quick-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}
        .quick-card h4{font-size:1.1rem;font-weight:700;color:#fff;}
        .quick-card p{font-size:0.75rem;color:rgba(255,255,255,0.35);margin-top:1px; line-height: 1.45; }
    </style>
@endpush

@section('content')
    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon yellow"><i class="fas fa-download"></i></div>
                <span class="stat-badge">Total</span>
            </div>
            <div class="stat-value" id="stat-total-downloads">{{ number_format($stats['total_downloads']) }}</div>
            <div class="stat-label">Total Downloads</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon green"><i class="fas fa-calendar-day"></i></div>
                <span class="stat-badge">Today</span>
            </div>
            <div class="stat-value" id="stat-today-downloads">{{ number_format($stats['today_downloads']) }}</div>
            <div class="stat-label">Today's Downloads</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon blue"><i class="fas fa-search"></i></div>
                <span class="stat-badge">Total</span>
            </div>
            <div class="stat-value" id="stat-extractions">{{ number_format($stats['total_extractions']) }}</div>
            <div class="stat-label">Total Extractions</div>
        </div>
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon red"><i class="fas fa-users"></i></div>
                <span class="stat-badge">30 min</span>
            </div>
            <div class="stat-value" id="stat-active-users">{{ number_format($stats['active_users']) }}</div>
            <div class="stat-label">Active Users</div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="charts-row">
        <div class="card">
            <div class="card-header">
                <h3>Downloads (Last 7 Days)</h3>
                <span>Weekly overview</span>
            </div>
            <div class="bar-chart" id="bar-chart">
                @php $maxVal = max(array_column($weeklyData, 'count') ?: [1]); @endphp
                @foreach($weeklyData as $day)
                <div class="bar-wrap">
                    <div class="bar-count">{{ $day['count'] > 0 ? $day['count'] : '' }}</div>
                    <div class="bar" style="height:{{ $maxVal > 0 ? round(($day['count'] / $maxVal) * 120) : 4 }}px;"></div>
                    <div class="bar-label">{{ $day['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>By Platform</h3>
                <span>Top sources</span>
            </div>
            <div class="platform-list" id="platform-list">
                @foreach($platformData as $p)
                <div class="platform-item">
                    <div class="platform-dot" style="background:{{ $p['color'] }};"></div>
                    <span class="platform-name">{{ $p['name'] }}</span>
                    <div class="platform-bar-wrap">
                        <div class="platform-bar" style="width:{{ $p['pct'] }}%;background:{{ $p['color'] }};"></div>
                    </div>
                    <span class="platform-pct">{{ $p['pct'] }}%</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- RECENT ACTIVITY -->
    <div class="table-card">
        <div class="table-head">
            <h3>Recent Download Activity</h3>
            <button class="btn-preview" onclick="refreshDashboard()" id="refreshBtn">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Platform</th>
                    <th>Type</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody id="activity-tbody">
                @forelse($recentLogs as $i => $log)
                <tr>
                    <td style="color:rgba(255,255,255,0.25);">{{ $i + 1 }}</td>
                    <td><span class="platform-tag tag-other">{{ $log->platform }}</span></td>
                    <td>{{ $log->type }}</td>
                    <td style="font-family:monospace;">{{ $log->ip_address }}</td>
                    <td><span class="status-dot {{ $log->status ? 'status-ok' : 'status-fail' }}"></span>{{ $log->status ? 'Success' : 'Failed' }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:2rem;color:rgba(255,255,255,0.2);">No activity yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- QUICK STATS -->
    <div class="quick-row">
        <div class="quick-card">
            <div class="quick-icon" style="background:rgba(255,184,0,0.12);color:#FFB800;"><i class="fas fa-bolt"></i></div>
            <div>
                <h4>Success Rate</h4>
                <p style="line-height: 1.45;">98.2% Average</p>
            </div>
        </div>
        <div class="quick-card">
            <div class="quick-icon" style="background:rgba(34,197,94,0.12);color:#4ADE80;"><i class="fas fa-calendar-week"></i></div>
            <div>
                <h4>This Week</h4>
                <p style="line-height: 1.45;">{{ array_sum(array_column($weeklyData, 'count')) }} Downloads</p>
            </div>
        </div>
        <div class="quick-card">
            <div class="quick-icon" style="background:rgba(99,102,241,0.12);color:#818CF8;"><i class="fas fa-layer-group"></i></div>
            <div>
                <h4>Top Platform</h4>
                <p style="line-height: 1.45;">{{ $platformData[0]['name'] ?? '—' }}</p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        async function refreshDashboard() {
            const btn = document.getElementById('refreshBtn');
            btn.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> Refreshing...';
            // Simple reload for now to show immediate fix, can be AJAX later
            window.location.reload();
        }
    </script>
@endpush
