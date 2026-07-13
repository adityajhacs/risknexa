<div class="mb-3">
    <label class="form-label">Framework Code</label>

    <input
        type="text"
        name="code"
        class="form-control"
        value="{{ old('code', $framework->code ?? '') }}">

    @error('code')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Framework Name</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name', $framework->name ?? '') }}">

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Version</label>

    <input
        type="text"
        name="version"
        class="form-control"
        value="{{ old('version', $framework->version ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Description</label>

    <textarea
        name="description"
        class="form-control"
        rows="4">{{ old('description', $framework->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>

    <select name="status" class="form-select">

        <option value="Active"
            {{ old('status', $framework->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
            Active
        </option>

        <option value="Inactive"
            {{ old('status', $framework->status ?? '') == 'Inactive' ? 'selected' : '' }}>
            Inactive
        </option>

    </select>
</div>

<button class="btn btn-primary">
    {{ isset($framework) ? 'Update Framework' : 'Save Framework' }}
</button>