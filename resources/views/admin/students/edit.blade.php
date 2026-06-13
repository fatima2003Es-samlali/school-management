@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit student</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.students.update', $student) }}">
        @csrf @method('PUT')
        @include('admin.people.form', ['person' => $student, 'passwordRequired' => false])
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
