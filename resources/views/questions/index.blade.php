@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">Question Management</h1>
            <p class="text-gray-500">
                Manage assessment questions for all frameworks.
            </p>
        </div>

        <a href="{{ route('questions.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Question
        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <!-- Table -->

    <div class="bg-white shadow-lg rounded-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="px-4 py-3 text-left">ID</th>

                    <th class="px-4 py-3 text-left">Section</th>

                    <th class="px-4 py-3 text-left">Domain</th>

                    <th class="px-4 py-3 text-left">Control Code</th>

                    <th class="px-4 py-3 text-left">Question</th>

                    <th class="px-4 py-3 text-left">Risk Weight</th>

                    <th class="px-4 py-3 text-left">Risk Level</th>

                    <th class="px-4 py-3 text-left">Status</th>

                    <th class="px-4 py-3 text-center">Action</th>

                </tr>

            </thead>

            <tbody>

            @forelse($questions as $question)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-4 py-3">
                        {{ $question->id }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $question->domain?->category?->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $question->domain?->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $question->control_code ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $question->question }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $question->risk_weight }}
                    </td>

                    <td class="px-4 py-3">

                        @if($question->risk_level == 'Critical')

                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                Critical
                            </span>

                        @elseif($question->risk_level == 'High')

                            <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded">
                                High
                            </span>

                        @elseif($question->risk_level == 'Medium')

                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded">
                                Medium
                            </span>

                        @else

                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                Low
                            </span>

                        @endif

                    </td>

                    <td class="px-4 py-3">

                        @if($question->status == 'Active')

                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded">
                                Active
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded">
                                Inactive
                            </span>

                        @endif

                    </td>

                    <td class="px-4 py-3">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('questions.edit', $question->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">

                                Edit

                            </a>

                            <form action="{{ route('questions.destroy', $question->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this question?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9"
                        class="text-center py-8 text-gray-500">

                        No Questions Found

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection