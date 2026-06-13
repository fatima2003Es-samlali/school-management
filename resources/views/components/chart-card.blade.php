@props([
    'title',
    'subtitle' => null,
    'canvas',
    'empty' => false,
])

<div {{ $attributes->merge(['class' => 'card chart-card h-100 p-3 p-lg-4']) }}>
    <div class="d-flex align-items-start justify-content-between mb-3">
        <div>
            <h5 class="mb-1">{{ $title }}</h5>
            @if($subtitle)
                <p class="text-muted small mb-0">{{ $subtitle }}</p>
            @endif
        </div>
        <span class="badge text-bg-primary-subtle text-primary">Chart</span>
    </div>

    @if($empty)
        <div class="empty-state d-flex align-items-center justify-content-center text-center p-4 flex-grow-1">
            <div>
                <i class="bi bi-bar-chart fs-2 text-primary"></i>
                <p class="mb-0 mt-2">No data available yet.</p>
            </div>
        </div>
    @else
        <div class="chart-box">
            <canvas id="{{ $canvas }}"></canvas>
        </div>
    @endif
</div>
