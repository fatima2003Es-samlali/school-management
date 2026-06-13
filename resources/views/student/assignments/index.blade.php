@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Mes devoirs</h1>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Title</th><th>Teacher</th><th>Class</th><th>Due date</th><th>File / Link</th></tr></thead>
            <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>
                        <strong>{{ $assignment->title }}</strong>
                        <div class="small text-muted">{{ $assignment->description }}</div>
                    </td>
                    <td>{{ optional(optional($assignment->teacher)->user)->name }}</td>
                    <td>{{ optional($assignment->schoolClass)->name }}</td>
                    <td>{{ $assignment->due_date->format('Y-m-d') }}</td>
                    <td>
                        @if($assignment->file_link)
                            <a href="{{ $assignment->file_link }}" target="_blank">Open</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No devoirs found for your class.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $assignments->links() }}
</div>
@endsection
