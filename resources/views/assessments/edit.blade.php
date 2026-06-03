<!DOCTYPE html>
<html>
<head>
    <title>Edit Assessment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Assessment</h1>

    <form action="/assessments/{{ $assessment->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Vendor</label>
            <select name="vendor_id" class="w-full border rounded p-2">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->id }}"
                        {{ $assessment->vendor_id == $vendor->id ? 'selected' : '' }}>
                        {{ $vendor->vendor_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Assessment Name</label>
            <input type="text"
                   name="assessment_name"
                   value="{{ $assessment->assessment_name }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Due Date</label>
            <input type="date"
                   name="due_date"
                   value="{{ $assessment->due_date }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Status</label>
            <select name="status" class="w-full border rounded p-2">
                <option value="Pending" {{ $assessment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="In Progress" {{ $assessment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $assessment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Update Assessment
            </button>

            <a href="/assessments" class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

</body>
</html>