@extends('components.layouts.base')

@section('title', 'Edit Customer')

@section('content')
<section>
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1>
            <span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">EDIT</span> USER
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('user.index') }}">User</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Edit</a>
        </nav>
    </div>
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4 text-dark">Edit User</h3>

            @if(session()->has('successMessage'))
                <div class="alert alert-success">{{ session('successMessage') }}</div>
            @elseif(session()->has('errorMessage'))
                <div class="alert alert-danger">{{ session('errorMessage') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3">{{ old('address', $customer->address) }}</textarea>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
