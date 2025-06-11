<x-layouts.app :title="__('Menus')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-800">Menu List</h1>
        <a href="{{ route('menus.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow transition">
            + Create Menu
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Text</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Icon</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">URL</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Order</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($menus as $menu)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $menu->menu_text }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $menu->menu_icon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600">{{ $menu->menu_url }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $menu->menu_order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium 
                                {{ $menu->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $menu->status ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('menus.edit', $menu) }}" class="text-indigo-600 hover:text-indigo-800 font-medium mr-3">Edit</a>
                            <form action="{{ route('menus.destroy', $menu) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this menu?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
