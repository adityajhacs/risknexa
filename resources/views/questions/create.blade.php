<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Add Question</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Add Question
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
        <form action="{{ route('questions.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Category
                </label>

                <select name="category_id"
                        class="w-full border rounded p-2">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Question
                </label>

                <input type="text"
                       name="question"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Risk Weight
                </label>

                <input type="number"
                       name="risk_weight"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">
                    Status
                </label>

                <select name="status"
                        class="w-full border rounded p-2">

                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>

                </select>
            </div>
<div class="mb-4">
    <label>Control Code</label>
    <input type="text"
           name="control_code"
           class="w-full border rounded p-2">
</div>

<div class="mb-4">
    <label>Framework Reference</label>
    <input type="text"
           name="framework_reference"
           class="w-full border rounded p-2">
</div>
<div class="mb-4">
    <label>Response Type</label>

    <select name="response_type"
            class="w-full border rounded p-2">

        <option value="Yes/No">Yes/No</option>
        <option value="Radio">Radio</option>
        <option value="Checkbox">Checkbox</option>
        <option value="Text">Text</option>
        <option value="Textarea">Textarea</option>
        <option value="Dropdown">Dropdown</option>

    </select>
</div>
<div class="mb-4">

    <input type="checkbox"
           name="evidence_mandatory"
           value="1">

    <label>Evidence Mandatory</label>

</div>
<div class="mb-4">

    <label>Risk Level</label>

    <select name="risk_level"
            class="w-full border rounded p-2">

        <option value="Low">Low</option>
        <option value="Medium">Medium</option>
        <option value="High">High</option>
        <option value="Critical">Critical</option>

    </select>

</div>
<div class="mb-4">

    <label>Control Guidance</label>

    <textarea
        name="control_guidance"
        class="w-full border rounded p-2">
    </textarea>

</div>
            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded">
                Save Question
            </button>

        </form>

    </div>

</div>

</body>
</html>