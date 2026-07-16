@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

    <!-- Header -->

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Framework Management
            </h1>

            <p class="text-slate-500 mt-2">
                Manage security frameworks used for vendor assessments.
            </p>

        </div>

        <a href="{{ route('frameworks.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl shadow">

            + Create Framework

        </a>

    </div>

    @if(session('success'))

        <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

            {{ session('success') }}

        </div>

    @endif


    <!-- Table -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">#</th>

                    <th class="px-6 py-4 text-left">
                        Framework Code
                    </th>

                    <th class="px-6 py-4 text-left">
                        Framework Name
                    </th>

                    <th class="px-6 py-4 text-left">
                        Version
                    </th>

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($frameworks as $framework)

                <tr class="border-t hover:bg-slate-50 transition">

                    <td class="px-6 py-4">

                        {{ $loop->iteration }}

                    </td>

                    <td class="px-6 py-4 font-semibold text-blue-700">

                        {{ $framework->code }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $framework->name }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $framework->version ?? '-' }}

                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($framework->status == 'Active')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">

                                Active

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">

                                Inactive

                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-3">

                            <a href="{{ route('frameworks.edit',$framework) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                                Edit

                            </a>

                            <form action="{{ route('frameworks.destroy',$framework) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Delete this Framework?')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-10 text-slate-500">

                        No Frameworks Available

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $frameworks->links() }}

    </div>

</div>

@endsection