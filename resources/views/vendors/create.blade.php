@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-gradient-to-r from-slate-900 to-blue-700 text-white rounded-3xl p-8 mb-8">
    <h1 class="text-5xl font-bold">
    Vendor Onboarding
</h1>

<p class="mt-3 text-blue-100">
    Create vendor accounts, assign assessments and manage third-party risk.
</p>
</div>
<div class="bg-white rounded-3xl shadow-lg p-8">
    <form action="/vendors" method="POST">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
    <label class="block font-medium mb-2">
        Vendor Name
    </label>

    <input
        type="text"
        name="vendor_name"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Contact Person
    </label>

    <input
        type="text"
        name="contact_person"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Email
    </label>

    <input
        type="email"
        name="email"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Phone
    </label>

    <input
        type="text"
        name="phone"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Country
    </label>

    <input
        type="text"
        name="country"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Password
    </label>

    <input
        type="password"
        name="password"
        class="w-full border rounded-xl p-3"
    >
</div>
<div>
    <label class="block font-medium mb-2">
        Criticality
    </label>

    <select
        name="criticality"
        class="w-full border rounded-xl p-3"
    >
        <option>Low</option>
        <option>Medium</option>
        <option>High</option>
        <option>Critical</option>
    </select>
</div>
<div>
    <label class="block font-medium mb-2">
        Status
    </label>

    <select
        name="status"
        class="w-full border rounded-xl p-3"
    >
        <option>Active</option>
        <option>Inactive</option>
    </select>
</div>
</div>
<div class="mt-8 flex justify-end">

    <button
        type="submit"
        class="bg-blue-600 text-white px-8 py-3 rounded-xl"
    >
        Create Vendor
    </button>

</div>
</form>
</div>
</div>
@endsection