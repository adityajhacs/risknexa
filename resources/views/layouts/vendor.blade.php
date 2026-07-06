<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RiskNexa Vendor Portal</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->

    <aside class="w-72 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-800 text-white flex flex-col shadow-2xl">

    {{-- Logo --}}
    <div class="px-8 py-8 border-b border-slate-700/70">

        <h1 class="text-3xl font-extrabold tracking-wide">
            Risk<span class="text-blue-400">Nexa</span>
        </h1>

        <p class="text-slate-400 text-sm mt-1">
            Vendor Portal
        </p>

    </div>

    {{-- Profile --}}
    <div class="px-6 py-6 border-b border-slate-700/70">

        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-xl font-bold shadow-lg">

                {{ strtoupper(substr(auth()->user()->name,0,1)) }}

            </div>

            <div>

                <h3 class="font-semibold text-lg">

                    {{ auth()->user()->name }}

                </h3>

                <p class="text-sm text-slate-400">

                    {{ auth()->user()->role == 'vendor_admin' ? 'Vendor Admin' : 'Vendor User' }}

                </p>

            </div>

        </div>

    </div>

    {{-- Menu --}}
    <!-- Menu -->
<nav class="flex-1 px-5 py-6 space-y-2">

    <a href="{{ route('vendor.dashboard') }}"
       class="flex items-center gap-3 px-5 py-3 rounded-xl transition
       {{ request()->routeIs('vendor.dashboard')
            ? 'bg-blue-600 text-white shadow-lg font-semibold'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8"/>
        </svg>

        Dashboard
    </a>


    <a href="{{ route('my.assessments') }}"
       class="flex items-center gap-3 px-5 py-3 rounded-xl transition
       {{ request()->routeIs('my.assessments')
            ? 'bg-blue-600 text-white shadow-lg font-semibold'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 17v-2m3 2V7m3 10v-4m3 8H6a2 2 0 01-2-2V5a2 2 0 012-2h8l6 6v10a2 2 0 01-2 2z"/>
        </svg>

        My Assessments
    </a>


    <a href="{{ route('vendor-users.index') }}"
       class="flex items-center gap-3 px-5 py-3 rounded-xl transition
       {{ request()->routeIs('vendor-users.index')
            ? 'bg-blue-600 text-white shadow-lg font-semibold'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-8 0v2m8 0H9m4-10a4 4 0 110-8 4 4 0 010 8z"/>
        </svg>

        Team Members
    </a>


    <a href="{{ route('vendor-users.create') }}"
       class="flex items-center gap-3 px-5 py-3 rounded-xl transition
       {{ request()->routeIs('vendor-users.create')
            ? 'bg-blue-600 text-white shadow-lg font-semibold'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M18 9v6m3-3h-6M5 19h8a2 2 0 002-2v-1a4 4 0 00-8 0v1a2 2 0 01-2 2z"/>
        </svg>

        Create User
    </a>


    <a href="{{ route('reports.index') }}"
       class="flex items-center gap-3 px-5 py-3 rounded-xl transition
       {{ request()->routeIs('reports.*')
            ? 'bg-blue-600 text-white shadow-lg font-semibold'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 17v-6m4 6V7m4 10v-3"/>
        </svg>

        Reports
    </a>

</nav>

    {{-- Logout --}}
    <div class="p-6 border-t border-slate-700/70">

        <form method="POST" action="{{ route('logout') }}">

            @csrf

            <button
                class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H9m4 8H7a2 2 0 01-2-2V6a2 2 0 012-2h6"/>

                </svg>

                Logout

            </button>

        </form>

    </div>

</aside>


    <!-- Content -->

    <main class="flex-1">

       @yield('content')

    </main>

</div>

</body>

</html>