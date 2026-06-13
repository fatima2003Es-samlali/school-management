@extends('layouts.app')

@section('content')
<div class="row g-3 mb-4">
    <x-stat-card label="Students" :value="$studentsCount" icon="bi-people" />
    <x-stat-card label="Devoirs" :value="$assignmentsCount" icon="bi-journal-check" tone="warning" />
    <x-stat-card label="Books" :value="$booksCount" icon="bi-book" tone="purple" />
</div>

<div class="row g-4">
    <div class="col-xl-6">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Students by class</h5>
                    <p class="text-muted small mb-0">Students in your assigned class.</p>
                </div>
                <form method="GET">
                    <input type="hidden" name="assignment_class_id" value="{{ $selectedAssignmentClass }}">
                    <select name="student_class_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All teacher classes</option>
                        @foreach($teacherClasses as $class)
                            <option value="{{ $class->id }}" @selected($selectedStudentClass == $class->id)>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($studentsPerClassData->sum() > 0)
                <div class="chart-box"><canvas id="teacherStudentsChart"></canvas></div>
            @else
                <div class="empty-state p-4 text-center">No student data available.</div>
            @endif
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card p-3 p-lg-4 h-100">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                <div>
                    <h5 class="mb-1">Devoirs by class</h5>
                    <p class="text-muted small mb-0">Assignments created by you, grouped by class.</p>
                </div>
                <form method="GET">
                    <input type="hidden" name="student_class_id" value="{{ $selectedStudentClass }}">
                    <select name="assignment_class_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All classes</option>
                        @foreach($assignmentClasses as $class)
                            <option value="{{ $class->id }}" @selected($selectedAssignmentClass == $class->id)>{{ $class->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
            @if($assignmentsByClassData->sum() > 0)
                <div class="chart-box"><canvas id="teacherAssignmentsChart"></canvas></div>
            @else
                <div class="empty-state p-4 text-center">No devoir data available.</div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const teacherStudentsChart = document.getElementById('teacherStudentsChart');
    if (teacherStudentsChart) {
        new Chart(teacherStudentsChart, {
            type: 'bar',
            data: {
                labels: @json($studentsPerClassLabels),
                datasets: [{ label: 'Students', data: @json($studentsPerClassData), backgroundColor: '#0d6efd', borderRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }

    const teacherAssignmentsChart = document.getElementById('teacherAssignmentsChart');
    if (teacherAssignmentsChart) {
        new Chart(teacherAssignmentsChart, {
            type: 'bar',
            data: {
                labels: @json($assignmentsByClassLabels),
                datasets: [{ label: 'Devoirs', data: @json($assignmentsByClassData), backgroundColor: '#4dabf7', borderRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });
    }
</script>
@endpush
