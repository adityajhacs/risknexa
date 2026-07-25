@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <!-- Header -->

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Create Framework
            </h1>

            <p class="text-slate-500 mt-2">
                Create a new security framework for vendor assessments.
            </p>

        </div>

        <a href="{{ route('frameworks.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-3 rounded-xl shadow">

            ← Back

        </a>

    </div>

    <!-- Card -->

    <div class="bg-white rounded-2xl shadow-lg p-8">

        @if ($errors->any())

            <div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 p-4">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('frameworks.store') }}"
              method="POST">

            @csrf

            @include('frameworks._form')

        </form>

    </div>

</div>

@endsection