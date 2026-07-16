@extends('layouts.vendor')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Team Member
            </h1>

            <p class="text-slate-500 mt-2">
                Update Vendor Admin or Vendor User details.
            </p>

        </div>

        <a
            href="{{ route('vendor-users.index') }}"
            class="px-5 py-3 border border-slate-300 rounded-xl hover:bg-slate-100">

            ← Back

        </a>

    </div>

    {{-- Errors --}}
    @if ($errors->any())

    <div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">

        <ul class="list-disc ml-5">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

    @endif

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

        {{-- Top Banner --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-8 text-white">

            <h2 class="text-2xl font-bold">

                {{ $user->name }}

            </h2>

            <p class="text-blue-100 mt-2">

                Update this team member's information.

            </p>

        </div>

        {{-- Form --}}
        <form
            action="{{ route('vendor-users.update',$user->id) }}"
            method="POST"
            class="p-8">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                {{-- Name --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Full Name

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$user->name) }}"
                        class="w-full rounded-xl border border-slate-300 p-3 focus:ring-2 focus:ring-blue-500"
                        required>

                </div>

                {{-- Email --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Email Address

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email',$user->email) }}"
                        class="w-full rounded-xl border border-slate-300 p-3 focus:ring-2 focus:ring-blue-500"
                        required>

                </div>

                {{-- Password --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        New Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-xl border border-slate-300 p-3 focus:ring-2 focus:ring-blue-500">

                    <p class="text-xs text-slate-500 mt-2">

                        Leave blank to keep current password.

                    </p>

                </div>

                {{-- Role --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">

                        Role

                    </label>

                    <select
                        name="role"
                        class="w-full rounded-xl border border-slate-300 p-3">

                        <option
                            value="vendor_admin"
                            {{ old('role',$user->role)=='vendor_admin' ? 'selected' : '' }}>

                            Vendor Admin

                        </option>

                        <option
                            value="vendor"
                            {{ old('role',$user->role)=='vendor' ? 'selected' : '' }}>

                            Vendor User

                        </option>

                    </select>

                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-3 mt-8 border-t pt-6">

                <a
                    href="{{ route('vendor-users.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">

                    Cancel

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    Update User

                </button>

            </div>

        </form>

    </div>

</div>
@endsection