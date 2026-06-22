<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Vendor Assessment</title>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
        Create Assessment
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/assessments" method="POST">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Assessment Assignment -->
            <div class="bg-white shadow-lg rounded-xl p-6">

                <h2 class="text-xl font-semibold mb-5 border-b pb-2">
                    Assessment Assignment
                </h2>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Vendor</label>
                    <select name="vendor_id" class="w-full border rounded-lg p-2">
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}"
                                {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->vendor_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Questionnaire</label>

                    <select name="questionnaire" class="w-full border rounded p-2">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('questionnaire') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Assessment Name</label>

                    <input type="text"
                           name="assessment_name"
                           value="{{ old('assessment_name') }}"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Priority</label>

                    <select name="priority"
                            class="w-full border rounded-lg p-2">
                        <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                        <option value="Critical" {{ old('priority') == 'Critical' ? 'selected' : '' }}>Critical</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Due Date</label>

                    <input type="date"
                           name="due_date"
                           value="{{ old('due_date') }}"
                           class="w-full border rounded-lg p-2">
                </div>

            </div>

            <!-- Workflow Governance -->
            <div class="bg-white shadow-lg rounded-xl p-6">

                <h2 class="text-xl font-semibold mb-5 border-b pb-2">
                    Workflow Governance
                </h2>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Assigned By</label>

                    <input type="text"
                           name="assigned_by"
                           value="{{ old('assigned_by') }}"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Reviewer</label>

                    <input type="text"
                           name="reviewer"
                           value="{{ old('reviewer') }}"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Status</label>

                    <select name="status"
                            class="w-full border rounded-lg p-2">
                        <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Review Status</label>

                    <select name="review_status"
                            class="w-full border rounded-lg p-2">
                        <option value="Pending Review" {{ old('review_status') == 'Pending Review' ? 'selected' : '' }}>Pending Review</option>
                        <option value="Under Review" {{ old('review_status') == 'Under Review' ? 'selected' : '' }}>Under Review</option>
                        <option value="Approved" {{ old('review_status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ old('review_status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

            </div>

        </div>

        <div class="mt-6">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                Save Assessment
            </button>
        </div>

    </form>

</div>
</body>
</html>