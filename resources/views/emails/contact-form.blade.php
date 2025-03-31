<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Form</title>
</head>
<body>
    <h1>New Form</h1>

    <p>Name: {{ $contact->name }}</p>
    <p>Phone: {{ $contact->phone }}</p>
    <p>Email: {{ $contact->email }}</p>

    <p>Sent date: {{ $contact->created_at }}</p>

    
</body>
</html>