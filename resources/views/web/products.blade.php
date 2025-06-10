<div class="row g-4">
    @forelse($products as $product)
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card h-100 border-0 shadow-sm rounded overflow-hidden">
                <div class="d-flex" style="height: 160px;">
                    <!-- Gambar Kiri -->
                    <div class="flex-shrink-0">
                        <img src="{{ asset($product->image_url ?? 'image/default.jpg') }}"
                            alt="{{ $product->name }}"
                            style="width: 160px; height: 100%; object-fit: cover;">
                    </div>

                    <!-- Info Produk Kanan -->
                    <div class="p-3 d-flex flex-column justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                            <p class="text-danger fw-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-muted small mb-0">{{ Str::limit($product->description, 60) }}</p>
                        </div>
                        <a href="#" class="text-decoration-none text-primary small mt-2" data-bs-toggle="modal" data-bs-target="#modal-{{ $product->id }}">See more</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $product->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex flex-column flex-md-row">
                        <img src="{{ asset($product->image_url ?? 'image/default.jpg') }}"
                             class="img-fluid rounded mb-3 mb-md-0 me-md-4"
                             style="max-width: 300px;"
                             alt="{{ $product->name }}">
                        <div>
                            <p class="text-danger fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>Produk tidak ditemukan dalam kategori ini.</p>
        </div>
    @endforelse
</div>
