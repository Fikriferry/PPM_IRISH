@extends('components.layouts.base')

@section('title', 'Orders')

@section('content')
    <section>
        <!-- Hero Section -->
        <div class="hero-section"
            style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 80px 0 30px; text-align: center;">
            <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">ORDER</span> LIST</h1>
            <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
                <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
                <a class="breadcrumb-item active text-decoration-none text-light" href="#">Orders</a>
            </nav>
        </div>

        <!-- Content Section -->
        <div class="container my-5">
            <!-- Add Order Button -->
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('orders.create') }}" class="btn btn-outline-dark">
                    <i class="fas fa-plus me-2"></i> Add New Order
                </a>
            </div>

            <!-- Flash Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
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
                                            style="display: inline-block;" onsubmit="return confirm('Ubah status pesanan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="diproses" {{ $order->status === 'diproses' ? 'selected' : '' }}>
                                                    Diproses</option>
                                                <option value="selesai" {{ $order->status === 'selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                            </select>
                                        </form>
                                    @endif
                                </td>

                                <td>{{ $order->catatan ?? '-' }}</td>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form id="delete-form-{{ $order->id }}"
                                            action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

    <style>
        .pagination svg {
            width: 1rem;
            height: 1rem;
        }
    </style>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection