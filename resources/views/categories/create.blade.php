<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Add Category</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Add Category
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
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Name
                </label>

                <input type="text"
                       name="name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded">
                Save Category
            </button>

        </form>

    </div>

</div>

</body>
</html>