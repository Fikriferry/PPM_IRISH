@extends('components.layouts.base')

@section('title', 'Edit Order')

@section('content')
<section>
    <!-- Hero -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 80px 0 30px; text-align: center;">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">EDIT</span> ORDER</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('orders.index') }}">Orders</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Edit</a>
        </nav>
    </div>

    <!-- Form -->
    <div class="container my-5" style="max-width: 700px;">
        <div class="card shadow rounded p-4">
            <h3 class="text-center mb-4" style="color: #a83429;">Edit Order</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $order->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label for="menu" class="form-label">Menu yang Dipilih</label>
                    <input type="text" name="menu" class="form-control" value="{{ old('menu', $order->menu) }}" required>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Pesanan</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah', $order->jumlah) }}" required>
                </div>

                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" name="total_harga" class="form-control" value="{{ old('total_harga', $order->total_harga) }}" required>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3">{{ old('catatan', $order->catatan) }}</textarea>
                </div>

                <hr>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="fas fa-save me-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection