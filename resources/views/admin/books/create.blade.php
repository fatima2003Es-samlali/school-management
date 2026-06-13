@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Add book</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.books.store') }}">
        @csrf
        @include('admin.books.form')
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
