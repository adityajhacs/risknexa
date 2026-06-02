<h1>Edit Category</h1>

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name</label>
    <input type="text" name="name" value="{{ $category->name }}">

    <br><br>

    <label>Description</label>
    <textarea name="description">{{ $category->description }}</textarea>

    <br><br>

    <button type="submit">Update</button>
</form>