<x-layouts.app :title="__('Add Theme')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Add New Theme</flux:heading>
        <flux:subheading size="lg" class="mb-6">Create a new theme</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <form action="{{ route('themes.store') }}" method="POST" class="space-y-4">
        @csrf
        @include('dashboard.themes.form')

        <flux:button type="submit" icon="check">Save Theme</flux:button>
        <flux:link href="{{ route('themes.index') }}" variant="subtle">Cancel</flux:link>
    </form>
</x-layouts.app>