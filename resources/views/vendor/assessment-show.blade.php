<h2>{{ $assessment->assessment_name }}</h2>

<table border="1" cellpadding="10">

<tr>
    <th>Question</th>
    <th>Response</th>
</tr>

@foreach($assessment->assessmentQuestions as $item)

<tr>
    <td>{{ $item->question->question }}</td>

    <td>
        <input type="text" name="response">
    </td>
</tr>

@endforeach

</table>