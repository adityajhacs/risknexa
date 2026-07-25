<div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 shadow-xl">

    <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
    <div class="absolute -left-20 bottom-0 h-60 w-60 rounded-full bg-cyan-300/10 blur-3xl"></div>

    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center p-10">

        <div class="max-w-2xl">

            <span class="inline-flex rounded-full bg-white/15 px-5 py-2 text-sm tracking-widest uppercase text-white">

                Vendor Portal

            </span>

            <h1 class="mt-6 text-5xl font-extrabold text-white leading-tight">

                Welcome Back,<br>

                {{ strtoupper(auth()->user()->name) }}

            </h1>

            <p class="mt-6 text-lg text-blue-100">

                Monitor assessments, manage your vendor team and track
                compliance progress from one centralized dashboard.

            </p>

        </div>

        <div class="mt-10 lg:mt-0">

            <div class="rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 p-8 w-80">

                <h3 class="uppercase text-blue-100 tracking-wide">

                    Organization

                </h3>

                <h2 class="mt-3 text-4xl font-bold text-white">

                    {{ auth()->user()->vendor->name ?? 'Vendor Company' }}

                </h2>

                <div class="mt-8">

                    <div class="flex justify-between text-white mb-2">

                        <span>Completion</span>

                        <span>
                            {{ $assessmentCount ? round(($completed/$assessmentCount)*100) : 0 }}%
                        </span>

                    </div>

                    <div class="h-3 rounded-full bg-white/20">

                        <div
                            class="h-3 rounded-full bg-cyan-300"
                            style="width: {{ $assessmentCount ? round(($completed/$assessmentCount)*100) : 0 }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>