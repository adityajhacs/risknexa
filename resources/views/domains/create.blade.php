@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Create Domain
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

        <form action="{{ route('domains.store') }}" method="POST">

            @csrf

            <!-- Section -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Section
                </label>

                <select
                    name="category_id"
                    class="w-full border rounded p-2">

                    <option value="">
                        Select Section
                    </option>

                    @foreach($sections as $section)

                        <option
                            value="{{ $section->id }}"
                            {{ old('category_id') == $section->id ? 'selected' : '' }}>

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
                    class="w-full border rounded p-2"
                    placeholder="Example : POL"
                    value="{{ old('code') }}">

            </div>


            <!-- Domain Name -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Domain Name
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded p-2"
                    placeholder="Information Security Policies"
                    value="{{ old('name') }}">

            </div>


            <!-- Display Order -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Display Order
                </label>

                <input
                    type="number"
                    name="display_order"
                    class="w-full border rounded p-2"
                    value="{{ old('display_order',1) }}">

            </div>


            <!-- Status -->

            <div class="mb-4">

                <label class="block font-medium mb-1">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded p-2">

                    <option value="Active">
                        Active
                    </option>

                    <option value="Inactive">
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
                    class="w-full border rounded p-2">{{ old('description') }}</textarea>

            </div>


            <button
                type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded">

                Save Domain

            </button>

        </form>

    </div>

</div>

@endsection