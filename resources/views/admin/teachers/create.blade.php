@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Add teacher</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.teachers.store') }}">
        @csrf
        @include('admin.people.form', ['person' => null, 'passwordRequired' => true])
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
