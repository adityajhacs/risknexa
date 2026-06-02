<h1>All Categories</h1>

<a href="/categories/create">Add Category</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>
        <td>
    <a href="{{ route('categories.edit', $category->id) }}">Edit</a>

    <form action="{{ route('categories.destroy', $category->id) }}"
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