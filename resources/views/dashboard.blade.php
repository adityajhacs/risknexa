<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

@if(auth()->user()->role == 'company_admin')

    <h2 class="text-2xl font-bold mb-6">
        Company Admin Dashboard
    </h2>

    <div class="grid grid-cols-3 gap-6">

        <a href="/vendors"
           class="bg-blue-600 text-white p-6 rounded-lg shadow">
            Manage Vendors
        </a>

        <a href="/assessments"
           class="bg-green-600 text-white p-6 rounded-lg shadow">
            Manage Assessments
        </a>

        <a href="/questions"
           class="bg-purple-600 text-white p-6 rounded-lg shadow">
            Question Bank
        </a>

    </div>

@else

    <h2 class="text-2xl font-bold mb-6">
        Vendor Dashboard
    </h2>

    <div class="bg-green-100 p-6 rounded-lg">
        Welcome Vendor
    </div>

@endif

</div>
            </div>
        </div>
    </div>
</x-app-layout>
