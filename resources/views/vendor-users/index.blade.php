<x-app-layout>

<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Team Members
            </h1>

            <p class="text-slate-500 mt-2">
                Manage Vendor Admins and Vendor Users
            </p>

        </div>

        <a
            href="{{ route('vendor-users.create') }}"
            class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold shadow">

            + Create User

        </a>

    </div>

    {{-- Success Message --}}
    @if(session('success'))

    <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-5 py-4">

        {{ session('success') }}

    </div>

    @endif
    @if(session('error'))
<div class="mb-6 rounded-xl bg-red-100 border border-red-300 text-red-700 px-5 py-4">
    {{ session('error') }}
</div>
@endif

    {{-- Card --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="text-left px-6 py-4 font-semibold">
                        Name
                    </th>

                    <th class="text-left px-6 py-4 font-semibold">
                        Email
                    </th>

                    <th class="text-left px-6 py-4 font-semibold">
                        Role
                    </th>

                    <th class="text-center px-6 py-4 font-semibold">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-t hover:bg-slate-50">

                    <td class="px-6 py-5">

                        <div class="font-semibold text-slate-800">

                            {{ $user->name }}

                        </div>

                    </td>

                    <td class="px-6 py-5 text-slate-600">

                        {{ $user->email }}

                    </td>

                    <td class="px-6 py-5">

                        @if($user->role == 'vendor_admin')

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">

                                Vendor Admin

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                                Vendor User

                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-2">

                            {{-- View --}}
                            <a
                                href="{{ route('vendor-users.show',$user->id) }}"
                                class="px-3 py-2 rounded-lg bg-sky-100 text-sky-700 hover:bg-sky-200 text-sm font-medium">

                                View

                            </a>

                            {{-- Edit --}}
                            <a
                                href="{{ route('vendor-users.edit',$user->id) }}"
                                class="px-3 py-2 rounded-lg bg-amber-100 text-amber-700 hover:bg-amber-200 text-sm font-medium">

                                Edit

                            </a>

                            {{-- Delete --}}
                            <form
                                action="{{ route('vendor-users.destroy',$user->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?')">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium">

                                    Delete

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="py-16 text-center">

                        <h3 class="text-xl font-semibold text-slate-700">

                            No Team Members Found

                        </h3>

                        <p class="text-slate-500 mt-2">

                            Create your first Vendor Admin or Vendor User.

                        </p>

                        <a
                            href="{{ route('vendor-users.create') }}"
                            class="inline-block mt-6 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">

                            + Create User

                        </a>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>