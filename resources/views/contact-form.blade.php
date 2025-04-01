<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контактная форма</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error { color: red; font-size: 0.8rem; }
        #success-message { display: none; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center shadow-lg p-3 mb-5 bg-body rounded">
            <div class="col-md-6">
                <h2 class="mb-4">Контактная форма</h2>
                
                <form id="contactForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="error" id="name-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                        <div class="error" id="phone-error"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="error" id="email-error"></div>
                    </div>
                    <button type="button" class="btn btn-primary"><a class="text-white text-decoration-none" href="/emails">Админ</a></button>

                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
                
                <div id="success-message" class="alert alert-success mt-3"></div>
                
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').on('submit', function(e) {
                e.preventDefault();
                
                // Очищаем предыдущие ошибки
                $('.error').text('');
                $('#success-message').hide();
                
                $.ajax({
                    url: '{{ route("contact.store") }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#contactForm')[0].reset();
                        $('#success-message').text(response.message).show();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                $('#' + field + '-error').text(errors[field][0]);
                            }
                        } else {
                            alert('Произошла ошибка. Пожалуйста, попробуйте позже.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>