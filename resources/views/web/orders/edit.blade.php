@extends('components.layouts.base')

@section('title', 'Edit Order')

@section('content')
<section>
    <div class="hero-section"
        style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat; color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">EDIT</span> ORDER</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ route('orders.index') }}">Orders</a>
            <a class="breadcrumb-item active text-light text-decoration-none" href="#">Edit</a>
        </nav>
    </div>

    <div class="container my-5" style="max-width: 850px;">
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

            <form action="{{ route('orders.update', $order->id) }}" method="POST" id="orderForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $order->nama) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Meja</label>
                    <input type="text" name="nomor_meja" class="form-control" value="{{ old('nomor_meja', $order->nomor_meja) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control">{{ old('catatan', $order->catatan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="tunai" {{ old('metode_pembayaran', $order->metode_pembayaran) == 'tunai' ? 'selected' : '' }}>Tunai</option>
                        <option value="qris" {{ old('metode_pembayaran', $order->metode_pembayaran) == 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Pesanan</label>
                    <select name="status" class="form-select" required>
                        <option value="diproses" {{ old('status', $order->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ old('status', $order->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <hr>
                <h5 class="mb-3 text-secondary">Detail Pesanan</h5>
                <div id="menu-items">
                    @foreach ($order->items as $i => $item)
                        <div class="row g-3 align-items-center border-bottom pb-3 mb-3 item-row" data-index="{{ $i }}">
                            <div class="col-md-4">
                                <label class="form-label">Pilih Menu</label>
                                <select name="items[{{ $i }}][product_id]" class="form-select product-select" required style="width: 100%;" data-price="{{ $item->product->price }}">
                                    <option value="{{ $item->product_id }}" selected>
                                        {{ $item->product->name }} - Rp{{ number_format($item->product->price) }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jumlah</label>
                                <input type="number" name="items[{{ $i }}][quantity]" class="form-control qty-input" min="1" value="{{ $item->quantity }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Subtotal</label>
                                <input type="text" class="form-control subtotal-field" readonly value="Rp{{ number_format($item->product->price * $item->quantity) }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Catatan</label>
                                <input type="text" name="items[{{ $i }}][note]" class="form-control" value="{{ $item->note }}">
                            </div>
                            <div class="col-md-1 mt-4">
                                <button type="button" class="btn btn-sm btn-danger remove-item"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" id="add-item" class="btn btn-outline-primary mt-3">
                    <i class="fas fa-plus me-1"></i> Tambah Menu
                </button>

                <div class="mt-4">
                    <h5 class="text-end">Total Harga: <span id="totalHarga" class="text-dark fw-bold">Rp0</span></h5>
                </div>

                <div class="d-flex justify-content-between mt-4">
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
