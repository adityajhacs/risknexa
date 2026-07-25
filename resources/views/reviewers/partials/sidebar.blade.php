<div class="bg-white rounded-2xl shadow border border-slate-200 p-5">

    <h2 class="text-xl font-bold mb-5">
        Domains
    </h2>

    @php
        $domains = $questions->groupBy(fn($q)=>optional($q->domain)->name ?? 'General');
    @endphp

    @foreach($domains as $domainName => $domainQuestions)

        <button
            type="button"
            onclick="showDomain({{ $loop->index }})"
            id="domainBtn{{ $loop->index }}"
            class="domain-btn w-full text-left mb-3 rounded-xl border p-4 hover:bg-blue-50">

            <div class="flex justify-between">

                <span class="font-semibold">
                    {{ $domainName }}
                </span>

                <span class="text-sm text-slate-500">
                    {{ $domainQuestions->count() }}
                </span>

            </div>

        </button>

    @endforeach

</div>