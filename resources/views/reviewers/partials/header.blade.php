<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

    <div class="flex justify-between items-start">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                {{ $assessment->assessment_name }}

            </h1>

            <p class="text-slate-500 mt-2">

                Vendor Risk Assessment Review Workspace

            </p>

        </div>

        <div>

            @php

                $statusColor = match($assessment->review_status){

                    'Accepted' => 'bg-green-100 text-green-700',

                    'Rejected' => 'bg-red-100 text-red-700',

                    'Clarification Required' => 'bg-yellow-100 text-yellow-700',

                    default => 'bg-blue-100 text-blue-700'

                };

            @endphp

            <span class="px-4 py-2 rounded-full font-semibold {{ $statusColor }}">

                {{ $assessment->review_status ?? 'Pending Review' }}

            </span>

        </div>

    </div>


    <div class="grid grid-cols-4 gap-6 mt-8">

        {{-- Vendor --}}

        <div>

            <p class="text-slate-500 text-sm">

                Vendor

            </p>

            <h3 class="font-bold text-lg">

                {{ $assessment->vendor->vendor_name }}

            </h3>

        </div>


        {{-- Framework --}}

        <div>

            <p class="text-slate-500 text-sm">

                Framework

            </p>

            <h3 class="font-bold text-lg">

                {{ $assessment->framework->name ?? 'N/A' }}

            </h3>

        </div>


        {{-- Priority --}}

        <div>

            <p class="text-slate-500 text-sm">

                Priority

            </p>

            <h3 class="font-bold text-lg">

                {{ $assessment->priority }}

            </h3>

        </div>


        {{-- Due Date --}}

        <div>

            <p class="text-slate-500 text-sm">

                Due Date

            </p>

            <h3 class="font-bold text-lg">

                {{ \Carbon\Carbon::parse($assessment->due_date)->format('d M Y') }}

            </h3>

        </div>

    </div>

</div>