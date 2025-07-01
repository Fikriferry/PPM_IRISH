@extends('components.layouts.base')

@section('title', 'Add Category')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat; color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1>
            <span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">ADD</span> CATEGORY
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('categories.index') }}">Categories</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Create</a>
        </nav>
    </div>

    <!-- Form Section -->
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4" style="color: #a83429;">New Product Category</h3>

            @if(session()->has('successMessage'))
                <div class="alert alert-success">
                    {{ session()->get('successMessage') }}
                </div>
            @elseif(session()->has('errorMessage'))
                <div class="alert alert-danger">
                    {{ session()->get('errorMessage') }}
                </div>
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

            <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" readonly>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function () {
            const slug = nameInput.value
                .toLowerCase()
                .replace(/[^\w\s]/g, '')  // hilangkan simbol
                .replace(/\s+/g, '-');     // ganti spasi dengan -
            slugInput.value = slug;
        });

        if (nameInput.value) {
            const event = new Event('input');
            nameInput.dispatchEvent(event);
        }
    });
</script>
@endpush
@endsection
