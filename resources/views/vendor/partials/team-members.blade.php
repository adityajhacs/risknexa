@if(auth()->user()->role != 'vendor_admin')
    @php return; @endphp
@endif
<div class="bg-white rounded-3xl shadow-sm border border-slate-200">

    <div class="px-6 py-5 border-b">

        <h2 class="text-xl font-bold text-slate-800">
            Team Members
        </h2>

    </div>

    <div>

        @forelse($teamMembers as $member)

            <div class="flex items-center justify-between px-6 py-5 border-b last:border-0 hover:bg-slate-50">

                <div class="flex items-center gap-4">

                    <div class="w-11 h-11 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold">

                        {{ strtoupper(substr($member->name,0,1)) }}

                    </div>

                    <div>

                        <p class="font-semibold text-slate-800">

                            {{ $member->name }}

                        </p>

                        <p class="text-sm text-slate-500">

                            {{ ucwords(str_replace('_',' ',$member->role)) }}

                        </p>

                    </div>

                </div>

            </div>

        @empty

            <div class="p-8 text-center text-slate-400">

                No Team Members

            </div>

        @endforelse

    </div>

</div>