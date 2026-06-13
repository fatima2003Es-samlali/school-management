@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Teachers</h1>
    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add teacher</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Email</th><th>Class</th><th>Phone</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->user->name }}</td>
                    <td>{{ $teacher->user->email }}</td>
                    <td>{{ optional($teacher->schoolClass)->name }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.teachers.edit', $teacher) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.teachers.destroy', $teacher) }}" onsubmit="return confirm('Delete this teacher?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No teachers found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $teachers->links() }}
</div>
@endsection
