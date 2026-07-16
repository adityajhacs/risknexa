@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
@if(session('success'))

<div class="bg-green-100 border border-green-300 text-green-700 px-6 py-4 rounded-xl mb-6">

    <strong>Success!</strong><br>

    {{ session('success') }}

</div>

@endif
        <h1 class="text-3xl font-bold">
            All Vendors
        </h1>

        <a href="/vendors/create"
           class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Add Vendor
        </a>

    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Vendor Name</th>
                    <th class="p-3 text-left">Contact Person</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-left">Country</th>
                    <th class="p-3 text-left">Criticality</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($vendors as $vendor)

            <tr class="border-t">

                <td class="p-3">{{ $vendor->vendor_name }}</td>
                <td class="p-3">{{ $vendor->contact_person }}</td>
                <td class="p-3">{{ $vendor->email }}</td>
                <td class="p-3">{{ $vendor->phone }}</td>
                <td class="p-3">{{ $vendor->country }}</td>
                <td class="p-3">{{ $vendor->criticality }}</td>
                <td class="p-3">{{ $vendor->status }}</td>

               <td class="p-3">

    <div class="flex gap-2">

        <a href="/vendors/{{ $vendor->id }}"
           class="bg-green-600 text-white px-3 py-1 rounded">
            View
        </a>

        <a href="/vendors/{{ $vendor->id }}/edit"
           class="bg-blue-600 text-white px-3 py-1 rounded">
            Edit
        </a>

        <form action="/vendors/{{ $vendor->id }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="bg-red-600 text-white px-3 py-1 rounded">
                Delete
            </button>

        </form>

    </div>

</td>

            </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection