@php
    $theme = $theme ?? null;
@endphp

<flux:input name="name" label="Theme Name" value="{{ old('name', $theme->name ?? '') }}" required />
<flux:input name="folder" label="Folder Name" value="{{ old('folder', $theme->folder ?? '') }}" required />
<flux:textarea name="description" label="Description" rows="3">{{ old('description', $theme->description ?? '') }}</flux:textarea>

<flux:select name="status" label="Status" required>
    <option value="1" {{ old('status', $theme->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
    <option value="0" {{ old('status', $theme->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
</flux:select>