@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Bibliotheque</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add book</a>
</div>
<div class="card p-3">
    @include('library.table', ['books' => $books, 'admin' => true])
</div>
@endsection
