@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Edit Domain
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('domains.update', $domain) }}" method="POST">

            @csrf
            @method('PUT')

            <!-- Section -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Section
                </label>

                <select
                    name="category_id"
                    class="w-full border rounded p-2">

                    @foreach($sections as $section)

                        <option
                            value="{{ $section->id }}"
                            {{ old('category_id', $domain->category_id) == $section->id ? 'selected' : '' }}>

                            {{ $section->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <!-- Domain Code -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Domain Code
                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ old('code', $domain->code) }}"
                    class="w-full border rounded p-2">

            </div>


            <!-- Domain Name -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Domain Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $domain->name) }}"
                    class="w-full border rounded p-2">

            </div>


            <!-- Display Order -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Display Order
                </label>

                <input
                    type="number"
                    name="display_order"
                    value="{{ old('display_order', $domain->display_order) }}"
                    class="w-full border rounded p-2">

            </div>


            <!-- Status -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded p-2">

                    <option
                        value="Active"
                        {{ old('status', $domain->status) == 'Active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option
                        value="Inactive"
                        {{ old('status', $domain->status) == 'Inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>


            <!-- Description -->

            <div class="mb-6">

                <label class="block font-medium mb-1">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full border rounded p-2">{{ old('description', $domain->description) }}</textarea>

            </div>


            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                    Update Domain

                </button>

                <a href="{{ route('domains.index') }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection