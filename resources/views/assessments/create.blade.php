<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Create Vendor Assessment</title>
</head>

<body class="bg-slate-100 min-h-screen">

<div class="max-w-5xl mx-auto p-8">

```
<div class="bg-white shadow-2xl rounded-3xl border border-slate-200 p-10">

    <div class="mb-10">
        <h1 class="text-4xl font-bold text-slate-800">
            Create Vendor Assessment
        </h1>

        <p class="text-slate-500 mt-2">
            Create and assign a new vendor assessment
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/assessments" method="POST">
        @csrf

        <!-- Assessment Assignment -->

        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 mb-8">

            <h2 class="text-xl font-semibold text-slate-700 mb-6">
                Assessment Assignment
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                <div>
                    <label class="block font-medium mb-2">
                        Vendor
                    </label>

                    <select name="vendor_id"
                            class="w-full border border-slate-300 rounded-lg p-3">

                        @foreach($vendors as $vendor)

                            <option value="{{ $vendor->id }}">
                                {{ $vendor->vendor_name }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-2">
                        Questionnaire
                    </label>

                    <select name="questionnaire"
                            class="w-full border border-slate-300 rounded-lg p-3">

                        <option>HR Policy</option>
                        <option>ISO 27001</option>
                        <option>SOC 2</option>
                        <option>HIPAA</option>
                        <option>PCI DSS</option>

                    </select>
                </div>

            </div>

            <div class="mb-5">

                <label class="block font-medium mb-2">
                    Assessment Name
                </label>

                <input type="text"
                       name="assessment_name"
                       class="w-full border border-slate-300 rounded-lg p-3">

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block font-medium mb-2">
                        Priority
                    </label>

                    <select name="priority"
                            class="w-full border border-slate-300 rounded-lg p-3">

                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Critical</option>

                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-2">
                        Due Date
                    </label>

                    <input type="date"
                           name="due_date"
                           class="w-full border border-slate-300 rounded-lg p-3">
                </div>

            </div>

        </div>

        <!-- Workflow Governance -->

        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 mb-8">

            <h2 class="text-xl font-semibold text-slate-700 mb-6">
                Workflow Governance
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

                <div>
                    <label class="block font-medium mb-2">
                        Assigned By
                    </label>

                    <input type="text"
                           name="assigned_by"
                           value="Admin"
                           class="w-full border border-slate-300 rounded-lg p-3">
                </div>

                <div>
                    <label class="block font-medium mb-2">
                        Reviewer
                    </label>

                    <input type="text"
                           name="reviewer"
                           placeholder="Enter Reviewer Name"
                           class="w-full border border-slate-300 rounded-lg p-3">
                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block font-medium mb-2">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border border-slate-300 rounded-lg p-3">

                        <option value="Pending">
                            Pending
                        </option>

                        <option value="In Progress">
                            In Progress
                        </option>

                        <option value="Completed">
                            Completed
                        </option>

                    </select>
                </div>

                <div>
                    <label class="block font-medium mb-2">
                        Review Status
                    </label>

                    <select name="review_status"
                            class="w-full border border-slate-300 rounded-lg p-3">

                        <option value="Pending Review">
                            Pending Review
                        </option>

                        <option value="Approved">
                            Approved
                        </option>

                        <option value="Rejected">
                            Rejected
                        </option>

                    </select>
                </div>

            </div>

        </div>

        <div class="flex gap-4">

            <a href="/assessments"
               class="bg-slate-500 hover:bg-slate-600 text-white px-6 py-3 rounded-lg font-medium">
                Cancel
            </a>

            <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Create Assessment
            </button>

        </div>

    </form>

</div>
```

</div>

</body>
</html>
