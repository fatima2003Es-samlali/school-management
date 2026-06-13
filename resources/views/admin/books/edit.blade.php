@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Edit book</h1>
<div class="card p-4">
    <form method="POST" action="{{ route('admin.books.update', $book) }}">
        @csrf @method('PUT')
        @include('admin.books.form')
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
