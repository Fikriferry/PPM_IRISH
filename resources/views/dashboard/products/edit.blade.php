<x-layouts.app :title="__('Edit Product')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Product Data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('successMessage') }}</flux:badge>
    @elseif(session()->has('errorMessage'))
        <flux:badge color="red" class="mb-3 w-full">{{ session('errorMessage') }}</flux:badge>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <flux:input label="Name" name="name" value="{{ old('name', $product->name) }}" class="mb-3" />

        <flux:input label="Slug" name="slug" value="{{ old('slug', $product->slug) }}" class="mb-3" />

        <flux:textarea label="Description" name="description" class="mb-3">
            {{ old('description', $product->description) }}
        </flux:textarea>

        <flux:input label="SKU" name="sku" value="{{ old('sku', $product->sku) }}" class="mb-3" />

        <flux:input label="Price" name="price" type="number" step="0.01" value="{{ old('price', $product->price) }}" class="mb-3" />

        <flux:input label="Stock" name="stock" type="number" value="{{ old('stock', $product->stock) }}" class="mb-3" />

        <flux:input label="Image URL" name="image_url" value="{{ old('image_url', $product->image_url) }}" class="mb-3" />

        {{-- Preview Gambar jika ada --}}
        @if($product->image_url)
            <div class="mb-3">
                <p class="text-sm text-gray-500 mb-1">Current Image Preview:</p>
                <img src="{{ $product->image_url }}" alt="Product Image" class="w-24 h-24 object-cover rounded">
            </div>
        @endif

        <flux:switch label="Active" name="is_active" :checked="(bool) old('is_active', $product->is_active)" class="mb-3" />

        <flux:select label="Category" name="product_category_id" class="mb-3">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Cancel</flux:link>
        </div>
    </form>
</x-layouts.app>
