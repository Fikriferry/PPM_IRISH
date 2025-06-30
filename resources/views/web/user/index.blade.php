@extends('components.layouts.base')

@section('title', 'User')

@section('content')
<section>
    <!-- Hero Section -->
    <div class="hero-section"
        style="background-color:rgba(138, 47, 39, 0.95); color: #ffffff; padding: 100px 0 40px; text-align: center; background: linear-gradient(to right, rgba(138, 47, 39, 0.9), rgba(33, 18, 12, 0.9)), url('{{ asset('image/bg-1.jpg') }}') center/cover no-repeat;">
        <h1><span style="color: #f8a42f; font-size: 3rem; font-weight: bold;">USER</span> LIST</h1>
        <nav class="breadcrumb" style="background: none; justify-content: center; margin-top: 10px;">
            <a class="breadcrumb-item text-light text-decoration-none" href="{{ url('/') }}">Home</a>
            <a class="breadcrumb-item active text-decoration-none text-light" href="#">User</a>
        </nav>
    </div>

    <!-- Content Section -->
    <div class="container my-5">
        <!-- Search & Add Button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <form class="d-flex" action="{{ route('user.index') }}" method="get">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search User">
            </form>
            <a href="{{ route('user.create') }}" class="btn btn-outline-dark">
                <i class="fas fa-plus me-2"></i> Add New User
            </a>
        </div>

        <!-- Flash Message -->
        @if(session()->has('successMessage'))
            <div class="alert alert-success">
                {{ session()->get('successMessage') }}
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $key => $customer)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address ?? '-' }}</td>
                            <td>{{ $customer->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('user.edit', $customer->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="delete-form-{{ $customer->id }}" action="{{ route('user.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this customer?');">
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
                        <tr><td colspan="7">No customers found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $customers->links('pagination::bootstrap-5') }}
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
