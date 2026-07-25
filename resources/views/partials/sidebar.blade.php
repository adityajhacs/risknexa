<aside class="w-64 bg-slate-900 text-white shadow-xl border-r border-slate-800 flex flex-col">

    {{-- Logo --}}
    <div class="p-6 border-b border-slate-800">
        <h1 class="text-3xl font-bold text-blue-400">RiskNexa</h1>

        <p class="text-slate-400 text-sm mt-1">
            Vendor Risk Platform
        </p>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 p-4 space-y-2">

        {{-- ================= ADMIN ================= --}}
       @if(in_array(auth()->user()->role, [
    'admin',
    'company_admin',
    'super_admin'
]))

            <a href="{{ route('dashboard') }}"
                class="block px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('vendors.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('vendors*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                👥 Vendors
            </a>

            <a href="{{ route('assessments.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('assessments*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📋 Assessments
            </a>

            <a href="{{ route('frameworks.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('frameworks*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                🛡️ Frameworks
            </a>

            <a href="{{ route('domains.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('domains*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                🌐 Domains
            </a>

            <a href="{{ route('categories.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('categories*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📂 Categories
            </a>

            <a href="{{ route('questions.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('questions*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                ❓ Questions
            </a>

            <a href="{{ route('reviewers.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('reviewers*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                🧑‍💼 Reviewers
            </a>

            <a href="{{ route('users.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('users*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                👤 Users
            </a>

            <a href="{{ route('reports.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('reports*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📄 Reports
            </a>

        {{-- ================= REVIEWER ================= --}}
        @elseif(auth()->user()->role == 'reviewer')

            <a href="{{ route('reviewer.dashboard') }}"
                class="block px-4 py-3 rounded-lg {{ request()->routeIs('reviewer.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('reviewers.assessment.overview',$assessment->id) }}"
                class="block px-4 py-3 rounded-lg {{ request()->routeIs('reviewers.assessment.overview') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📝 My Reviews
            </a>

            <a href="{{ route('reports.index') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('reports*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📄 Reports
            </a>

        {{-- ================= VENDOR ================= --}}
        @elseif(auth()->user()->role == 'vendor')

            <a href="{{ route('vendor.dashboard') }}"
                class="block px-4 py-3 rounded-lg {{ request()->routeIs('vendor.dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📊 Dashboard
            </a>

            <a href="{{ route('my.assessments') }}"
                class="block px-4 py-3 rounded-lg {{ request()->is('my-assessments*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-300' }}">
                📋 My Assessments
            </a>

        @endif

    </nav>

    {{-- Footer --}}
    <div class="border-t border-slate-800 p-5">

        <div class="font-semibold">
            {{ auth()->user()->name }}
        </div>

        <div class="text-sm text-slate-400 capitalize">
            {{ auth()->user()->role }}
        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf

            <button
                type="submit"
                class="w-full bg-red-600 hover:bg-red-700 py-2 rounded-lg">
                Logout
            </button>
        </form>

    </div>

</aside>