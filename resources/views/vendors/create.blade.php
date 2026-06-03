<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Add Vendor</title>
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto p-6">

    <div class="bg-white shadow-lg rounded-lg p-6">

        <h1 class="text-3xl font-bold mb-6">
            Add Vendor
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
        <form action="/vendors" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium mb-1">Vendor Name</label>
                <input type="text"
                       name="vendor_name"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Contact Person</label>
                <input type="text"
                       name="contact_person"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Email</label>
                <input type="email"
                       name="email"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Phone</label>
                <input type="text"
                       name="phone"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Country</label>
                <input type="text"
                       name="country"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Criticality</label>
                <select name="criticality"
                        class="w-full border rounded p-2">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                    <option value="Critical">Critical</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Status</label>
                <select name="status"
                        class="w-full border rounded p-2">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <button type="submit"
                    class="bg-green-600 text-white px-5 py-2 rounded">
                Save Vendor
            </button>

        </form>

    </div>

</div>

</body>
</html>