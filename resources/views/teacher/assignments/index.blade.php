@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Devoirs</h1>
    <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary">Add devoir</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Title</th><th>Class</th><th>Due date</th><th>File / Link</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>
                        <strong>{{ $assignment->title }}</strong>
                        <div class="small text-muted">{{ $assignment->description }}</div>
                    </td>
                    <td>{{ optional($assignment->schoolClass)->name }}</td>
                    <td>{{ $assignment->due_date->format('Y-m-d') }}</td>
                    <td>
                        @if($assignment->file_link)
                            <a href="{{ $assignment->file_link }}" target="_blank">Open</a>
                        @endif
                    </td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('teacher.assignments.edit', $assignment) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('teacher.assignments.destroy', $assignment) }}" onsubmit="return confirm('Delete this devoir?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No devoirs found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $assignments->links() }}
</div>
@endsection
