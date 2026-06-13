@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit teacher</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}">
        @csrf @method('PUT')
        @include('admin.people.form', ['person' => $teacher, 'passwordRequired' => false])
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
