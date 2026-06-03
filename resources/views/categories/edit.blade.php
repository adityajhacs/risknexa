<h1>Edit Category</h1>
<h1>Add Category</h1>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <label>Name</label>
    <input type="text" name="name">

    <br><br>

    <label>Description</label>
    <textarea name="description"></textarea>

    <br><br>

    <button type="submit">Save</button>
</form>

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