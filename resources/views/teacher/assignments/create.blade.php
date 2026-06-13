@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Add devoir</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('teacher.assignments.store') }}">
        @csrf
        @include('teacher.assignments.form')
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('teacher.assignments.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
