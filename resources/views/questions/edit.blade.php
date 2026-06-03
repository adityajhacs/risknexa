<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Question</h1>

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Category</label>
            <select name="category_id" class="w-full border rounded p-2">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $question->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Question</label>
            <input
                type="text"
                name="question"
                value="{{ $question->question }}"
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Risk Weight</label>
            <input
                type="number"
                name="risk_weight"
                value="{{ $question->risk_weight }}"
                class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="active" {{ $question->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive" {{ $question->status == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        <div class="flex gap-2">
            <button
                type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded">
                Update Question
            </button>

            <a
                href="{{ route('questions.index') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

</body>
</html>