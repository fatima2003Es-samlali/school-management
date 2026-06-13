@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Classes</h1>
    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">Add class</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th>Name</th><th>Level</th><th>Description</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            @forelse($classes as $class)
                <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->level }}</td>
                    <td>{{ $class->description }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.classes.edit', $class) }}">Edit</a>
                        <form class="d-inline" method="POST" action="{{ route('admin.classes.destroy', $class) }}" onsubmit="return confirm('Delete this class?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">No classes found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $classes->links() }}
</div>
@endsection
