@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit devoir</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('teacher.assignments.update', $assignment) }}">
        @csrf @method('PUT')
        @include('teacher.assignments.form')
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('teacher.assignments.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
