<x-layouts.app :title="__('Edit Theme')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Edit Theme</flux:heading>
        <flux:subheading size="lg" class="mb-6">Update theme information</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @if(session()->has('success'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session('success') }}</flux:badge>
    @endif

    <form action="{{ route('themes.update', $theme->id) }}" method="POST">
        @csrf
        @method('PUT')

        <flux:input label="Name" name="name" value="{{ old('name', $theme->name) }}" class="mb-3" />

        <flux:input label="Folder" name="folder" value="{{ old('folder', $theme->folder) }}" class="mb-3" />

        <flux:textarea label="Description" name="description" class="mb-3">
            {{ old('description', $theme->description) }}
        </flux:textarea>

        <flux:switch label="Status (Active)" name="status"
            :checked="old('status', $theme->status) ? true : false"
            class="mb-3" />

        <flux:separator />

        <div class="mt-4">
            <flux:button type="submit" variant="primary">Update</flux:button>
            <flux:link href="{{ route('themes.index') }}" variant="ghost" class="ml-3">Cancel</flux:link>
        </div>
    </form>
</x-layouts.app>