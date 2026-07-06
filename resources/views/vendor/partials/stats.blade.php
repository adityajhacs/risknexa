<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-7 hover:shadow-xl transition">

        <p class="text-slate-500 text-sm uppercase tracking-wider">
            Total Assessments
        </p>

        <h2 class="text-5xl font-bold text-slate-800 mt-5">

            {{ $assessmentCount }}

        </h2>

        <p class="text-green-600 mt-4 font-medium">

            Active Compliance Tasks

        </p>

    </div>



    <div class="bg-white rounded-3xl shadow-sm border border-orange-100 p-7 hover:shadow-xl transition">

        <p class="text-slate-500 text-sm uppercase tracking-wider">

            Pending

        </p>

        <h2 class="text-5xl font-bold text-orange-500 mt-5">

            {{ $pending }}

        </h2>

        <p class="text-orange-600 mt-4 font-medium">

            Require Attention

        </p>

    </div>



    <div class="bg-white rounded-3xl shadow-sm border border-green-100 p-7 hover:shadow-xl transition">

        <p class="text-slate-500 text-sm uppercase tracking-wider">

            Completed

        </p>

        <h2 class="text-5xl font-bold text-green-600 mt-5">

            {{ $completed }}

        </h2>

        <p class="text-green-600 mt-4 font-medium">

            Successfully Finished

        </p>

    </div>



    <div class="bg-white rounded-3xl shadow-sm border border-blue-100 p-7 hover:shadow-xl transition">

        <p class="text-slate-500 text-sm uppercase tracking-wider">

            Team Members

        </p>

        <h2 class="text-5xl font-bold text-blue-600 mt-5">

            {{ $teamCount }}

        </h2>

        <p class="text-blue-600 mt-4 font-medium">

            Active Users

        </p>

    </div>

</div>