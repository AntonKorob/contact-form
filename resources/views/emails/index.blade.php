<!DOCTYPE html>
<html>
<head>
    <title>Сохраненные письма</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4 bg-info shadow-lg p-3 mb-5 bg-body rounded">
        <h1>Сохраненные письма</h1>

        <button type="button" class="btn btn-primary mb-3"><a class="text-white text-decoration-none" href="/">Назад</a></button>

        @foreach($emails as $email)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $email['file'] }}
                </div>
                <div class="card-body">
                    {!! $email['content'] !!}
                </div>
            </div>
        @endforeach
        
    </div>
</body>
</html>