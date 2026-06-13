@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Students</h1>
    <form class="d-flex gap-2" method="GET">
        <select name="class_id" class="form-select">
            <option value="">All classes</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" @selected(request('class_id') == $class->id)>{{ $class->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary">Filter</button>
    </form>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Email</th><th>Class</th><th>Phone</th><th>Address</th></tr></thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ optional($student->schoolClass)->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->address }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No students found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $students->links() }}
</div>
@endsection
