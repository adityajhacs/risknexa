<h1>All Questions</h1>

<a href="{{ route('questions.create') }}">Add Question</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Question</th>
        <th>Risk Weight</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($questions as $question)
    <tr>
        <td>{{ $question->id }}</td>
        <td>{{ $question->category->name }}</td>
        <td>{{ $question->question }}</td>
        <td>{{ $question->risk_weight }}</td>
        <td>{{ $question->status }}</td>
        <td>
    <a href="{{ route('questions.edit', $question->id) }}">Edit</a>

    <form action="{{ route('questions.destroy', $question->id) }}"
          method="POST"
          style="display:inline;">
        @csrf
        @method('DELETE')

        <button type="submit">Delete</button>
    </form>
</td>
    </tr>
    @endforeach
</table>