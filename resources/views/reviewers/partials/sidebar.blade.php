<div class="w-80 bg-white rounded-2xl shadow-sm border border-slate-200 flex flex-col">

    <!-- Heading -->
    <div class="p-6 border-b">

        <h2 class="text-xl font-bold text-slate-800">
            Assessment Progress
        </h2>

        <p class="text-sm text-slate-500 mt-1">
            Review every domain one by one
        </p>

    </div>

    <!-- Progress -->
    <div class="p-6">

        <div class="flex justify-between mb-2">

            <span class="text-sm text-slate-500">
                Progress
            </span>

            <span class="font-semibold">
                0%
            </span>

        </div>

        <div class="w-full h-3 bg-slate-200 rounded-full">

            <div class="h-3 bg-blue-600 rounded-full"
                 style="width:0%">
            </div>

        </div>

    </div>

    <!-- Domain List -->
    <div class="flex-1 overflow-y-auto px-4 pb-6">

        <h3 class="text-xs uppercase tracking-wider text-slate-400 mb-3">
            Domains
        </h3>

        @foreach($assessment->assessmentQuestions->groupBy(function($item){
            return $item->question->domain->name;
        }) as $domainName => $questions)

            <div class="mb-3">

                <button
                    class="w-full flex items-center justify-between bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-400 rounded-xl px-4 py-3 transition">

                    <div>

                        <p class="font-semibold text-slate-700">
                            {{ $domainName }}
                        </p>

                        <p class="text-xs text-slate-500">
                            {{ $questions->count() }} Questions
                        </p>

                    </div>

                    <span
                        class="w-3 h-3 rounded-full bg-slate-300">
                    </span>

                </button>

            </div>

        @endforeach

    </div>

</div>