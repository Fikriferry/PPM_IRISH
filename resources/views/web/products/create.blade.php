@extends('components.layouts.base')

@section('title', 'Add Product')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 80px 0 30px; text-align: center;">
        <h1>
            <span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">ADD</span> PRODUCT
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('products.index') }}">Products</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Create</a>
        </nav>
    </div>

    <!-- Form Section -->
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4" style="color: #a83429;">New Product</h3>

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

            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- Slug -->
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <!-- SKU -->
                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="text" name="sku" id="sku" class="form-control" value="{{ old('sku') }}">
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}">
                </div>

                <!-- Stock -->
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image</label>
                    <input type="file" name="image_url" id="image_url" class="form-control">
                </div>

                <!-- Status -->
                <div class="form-check form-switch mb-3">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="product_category_id" class="form-label">Category</label>
                    <select name="product_category_id" id="product_category_id" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <hr>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
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
@endsection