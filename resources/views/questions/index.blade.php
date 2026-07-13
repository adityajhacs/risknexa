@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">All Questions</h1>

        <a href="{{ route('questions.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg">
            Add Question
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Category</th>
                    <th class="p-3 text-left">Question</th>
                    <th class="p-3 text-left">Risk Weight</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($questions as $question)

            <tr class="border-t">

                <td class="p-3">{{ $question->id }}</td>

                <td class="p-3">{{ $question->category->name }}</td>

                <td class="p-3">{{ $question->question }}</td>

                <td class="p-3">{{ $question->risk_weight }}</td>

                <td class="p-3">{{ $question->status }}</td>

                <td class="p-3">

                    <div class="flex gap-2">

                        <a href="{{ route('questions.edit', $question->id) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('questions.destroy', $question->id) }}"
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