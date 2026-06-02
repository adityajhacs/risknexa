<h1>Add Question</h1>

<form action="{{ route('questions.store') }}" method="POST">
    @csrf

    <label>Category</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Question</label>
    <input type="text" name="question">

    <br><br>

    <label>Risk Weight</label>
    <input type="number" name="risk_weight">

    <br><br>

    <label>Status</label>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <br><br>

    <button type="submit">Save</button>
</form>