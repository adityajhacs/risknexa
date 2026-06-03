<h1>Assign Question</h1>

<form action="{{ route('assessment-questions.store') }}" method="POST">
    @csrf

    <label>Assessment</label>
    <select name="assessment_id">
        @foreach($assessments as $assessment)
            <option value="{{ $assessment->id }}">
                {{ $assessment->assessment_name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Question</label>
    <select name="question_id">
        @foreach($questions as $question)
            <option value="{{ $question->id }}">
                {{ $question->question }}
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">
        Assign Question
    </button>
</form>