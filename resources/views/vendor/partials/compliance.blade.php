<div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

    <h2 class="text-xl font-bold text-slate-800">

        Compliance Progress

    </h2>

    <p class="text-slate-500 mt-1">

        Overall completion

    </p>

    @php

        $progress = $assessmentCount
            ? round(($completed/$assessmentCount)*100)
            : 0;

    @endphp

    <div class="mt-6">

        <div class="flex justify-between mb-2">

            <span class="text-slate-600">

                Progress

            </span>

            <span class="font-semibold">

                {{ $progress }}%

            </span>

        </div>

        <div class="h-3 rounded-full bg-slate-200">

            <div
                class="h-3 rounded-full bg-blue-600"
                style="width:{{ $progress }}%">

            </div>

        </div>

    </div>

    <div class="grid grid-cols-2 gap-5 mt-8">

        <div>

            <p class="text-sm text-slate-500">

                Pending

            </p>

            <h3 class="text-3xl font-bold text-orange-500">

                {{ $pending }}

            </h3>

        </div>

        <div>

            <p class="text-sm text-slate-500">

                Completed

            </p>

            <h3 class="text-3xl font-bold text-green-600">

                {{ $completed }}

            </h3>

        </div>

    </div>

</div>