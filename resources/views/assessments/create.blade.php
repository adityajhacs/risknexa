<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Assessment</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Create Assessment
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

        <form action="/assessments" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Vendor
                </label>

                <select name="vendor_id"
                        class="w-full border rounded p-2">

                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">
                            {{ $vendor->vendor_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Assessment Name
                </label>

                <input type="text"
                       name="assessment_name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Due Date
                </label>

                <input type="date"
                       name="due_date"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">
                    Status
                </label>

                <select name="status"
                        class="w-full border rounded p-2">

                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Completed">Completed</option>

                </select>
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded">
                Save Assessment
            </button>

        </form>

    </div>

</div>

</body>
</html>