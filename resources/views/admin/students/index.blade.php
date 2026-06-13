@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Students</h1>
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary">Add student</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Email</th><th>Class</th><th>Phone</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->user->email }}</td>
                    <td>{{ optional($student->schoolClass)->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.students.edit', $student) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Delete this student?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
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
