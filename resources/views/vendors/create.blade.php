<!DOCTYPE html>
<html>
<head>
    <title>Add Vendor</title>
</head>
<body>

<h1>Add Vendor</h1>
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/vendors" method="POST">
    @csrf

    <label>Vendor Name:</label>
    <input type="text" name="vendor_name">
    <label>Contact Person:</label>
<input type="text" name="contact_person"><br><br>

<label>Email:</label>
<input type="email" name="email"><br><br>

<label>Phone:</label>
<input type="text" name="phone"><br><br>

<label>Country:</label>
<input type="text" name="country"><br><br>

<label>Criticality:</label>
<select name="criticality">
    <option value="Low">Low</option>
    <option value="Medium">Medium</option>
    <option value="High">High</option>
    <option value="Critical">Critical</option>
</select><br><br>

<label>Status:</label>
<select name="status">
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
</select><br><br>

    <button type="submit">Save Vendor</button>
</form>

</body>
</html>