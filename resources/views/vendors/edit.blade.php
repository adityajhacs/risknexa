<!DOCTYPE html>
<html>
<head>
    <title>Edit Vendor</title>
</head>
<body>

<h1>Edit Vendor</h1>

<form action="/vendors/{{ $vendor->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Vendor Name:</label>
    <input type="text" name="vendor_name" value="{{ $vendor->vendor_name }}">
    <br><br>

    <label>Contact Person:</label>
    <input type="text" name="contact_person" value="{{ $vendor->contact_person }}">
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $vendor->email }}">
    <br><br>

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $vendor->phone }}">
    <br><br>

    <label>Country:</label>
    <input type="text" name="country" value="{{ $vendor->country }}">
    <br><br>

    <button type="submit">Update Vendor</button>

</form>

</body>
</html>