@extends('components.layouts.base')

@section('title', 'Edit Gallery Image')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat; color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1>
            <span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">EDIT</span> IMAGE
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('galleries.index') }}">Gallery</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Edit</a>
        </nav>
    </div>

    <!-- Form Section -->
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4" style="color: #a83429;">Update Gallery Image</h3>

            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            <form action="{{ route('galleries.update', $gallery->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Preview -->
                @if($gallery->image_path)
                    <div class="mb-3 text-center">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                @endif

                <!-- Image Input -->
                <div class="mb-3">
                    <label for="image" class="form-label">Upload New Image (optional)</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <!-- Status -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $gallery->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">
                        Active
                    </label>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('galleries.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection