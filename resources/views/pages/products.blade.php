@if(isset($isAll) && $isAll)
    @foreach($categories as $category)
        @if($category->products->isNotEmpty())
            <h5 class="mt-5 mb-3 fw-bold">{{ $category->name }}</h5>
            <div class="row g-4">
                @foreach($category->products as $product)
                    @include('pages.product-card', ['product' => $product])
                @endforeach
            </div>
        @endif
    @endforeach
@else
    <div class="row g-4">
        @forelse($products as $product)
            @include('pages.product-card', ['product' => $product])
        @empty
            <p class="text-center">Produk tidak ditemukan.</p>
        @endforelse
    </div>
@endif
