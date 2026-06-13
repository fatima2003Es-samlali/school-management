@extends('layouts.app')

@section('content')
<div class="row g-3 mb-4">
    <x-stat-card label="Devoirs" :value="$assignmentsCount" icon="bi-journal-check" />
    <x-stat-card label="Books" :value="$booksCount" icon="bi-book" tone="purple" />
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-start gap-3">
                <div class="stat-icon flex-shrink-0">
                    <i class="bi bi-building"></i>
                </div>
                <div>
                    <p class="text-muted mb-1 small fw-semibold">My Class</p>
                    @if($studentClass)
                        <h5 class="text-primary mb-1">{{ $studentClass->name }}</h5>
                        @if($studentClass->level)
                            <div class="text-muted small mb-1">Level: {{ $studentClass->level }}</div>
                        @endif
                        @if($studentClass->description)
                            <p class="text-muted small mb-0">{{ $studentClass->description }}</p>
                        @endif
                    @else
                        <p class="mb-0 text-muted">No class assigned</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-start gap-3">
                <div class="stat-icon flex-shrink-0">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="w-100">
                    <p class="text-muted mb-2 small fw-semibold">Class Teachers</p>
                    @if($classTeachers->isNotEmpty())
                        <div class="d-flex flex-column gap-2">
                            @foreach($classTeachers as $teacher)
                                <div class="border rounded-3 p-2 bg-light">
                                    <div class="fw-semibold text-primary">{{ optional($teacher->user)->name ?? 'Teacher' }}</div>
                                    @if(optional($teacher->user)->email)
                                        <div class="text-muted small">{{ $teacher->user->email }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mb-0 text-muted">No teachers assigned to this class</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
