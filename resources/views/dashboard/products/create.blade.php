<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage Product Data</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if (session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="post">
        @csrf

        <flux:input label="Name" name="name" value="{{ old('name') }}" class="mb-3" />

        <flux:input label="Slug" name="slug" value="{{ old('slug') }}" class="mb-3" />

        <flux:textarea label="Description" name="description" class="mb-3">{{ old('description') }}</flux:textarea>

        <flux:input label="SKU" name="sku" value="{{ old('sku') }}" class="mb-3" />

        <flux:input label="Price" name="price" type="number" step="0.01" value="{{ old('price') }}" class="mb-3" />

        <flux:input label="Stock" name="stock" type="number" value="{{ old('stock') }}" class="mb-3" />

        <!-- <flux:input label="Image URL" name="image_url" value="{{ old('image_url') }}" class="mb-3" /> -->

        <flux:input type="file" label="Image URL" name="image_url" class="mb-3" />

        {{-- Switch + hidden input to ensure boolean always sent --}}
        <input type="hidden" name="is_active" value="0">
        <flux:switch label="Active" name="is_active" value="true" :checked="old('is_active', true)" />

        <flux:select label="Category" name="product_category_id" class="mb-3">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </flux:select>

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Simpan</flux:button>
            <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Kembali</flux:link>
        </div>
    </form>
</x-layouts.app>