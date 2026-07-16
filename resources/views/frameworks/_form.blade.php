<div class="grid md:grid-cols-2 gap-6">

    <!-- Framework Code -->

    <div>

        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Framework Code
        </label>

        <input
            type="text"
            name="code"
            value="{{ old('code', $framework->code ?? '') }}"
            placeholder="ISO27001"
            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3
                   focus:outline-none focus:ring-2 focus:ring-blue-500
                   focus:border-blue-500 transition">

        @error('code')

            <p class="text-red-500 text-sm mt-2">
                {{ $message }}
            </p>

        @enderror

    </div>


    <!-- Version -->

    <div>

        <label class="block text-sm font-semibold text-slate-700 mb-2">
            Version
        </label>

        <input
            type="text"
            name="version"
            value="{{ old('version', $framework->version ?? '') }}"
            placeholder="2022"
            class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3
                   focus:outline-none focus:ring-2 focus:ring-blue-500
                   focus:border-blue-500 transition">

    </div>

</div>


<!-- Framework Name -->

<div class="mt-6">

    <label class="block text-sm font-semibold text-slate-700 mb-2">
        Framework Name
    </label>

    <input
        type="text"
        name="name"
        value="{{ old('name', $framework->name ?? '') }}"
        placeholder="ISO 27001 Information Security Management"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3
               focus:outline-none focus:ring-2 focus:ring-blue-500
               focus:border-blue-500 transition">

    @error('name')

        <p class="text-red-500 text-sm mt-2">

            {{ $message }}

        </p>

    @enderror

</div>


<!-- Status -->

<div class="mt-6">

    <label class="block text-sm font-semibold text-slate-700 mb-2">

        Status

    </label>

    <select
        name="status"
        class="w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3
               focus:outline-none focus:ring-2 focus:ring-blue-500">

        <option value="Active"
            {{ old('status', $framework->status ?? 'Active')=='Active' ? 'selected' : '' }}>

            🟢 Active

        </option>

        <option value="Inactive"
            {{ old('status', $framework->status ?? '')=='Inactive' ? 'selected' : '' }}>

            🔴 Inactive

        </option>

    </select>

</div>


<!-- Description -->

<div class="mt-6">

    <label class="block text-sm font-semibold text-slate-700 mb-2">

        Description

    </label>

    <textarea
        name="description"
        rows="5"
        placeholder="Enter framework description..."
        class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3
               focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $framework->description ?? '') }}</textarea>

</div>


<!-- Buttons -->

<div class="mt-8 flex justify-end gap-4">

    <a href="{{ route('frameworks.index') }}"
       class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 font-semibold">

        Cancel

    </a>

    <button
        class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600
               hover:from-blue-700 hover:to-indigo-700
               text-white font-semibold shadow-lg">

        💾 {{ isset($framework) ? 'Update Framework' : 'Save Framework' }}

    </button>

</div>