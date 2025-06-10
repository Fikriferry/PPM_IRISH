<x-layouts.app :title="__('Create Menu')">
    <form method="POST" action="{{ route('menus.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block">Menu Text</label>
            <input type="text" name="menu_text" class="border p-2 w-full" required>
        </div>

        <div>
            <label class="block">Menu Icon</label>
            <input type="text" name="menu_icon" class="border p-2 w-full">
        </div>

        <div>
            <label class="block">Menu URL</label>
            <input type="text" name="menu_url" class="border p-2 w-full">
        </div>

        <div>
            <label class="block">Menu Order</label>
            <input type="number" name="menu_order" value="0" class="border p-2 w-full">
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1" checked>
                <span class="ml-2">Aktif</span>
            </label>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('menus.index') }}" class="ml-2 text-gray-700">Cancel</a>
        </div>
    </form>
</x-layouts.app>