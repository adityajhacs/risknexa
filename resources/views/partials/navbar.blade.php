<div class="bg-white h-16 rounded-2xl shadow-sm border border-slate-200 mb-6 flex items-center justify-between px-6">

    <h2 class="font-semibold text-slate-800">
        RiskNexa Platform
    </h2>

    <div class="flex items-center gap-3">

        <div class="text-right">

            <p class="font-semibold text-slate-800">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-slate-500">
                {{ auth()->user()->role }}
            </p>

        </div>

        <div class="w-11 h-11 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white flex items-center justify-center font-bold shadow-md">
            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="bg-red-500 text-white px-4 py-2 rounded-xl hover:bg-red-600">
                Logout
            </button>

        </form>

    </div>

</div>