<aside class="w-64 bg-slate-900 text-white shadow-2xl border-r border-slate-800">

    <div class="p-6 border-b border-slate-800">

        <h1 class="text-3xl font-bold tracking-tight">
            RiskNexa
        </h1>

        <p class="text-slate-400 text-sm mt-2">
            Vendor Risk Platform
        </p>

        <div class="mt-4 text-xs uppercase tracking-widest text-slate-500">
            Governance & Compliance
        </div>

    </div>

    <nav class="p-4 space-y-2">

        <p class="text-xs uppercase tracking-widest text-slate-500 px-4 mb-3">
            Main Menu
        </p>

        <a href="/dashboard"
class="flex items-center gap-3 px-4 py-3 rounded-xl transition
{{ request()->is('dashboard')
? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
: 'hover:bg-slate-800 text-white' }}">
            <span>📊</span>
            <span>Dashboard</span>
        </a>

         <a href="/vendors"
class="flex items-center gap-3 px-4 py-3 rounded-xl transition
{{ request()->is('vendors*')
? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg'
: 'hover:bg-slate-800 text-white' }}">
            <span>👥</span>
            <span>Vendors</span>
        </a>

        <a href="/assessments"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>📋</span>
            <span>Assessments</span>
        </a>
        <a href="/frameworks"
   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
    <span>🛡️</span>
    <span>Frameworks</span>
</a>

<a href="/domains"
   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
    <span>🌐</span>
    <span>Domains</span>
</a>

        <a href="/categories"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>📂</span>
            <span>Categories</span>
        </a>

        <a href="/questions"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>❓</span>
            <span>Questions</span>
        </a>

        <a href="/assessment-questions"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>✅</span>
            <span>Assessment Questions</span>
        </a>

        <a href="/users"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>👤</span>
            <span>Users</span>
        </a>

        <a href="/reports"
           class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-800 transition">
            <span>📄</span>
            <span>Reports</span>
        </a>

    </nav>

</aside>