@if(isset($isAll) && $isAll)
    @foreach($categories as $category)
        @if($category->products->isNotEmpty())
            <h5 id="category-{{ Str::slug($category->name) }}" class="mt-5 mb-3 fw-bold">{{ $category->name }}</h5>
            <div class="row g-4">
                @foreach($category->products as $i => $product)
                    <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="card h-100 border-0 shadow-sm rounded overflow-hidden">
                            <div class="d-flex" style="height: 160px;">
                                <div class="flex-shrink-0">
                                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="img-thumbnail"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                </div>
                                <div class="p-3 d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                                        <p class="text-danger fw-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <a href="#" class="text-decoration-none text-primary small mt-2" data-bs-toggle="modal"
                                        data-bs-target="#modal-{{ $product->id }}">See more</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $product->id }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body d-flex flex-column flex-md-row">
                                    <img src="{{ Storage::url($product->image_url) }}" class="img-fluid rounded mb-3 mb-md-0 me-md-4"
                                        style="max-width: 300px;" alt="{{ $product->name }}">
                                    <div>
                                        <p class="text-danger fw-bold fs-5">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        <p>{{ $product->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach
@else
    @php
        $selectedCategory = $products->first()?->category ?? null;
    @endphp

    @if($selectedCategory)
        <h5 id="category-{{ Str::slug($selectedCategory->name) }}" class="mt-5 mb-3 fw-bold">{{ $selectedCategory->name }}</h5>
    @endif

    <div class="row g-4">
        @forelse($products as $i => $product)
            <div class="col-lg-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="card h-100 border-0 shadow-sm rounded overflow-hidden">
                    <div class="d-flex" style="height: 160px;">
                        <div class="flex-shrink-0">
                            <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="p-3 d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $product->name }}</h6>
                                <p class="text-danger fw-semibold mb-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            <a href="#" class="text-decoration-none text-primary small mt-2" data-bs-toggle="modal"
                                data-bs-target="#modal-{{ $product->id }}">See more</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $product->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $product->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex flex-column flex-md-row">
                            <img src="{{ Storage::url($product->image_url) }}" class="img-fluid rounded mb-3 mb-md-0 me-md-4"
                                style="max-width: 300px;" alt="{{ $product->name }}">
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
@endif