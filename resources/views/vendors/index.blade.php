<!DOCTYPE html>
<html>
<head>
    <th>Action</th>
    <title>Vendors List</title>
</head>
<body>

<h1>All Vendors</h1>

<a href="/vendors/create">Add Vendor</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>Vendor Name</th>
        <th>Contact Person</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Country</th>
        <th>Criticality</th>
        <th>Status</th>
    </tr>

    @foreach($vendors as $vendor)
    <tr>
        <td>{{ $vendor->vendor_name }}</td>
        <td>{{ $vendor->contact_person }}</td>
        <td>{{ $vendor->email }}</td>
        <td>{{ $vendor->phone }}</td>
        <td>{{ $vendor->country }}</td>
        <td>{{ $vendor->criticality }}</td>
        <td>{{ $vendor->status }}</td>
        <td>
    <a href="/vendors/{{ $vendor->id }}/edit">Edit</a>
    <form action="/vendors/{{ $vendor->id }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit">Delete</button>
</form>
</td>
    </tr>
    @endforeach

</table>

</body>
</html>