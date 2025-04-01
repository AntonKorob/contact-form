<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контактная форма</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error { color: red; font-size: 0.8rem; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center shadow-lg p-4 mb-5 bg-body rounded">
            <div class="col-md-6">
                <h2 class="mb-4">Контактная форма</h2>
                
                <form id="contactForm">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Имя *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="error" id="nameError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                        <div class="error" id="phoneError"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="error" id="emailError"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
                
                <div id="successMessage" class="alert alert-success mt-3" style="display:none;"></div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(e) {
                e.preventDefault();
                
                // Очистка предыдущих ошибок
                $('.error').text('');
                
                $.ajax({
                    url: '/contact',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        $('#contactForm')[0].reset();
                        $('#successMessage').text(response.message).show();
                        
                        // Скрываем сообщение через 5 секунд
                        setTimeout(function() {
                            $('#successMessage').fadeOut();
                        }, 5000);
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var field in errors) {
                                $('#' + field + 'Error').text(errors[field][0]);
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