<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Category Name</label>
            <input
                type="text"
                name="name"
                value="{{ $category->name }}"
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Description</label>
            <textarea
                name="description"
                rows="4"
                class="w-full border rounded p-2">{{ $category->description }}</textarea>
        </div>

        <div class="flex gap-2">
            <button
                type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Update Category
            </button>

            <a
                href="{{ route('categories.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

</body>
</html>