<div class="col-lg-3 col-md-6 col-12 mb-4">
    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: #fff;">
        @if ($product->image_url)
            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                class="card-img-top" style="height: 200px; object-fit: cover;">
        @else
            <div class="d-flex justify-content-center align-items-center"
                style="height: 200px; background-color: #8a2f27;">
                <span class="text-white">No Image</span>
            </div>
        @endif

        <div class="card-body text-center px-3 py-4 d-flex flex-column">
            <h6 class="fw-bold text-dark mb-1">{{ $product->name }}</h6>
            <p class="text-danger fw-semibold mb-2" style="color: #8a2f27;">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>
            <p class="small text-muted mb-3">{{ Str::limit($product->description, 50) }}</p>

            <!-- Tombol untuk buka modal -->
            <button type="button" class="btn btn-outline-danger btn-sm mt-auto rounded-pill"
                data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                Detail
            </button>
        </div>
    </div>

    <!-- Modal Detail Produk -->
    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
        aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header border-0 bg-light">
                    <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-6">
                        @if ($product->image_url)
                            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                                class="img-fluid rounded-3"
                                style="height: 250px; width: 100%; object-fit: cover; object-position: center;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded-3"
                                style="height: 250px;">
                                No Image
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-danger">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                        <p class="mt-3">{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
    transition: 0.3s ease-in-out;
}
</style>