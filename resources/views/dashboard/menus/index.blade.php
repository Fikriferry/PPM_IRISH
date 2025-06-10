<x-layouts.app :title="__('Menus')">
    <div class="mb-4">
        <a href="{{ route('menus.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Create Menu</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Text</th>
                <th class="border px-4 py-2">Icon</th>
                <th class="border px-4 py-2">URL</th>
                <th class="border px-4 py-2">Order</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td class="border px-4 py-2">{{ $menu->menu_text }}</td>
                    <td class="border px-4 py-2">{{ $menu->menu_icon }}</td>
                    <td class="border px-4 py-2">{{ $menu->menu_url }}</td>
                    <td class="border px-4 py-2">{{ $menu->menu_order }}</td>
                    <td class="border px-4 py-2">
                        <span class="{{ $menu->status ? 'text-green-600' : 'text-red-600' }}">
                            {{ $menu->status ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('menus.edit', $menu) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this menu?')" class="text-red-600 ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.app>
