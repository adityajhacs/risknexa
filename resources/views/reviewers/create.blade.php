@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl p-6 text-white shadow-lg mb-6">
        <h1 class="text-3xl font-bold">Create Reviewer</h1>
        <p class="text-blue-100 mt-2">
            Add a new reviewer for vendor assessments.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow p-8">

        <form action="{{ route('reviewers.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="font-semibold">Full Name</label>

                    <input
                        type="text"
                        name="name"
                        class="w-full mt-2 border rounded-xl px-4 py-3"
                        required>
                </div>

                <div>
                    <label class="font-semibold">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="w-full mt-2 border rounded-xl px-4 py-3"
                        required>
                </div>

                <div>
                    <label class="font-semibold">Password</label>

                    <input
                        type="password"
                        name="password"
                        class="w-full mt-2 border rounded-xl px-4 py-3"
                        required>
                </div>

            </div>

            <div class="mt-8">

                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">

                    Save Reviewer

                </button>

            </div>

        </form>

    </div>

</div>

@endsection