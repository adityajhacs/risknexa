@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6">
            Create Question
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('questions.store') }}" method="POST">

            @csrf

            <!-- Domain -->

            <div class="mb-4">

                <label class="block font-medium mb-2">
                    Domain
                </label>

                <select
                    name="domain_id"
                    class="w-full border rounded p-2">

                    <option value="">
                        Select Domain
                    </option>

                    @foreach($domains as $domain)

                        <option value="{{ $domain->id }}">

                            {{ $domain->category->name }}
                            →
                            {{ $domain->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- Control Code -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Control Code

                </label>

                <input
                    type="text"
                    name="control_code"
                    class="w-full border rounded p-2"
                    placeholder="Example : A.5.1">

            </div>

            <!-- Question -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Question

                </label>

                <textarea
                    name="question"
                    rows="3"
                    class="w-full border rounded p-2"></textarea>

            </div>

            <!-- Description -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Description

                </label>

                <textarea
                    name="description"
                    rows="3"
                    class="w-full border rounded p-2"></textarea>

            </div>

            <!-- Response Type -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Response Type

                </label>

                <select
                    name="response_type"
                    class="w-full border rounded p-2">

                    <option>Yes/No</option>

                    <option>Yes/No/NA</option>

                    <option>Text</option>

                    <option>Textarea</option>

                    <option>Number</option>

                    <option>Date</option>

                    <option>Dropdown</option>

                    <option>Multi Select</option>

                    <option>File Upload</option>

                </select>

            </div>

            <!-- Risk Weight -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Risk Weight

                </label>

                <input
                    type="number"
                    name="risk_weight"
                    value="1"
                    class="w-full border rounded p-2">

            </div>

            <!-- Risk Level -->

            <div class="mb-4">

                <label class="block font-medium mb-2">

                    Risk Level

                </label>

                <select
                    name="risk_level"
                    class="w-full border rounded p-2">

                    <option>Low</option>

                    <option>Medium</option>

                    <option>High</option>

                    <option>Critical</option>

                </select>

            </div>

            <!-- Evidence -->

            <div class="mb-4">

                <label>

                    <input
                        type="checkbox"
                        name="evidence_required">

                    Evidence Required

                </label>

            </div>

            <!-- Required -->

            <div class="mb-4">

                <label>

                    <input
                        type="checkbox"
                        checked
                        name="is_required">

                    Mandatory Question

                </label>

            </div>

            <!-- Guidance -->

            <div class="mb-5">

                <label class="block font-medium mb-2">

                    Guidance

                </label>

                <textarea
                    name="guidance"
                    rows="3"
                    class="w-full border rounded p-2"></textarea>

            </div>

            <!-- Status -->

            <div class="mb-5">

                <label class="block font-medium mb-2">

                    Status

                </label>

                <select
                    name="status"
                    class="w-full border rounded p-2">

                    <option>Active</option>

                    <option>Inactive</option>

                </select>

            </div>

            <button
                class="bg-blue-600 text-white px-5 py-2 rounded">

                Save Question

            </button>

        </form>

    </div>

</div>

@endsection