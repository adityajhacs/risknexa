@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            All Categories
        </h1>

        <a href="{{ route('categories.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Add Category
        </a>

    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>

                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach($categories as $category)

                <tr class="border-t">

                    <td class="p-3">{{ $category->id }}</td>

                    <td class="p-3">{{ $category->name }}</td>

                    <td class="p-3">{{ $category->description }}</td>

                    <td class="p-3">

                        <div class="flex gap-2">

                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
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