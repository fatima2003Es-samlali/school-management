@extends('layouts.app')

@section('content')
<div class="row g-3 mb-4">
    <x-stat-card label="Classes" :value="$classesCount" icon="bi-building" />
    <x-stat-card label="Teachers" :value="$teachersCount" icon="bi-person-workspace" tone="success" />
    <x-stat-card label="Students" :value="$studentsCount" icon="bi-people" tone="info" />
    <x-stat-card label="Books" :value="$booksCount" icon="bi-book" tone="purple" />
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Students by class</h5>
                    <p class="text-muted small mb-0">Student count grouped by class.</p>
                </div>
                <form method="GET" class="chart-filter">
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    <select name="class_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All classes</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" @selected($selectedClass == $class->id)>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($studentsByClassData->sum() > 0)
                <div class="chart-box"><canvas id="studentsByClassChart"></canvas></div>
            @else
                <div class="empty-state p-4 text-center">No student data available.</div>
            @endif
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Books by category</h5>
                    <p class="text-muted small mb-0">Book count grouped by category.</p>
                </div>
                <form method="GET" class="chart-filter">
                    <input type="hidden" name="class_id" value="{{ $selectedClass }}">
                    <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All categories</option>
                        @foreach($bookCategories as $category)
                            <option value="{{ $category }}" @selected($selectedCategory === $category)>{{ $category }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($booksByCategoryData->sum() > 0)
                <div class="chart-box"><canvas id="booksByCategoryChart"></canvas></div>
            @else
                <div class="empty-state p-4 text-center">No book category data available.</div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const studentsChart = document.getElementById('studentsByClassChart');
    if (studentsChart) {
        new Chart(studentsChart, {
            type: 'bar',
            data: {
                labels: @json($studentsByClassLabels),
                datasets: [{ label: 'Students', data: @json($studentsByClassData), backgroundColor: '#0d6efd', borderRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }

    const booksChart = document.getElementById('booksByCategoryChart');
    if (booksChart) {
        new Chart(booksChart, {
            type: 'bar',
            data: {
                labels: @json($booksByCategoryLabels),
                datasets: [{ label: 'Books', data: @json($booksByCategoryData), backgroundColor: '#4dabf7', borderRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }
</script>
@endpush
