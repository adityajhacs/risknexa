<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Assessment</title>
</head>

<body class="bg-gray-100">

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
                            <option value="{{ $vendor->id }}">
                                {{ $vendor->vendor_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Questionnaire</label>
                  <select name="questionnaire" class="w-full border rounded p-2">
    @foreach($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>
    @endforeach
</select>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Assessment Name</label>
                    <input type="text"
                           name="assessment_name"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Priority</label>
                    <select name="priority"
                            class="w-full border rounded-lg p-2">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Due Date</label>
                    <input type="date"
                           name="due_date"
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
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Reviewer</label>
                    <input type="text"
                           name="reviewer"
                           class="w-full border rounded-lg p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-medium">Status</label>
                    <select name="status"
                            class="w-full border rounded-lg p-2">
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Review Status</label>
                    <select name="review_status"
                            class="w-full border rounded-lg p-2">
                        <option value="Pending Review">Pending Review</option>
                        <option value="Under Review">Under Review</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
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