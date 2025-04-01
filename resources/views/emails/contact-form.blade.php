<!DOCTYPE html>
<html>
<head>
    <title>Новая заявка</title>
</head>
<body>
    <h1>Новая заявка с контактной формы</h1>
    
    <p><strong>Имя:</strong> {{ $contact->name }}</p>
    <p><strong>Телефон:</strong> {{ $contact->phone }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    
    <p>Дата отправки: {{ $contact->created_at }}</p>
</body>
</html>