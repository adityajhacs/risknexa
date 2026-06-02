<h1>Edit Question</h1>

<form action="{{ route('questions.update', $question->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Category</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $question->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Question</label>
    <input type="text" name="question" value="{{ $question->question }}">

    <br><br>

    <label>Risk Weight</label>
    <input type="number" name="risk_weight" value="{{ $question->risk_weight }}">

    <br><br>

    <label>Status</label>
    <select name="status">
        <option value="active" {{ $question->status == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive" {{ $question->status == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    <br><br>

    <button type="submit">Update</button>
</form>