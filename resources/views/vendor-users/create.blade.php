@extends('layouts.app')
@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

    <div class="mb-8">

        <h1 class="text-4xl font-bold text-slate-900">
            Create Team Member
        </h1>

        <p class="text-slate-500 mt-2">
            Invite a Vendor Admin or Vendor User to collaborate on assessments.
        </p>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left Info Card --}}
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl text-white p-8">

            <h2 class="text-2xl font-bold">
                Team Management
            </h2>

            <p class="mt-4 text-blue-100 leading-7">
                Add new members to your organization.
                Vendor Admins can manage users and assessments,
                while Vendor Users can complete assigned assessments.
            </p>

            <div class="mt-8 space-y-4">

                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    Secure access
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    Role based permissions
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                    Organization level control
                </div>

            </div>

        </div>

        {{-- Form --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-8">

                @if ($errors->any())

                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 p-4">

                    <ul class="text-red-600 text-sm space-y-1">

                        @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @endif

                <form action="{{ route('vendor-users.store') }}" method="POST">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Full Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="John Smith"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    </div>

                    {{-- Email --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Email Address
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="john@company.com"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                    </div>

                    {{-- Password --}}
                    <div class="mb-6">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Temporary Password
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                        <p class="text-xs text-slate-500 mt-2">
                            User can change this password after first login.
                        </p>

                    </div>

                    {{-- Role --}}
                    <div class="mb-8">

                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Role
                        </label>

                        <select
                            name="role"
                            class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500">

                            <option value="vendor_admin">
                                Vendor Admin
                            </option>

                            <option value="vendor">
                                Vendor User
                            </option>

                        </select>

                    </div>

                    <div class="flex justify-end">

                        <button
                            type="submit"
                            class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg">

                            + Create Team Member

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection