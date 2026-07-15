<!DOCTYPE html>
<html>
<head>
    <title>Edit Assessment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="max-w-3xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">

    <h1 class="text-3xl font-bold mb-8">
        Edit Assessment
    </h1>

    <form action="{{ route('assessments.update', $assessment->id) }}" method="POST">

        @csrf
        @method('PUT')

        <!-- Vendor -->
        <div class="mb-5">
            <label class="block font-semibold mb-2">
                Vendor
            </label>

            <select
                name="vendor_id"
                class="w-full border rounded-lg p-3">

                @foreach($vendors as $vendor)

                    <option value="{{ $vendor->id }}"
                        {{ $assessment->vendor_id == $vendor->id ? 'selected' : '' }}>

                        {{ $vendor->vendor_name }}

                    </option>

                @endforeach

            </select>
        </div>

        <!-- Framework -->
        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Framework
            </label>

            <select
                name="framework_id"
                class="w-full border rounded-lg p-3">

                @foreach($frameworks as $framework)

                    <option value="{{ $framework->id }}"
                        {{ $assessment->framework_id == $framework->id ? 'selected' : '' }}>

                        {{ $framework->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <!-- Assessment Name -->

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Assessment Name
            </label>

            <input
                type="text"
                name="assessment_name"
                value="{{ $assessment->assessment_name }}"
                class="w-full border rounded-lg p-3">

        </div>

        <!-- Priority -->

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Priority
            </label>

            <select
                name="priority"
                class="w-full border rounded-lg p-3">

                <option value="Low"
                    {{ $assessment->priority == 'Low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="Medium"
                    {{ $assessment->priority == 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="High"
                    {{ $assessment->priority == 'High' ? 'selected' : '' }}>
                    High
                </option>

                <option value="Critical"
                    {{ $assessment->priority == 'Critical' ? 'selected' : '' }}>
                    Critical
                </option>

            </select>

        </div>

        <!-- Due Date -->

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Due Date
            </label>

            <input
                type="date"
                name="due_date"
                value="{{ $assessment->due_date }}"
                class="w-full border rounded-lg p-3">

        </div>

        <!-- Description -->

        <div class="mb-5">

            <label class="block font-semibold mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg p-3">{{ $assessment->description }}</textarea>

        </div>

        <!-- Status -->

        <div class="mb-6">

            <label class="block font-semibold mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full border rounded-lg p-3">

                <option value="Pending"
                    {{ $assessment->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="In Progress"
                    {{ $assessment->status == 'In Progress' ? 'selected' : '' }}>
                    In Progress
                </option>

                <option value="Completed"
                    {{ $assessment->status == 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

        </div>

        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                Update Assessment

            </button>

            <a href="{{ route('assessments.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg">

                Back

            </a>

        </div>

    </form>

</div>

</body>
</html>