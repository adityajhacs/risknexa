<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">

    <div class="mb-8">

        <h2 class="text-2xl font-bold text-slate-800">
            Quick Actions
        </h2>

        <p class="text-slate-500 mt-2">
            Frequently used features
        </p>

    </div>

    <div class="grid md:grid-cols-2 gap-6">

        <a href="{{ route('my.assessments') }}"
           class="group border rounded-2xl p-6 hover:border-blue-500 hover:shadow-lg transition">

            <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600">
                My Assessments
            </h3>

            <p class="text-slate-500 mt-2 text-sm">
                View and complete assigned assessments.
            </p>

        </a>

        <a href="{{ route('vendor-users.index') }}"
           class="group border rounded-2xl p-6 hover:border-blue-500 hover:shadow-lg transition">

            <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600">
                Team Members
            </h3>

            <p class="text-slate-500 mt-2 text-sm">
                View and manage vendor users.
            </p>

        </a>

        <a href="{{ route('vendor-users.create') }}"
           class="group border rounded-2xl p-6 hover:border-blue-500 hover:shadow-lg transition">

            <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600">
                Create User
            </h3>

            <p class="text-slate-500 mt-2 text-sm">
                Add a new vendor admin or vendor user.
            </p>

        </a>

        <a href="{{ route('reports.index') }}"
           class="group border rounded-2xl p-6 hover:border-blue-500 hover:shadow-lg transition">

            <h3 class="font-bold text-lg text-slate-800 group-hover:text-blue-600">
                Reports
            </h3>

            <p class="text-slate-500 mt-2 text-sm">
                View compliance reports and progress.
            </p>

        </a>

    </div>

</div>