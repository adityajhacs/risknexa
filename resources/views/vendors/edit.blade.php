<!DOCTYPE html>
<html>
<head>
    <title>Edit Vendor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-6">Edit Vendor</h1>

    <form action="/vendors/{{ $vendor->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Vendor Name</label>
            <input type="text"
                   name="vendor_name"
                   value="{{ $vendor->vendor_name }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Contact Person</label>
            <input type="text"
                   name="contact_person"
                   value="{{ $vendor->contact_person }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Email</label>
            <input type="email"
                   name="email"
                   value="{{ $vendor->email }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Phone</label>
            <input type="text"
                   name="phone"
                   value="{{ $vendor->phone }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2 font-semibold">Country</label>
            <input type="text"
                   name="country"
                   value="{{ $vendor->country }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="flex gap-2">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                Update Vendor
            </button>

            <a href="/vendors"
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

</body>
</html>