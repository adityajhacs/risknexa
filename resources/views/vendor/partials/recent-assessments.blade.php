<div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="flex items-center justify-between px-8 py-6 border-b">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Recent Assessments

            </h2>

            <p class="text-slate-500 mt-1">

                Latest assigned compliance assessments.

            </p>

        </div>

        <a href="{{ route('my.assessments') }}"
           class="text-blue-600 font-semibold hover:text-blue-800">

            View All

        </a>

    </div>

    <table class="w-full">

        <thead class="bg-slate-50">

        <tr>

            <th class="text-left px-8 py-4">Assessment</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Due</th>

        </tr>

        </thead>

        <tbody>

        @forelse($recentAssessments as $assessment)

        <tr class="border-t hover:bg-slate-50">

            <td class="px-8 py-5 font-semibold">

                {{ $assessment->assessment_name }}

            </td>

            <td>

                <span class="px-3 py-1 rounded-full
                {{ $assessment->status=='Completed'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-yellow-100 text-yellow-700' }}">

                    {{ $assessment->status }}

                </span>

            </td>

            <td>

                {{ $assessment->priority ?? 'Normal' }}

            </td>

            <td>

                {{ $assessment->due_date ?? '--' }}

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="4" class="text-center py-12 text-slate-400">

                No assessments found.

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>