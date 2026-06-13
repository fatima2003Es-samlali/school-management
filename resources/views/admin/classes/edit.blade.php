@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit class</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.classes.update', $class) }}">
        @csrf @method('PUT')
        @include('admin.classes.form')
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.classes.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
