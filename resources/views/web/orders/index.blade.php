@extends('components.layouts.base')

@section('title', 'Orders')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat; color: #ffffff; padding: 100px 0 40px; text-align: center;">
        <h1 style="font-weight: bold; font-size: 3rem;">
            <span style="color: #f8a42f;">ORDER</span> LIST
        </h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item active text-decoration-none text-light" href="#">Orders</a>
        </nav>
    </div>

    <!-- Content Section -->
    <div class="container my-5">
        <!-- Add Order Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form method="GET" class="d-flex w-75 row g-3">
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control border-dark" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control border-dark" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-3">
                    <select name="menu" class="form-select border-dark">
                        <option value="">-- Semua Menu --</option>
                        @foreach($productList as $product)
                            <option value="{{ $product->name }}" {{ request('menu') == $product->name ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-dark w-50">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('orders.export', request()->only(['start_date', 'end_date', 'menu'])) }}"
                       class="btn btn-success w-50">
                        <i class="fas fa-file-excel me-1"></i> Export
                    </a>
                </div>
            </form>

            <a href="{{ route('orders.create') }}" class="btn btn-outline-warning ms-3">
                <i class="fas fa-plus me-2"></i> Add Order
            </a>
        </div>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle shadow-sm">
                <thead class="table-warning">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Table</th>
                        <th>Waiters</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th>Ordered At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->nama }}</td>
                            <td>{{ $order->nomor_meja }}</td>
                            <td>{{ $order->waiter->name ?? '-' }}</td>
                            <td class="text-start">
                                <ul class="list-unstyled m-0">
                                    @foreach ($order->items as $item)
                                        <li>
                                            <strong>{{ $item->product->name }}</strong> (x{{ $item->quantity }}) -
                                            Rp{{ number_format($item->total_price, 0, ',', '.') }}
                                            @if ($item->note)
                                                <br><small class="text-muted">Catatan: {{ $item->note }}</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->metode_pembayaran) ?? '-' }}</td>
                            <td>
                                @if($order->status === 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                        onsubmit="return confirm('Ubah status pesanan ini?');">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="form-select form-select-sm border-warning" onchange="this.form.submit()">
                                            <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                            <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                            <td>{{ $order->catatan ?? '-' }}</td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11">Tidak ada pesanan ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>

<!-- Style -->
<style>
    .pagination svg {
        width: 1rem;
        height: 1rem;
    }
    .btn-outline-warning {
        border-color: #f8a42f;
        color: #f8a42f;
    }
    .btn-outline-warning:hover {
        background-color: #f8a42f;
        color: #fff;
    }
    .table thead {
        background-color: #f8a42f !important;
        color: #4c2c1a;
    }
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection