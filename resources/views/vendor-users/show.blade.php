@extends('layouts.vendor')

@section('content')

<div class="max-w-4xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Team Member Details
            </h1>

            <p class="text-slate-500 mt-2">
                View complete information about this team member.
            </p>

        </div>

        <a
            href="{{ route('vendor-users.index') }}"
            class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">

            ← Back

        </a>

    </div>

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

        {{-- Top --}}
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-8 text-white">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-3xl font-bold">

                        {{ $user->name }}

                    </h2>

                    <p class="text-blue-100 mt-2">

                        {{ $user->email }}

                    </p>

                </div>

                @if($user->role=='vendor_admin')

                    <span class="px-4 py-2 rounded-full bg-white/20">

                        Vendor Admin

                    </span>

                @else

                    <span class="px-4 py-2 rounded-full bg-green-500">

                        Vendor User

                    </span>

                @endif

            </div>

        </div>

        {{-- Details --}}
        <div class="grid md:grid-cols-2 gap-8 p-8">

            <div>

                <p class="text-xs uppercase text-slate-500">

                    Full Name

                </p>

                <p class="font-semibold text-lg mt-1">

                    {{ $user->name }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-slate-500">

                    Email Address

                </p>

                <p class="font-semibold text-lg mt-1">

                    {{ $user->email }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-slate-500">

                    Role

                </p>

                <p class="font-semibold text-lg mt-1">

                    {{ $user->role=='vendor_admin' ? 'Vendor Admin' : 'Vendor User' }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-slate-500">

                    Account Created

                </p>

                <p class="font-semibold text-lg mt-1">

                    {{ $user->created_at->format('d M Y h:i A') }}

                </p>

            </div>

            <div>

                <p class="text-xs uppercase text-slate-500">

                    Last Updated

                </p>

                <p class="font-semibold text-lg mt-1">

                    {{ $user->updated_at->format('d M Y h:i A') }}

                </p>

            </div>

        </div>

        {{-- Footer Buttons --}}
        <div class="border-t p-6 flex justify-end gap-3">

            <a
                href="{{ route('vendor-users.edit',$user->id) }}"
                class="px-5 py-3 rounded-xl bg-amber-500 text-white hover:bg-amber-600">

                Edit User

            </a>

            <form
                method="POST"
                action="{{ route('vendor-users.destroy',$user->id) }}"
                onsubmit="return confirm('Delete this user?')">

                @csrf
                @method('DELETE')

                <button
                    class="px-5 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700">

                    Delete User

                </button>

            </form>

        </div>

    </div>

</div>

@endsection