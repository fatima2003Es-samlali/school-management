@props([
    'label',
    'value',
    'icon' => 'bi-graph-up',
    'tone' => 'primary',
    'hint' => null,
])

@php
    $gradients = [
        'primary' => 'linear-gradient(135deg, #0d6efd, #6ea8fe)',
        'success' => 'linear-gradient(135deg, #198754, #63e6be)',
        'warning' => 'linear-gradient(135deg, #f59f00, #ffd43b)',
        'info' => 'linear-gradient(135deg, #0dcaf0, #74c0fc)',
        'purple' => 'linear-gradient(135deg, #6f42c1, #b197fc)',
    ];
@endphp

<div class="col-12 col-sm-6 col-xl-3">
    <div class="card stat-card h-100 p-3">
        <div class="d-flex align-items-center justify-content-between gap-3">
            <div>
                <p class="text-muted mb-1 small fw-semibold">{{ $label }}</p>
                <h2 class="mb-0 fw-bold text-primary">{{ $value }}</h2>
                @if($hint)
                    <span class="text-muted small">{{ $hint }}</span>
                @endif
            </div>
            <div class="stat-icon flex-shrink-0" style="background: {{ $gradients[$tone] ?? $gradients['primary'] }};">
                <i class="bi {{ $icon }}"></i>
            </div>
        </div>
    </div>
</div>
