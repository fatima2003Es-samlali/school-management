@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center p-3">
    <div class="card p-4" style="max-width: 430px; width: 100%;">
        <h2 class="text-primary mb-1">Connexion</h2>
        <p class="text-muted mb-4">School Management</p>
        @include('partials.flash')
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
