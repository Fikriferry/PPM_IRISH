<x-layouts.app :title="__('Product Details')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Product Details</flux:heading>
        <flux:subheading size="lg" class="mb-6">View product information</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Name</p>
            <p class="text-lg text-gray-800">{{ $product->name }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Slug</p>
            <p class="text-lg text-gray-800">{{ $product->slug }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">SKU</p>
            <p class="text-lg text-gray-800">{{ $product->sku }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Price</p>
            <p class="text-lg text-gray-800">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Stock</p>
            <p class="text-lg text-gray-800">{{ $product->stock }}</p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Category</p>
            <p class="text-lg text-gray-800">
                {{ $product->category->name ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Status</p>
            @if($product->is_active)
                <flux:badge color="lime">Active</flux:badge>
            @else
                <flux:badge color="red">Inactive</flux:badge>
            @endif
        </div>

        <div>
            <p class="text-sm font-semibold text-gray-600 mb-1">Created At</p>
            <p class="text-lg text-gray-800">{{ $product->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="mb-6">
        <p class="text-sm font-semibold text-gray-600 mb-1">Description</p>
        <p class="text-base text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
    </div>

    <div class="mb-6">
        <p class="text-sm font-semibold text-gray-600 mb-1">Image</p>
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-40 h-40 object-cover rounded shadow">
        @else
            <p class="text-gray-400">No image available.</p>
        @endif
    </div>

    <div class="mt-4">
        <flux:link href="{{ route('products.index') }}" variant="ghost">← Back to Product List</flux:link>
    </div>
</x-layouts.app>
