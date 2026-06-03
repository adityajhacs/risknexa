<h1>Assessment Questions</h1>

<a href="{{ route('assessment-questions.create') }}">
    Assign New Question
</a>

<table border="1">
    <tr>
        <th>Assessment</th>
        <th>Question</th>
    </tr>

    @foreach($assessmentQuestions as $item)
    <tr>
        <td>{{ $item->assessment->assessment_name }}</td>
        <td>{{ $item->question->question }}</td>
    </tr>
    @endforeach
</table>