@extends('layouts.app')

@section('content')
<h1 class="h3 mb-3">Bibliotheque</h1>
<div class="card p-3">
    @include('library.table', ['books' => $books, 'admin' => false])
</div>
@endsection
