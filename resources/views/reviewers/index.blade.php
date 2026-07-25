@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Reviewer Management</h1>
                <p class="text-blue-100 mt-2">
                    Manage reviewers responsible for vendor assessments.
                </p>
            </div>

            <a href="{{ route('reviewers.create') }}"
               class="bg-white text-blue-700 px-5 py-3 rounded-xl font-semibold hover:bg-blue-100 transition">
                + Add Reviewer
            </a>
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">Total Reviewers</p>

            <h2 class="text-3xl font-bold mt-2">
                {{ $reviewers->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">Active Reviewers</p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                {{ $reviewers->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500">Pending Reviews</p>

            <h2 class="text-3xl font-bold text-orange-500 mt-2">
                --
            </h2>
        </div>

    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="px-6 py-4 border-b">
            <h2 class="text-xl font-semibold">
                Reviewer List
            </h2>
        </div>

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-3 text-left">Name</th>

                    <th class="px-6 py-3 text-left">Email</th>

                    <th class="px-6 py-3 text-center">Role</th>

                    <th class="px-6 py-3 text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($reviewers as $reviewer)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $reviewer->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $reviewer->email }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Reviewer
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ route('reviewers.edit',$reviewer->id) }}"
                           class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">
                            Edit
                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-8 text-gray-500">
                        No Reviewers Found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection