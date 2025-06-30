@extends('components.layouts.base')

@section('title', 'Add User')

@section('content')
<section>
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1>
            <span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">ADD</span> USER
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('user.index') }}">User</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Create</a>
        </nav>
    </div>

    <div class="container my-5" style="max-width:700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4" style="color:#a83429;">New User</h3>

            @if(session()->has('errorMessage'))
                <div class="alert alert-danger">{{ session('errorMessage') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-2"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
