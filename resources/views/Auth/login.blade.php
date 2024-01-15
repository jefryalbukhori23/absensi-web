<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .fullscreen-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .loading-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="fullscreen-overlay" style="display: none;">
        <div class="loading-container">
            <img src="{{ asset('assets/image/puff.svg') }}" class="me-4" style="width: 3rem"
                alt="audio">
            Loading...
        </div>
    </div>
    <div class="container">
        <div class="d-flex">
            <div class=""></div>
            <div class="d-flex flex-column align-items-center justify-content-center">
                <p>Login</p>
                <form id="form-login" action="" class="d-flex flex-column align-items-center justify-content-center">
                    @csrf
                    <label for="">Masukkan Email</label>
                    <input type="email" name="email" id="email">
                    <label for="">Masukkan password</label>
                    <input type="password" name="password" id="password">
                    <button type="submit" class="btn btn-success">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#form-login').submit(function(event) {
                event.preventDefault();

                var overlay = $('.fullscreen-overlay');
                var loadingIcon = $('.loading-container');

                overlay.show(); // Menampilkan layar penuh
                loadingIcon.show(); // Menampilkan indikator loading

                var tombolKirim = $(this).find('button[type="submit"]');

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/masuk',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            console.log(data.user)
                            const user = data.user;
                            // toastr.success(`Selamat datang, ${data.user.name}`);
                            if (data.user.role == 'admin') {
                                window.location.href = '/';
                            } else if (data.user.role == 'student') {
                                window.location.href ='/';
                            }
                            // Redirect or handle successful login
                        } else {
                            // Handle validation errors and display toast alerts
                            const errors = data.errors;
                            for (const [field, messages] of Object.entries(errors)) {
                                for (const message of messages) {
                                    toastr.error(message);
                                }
                            }
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        toastr.error('Email Atau Password Salah !');
                    },
                    complete: function() {
                        overlay.hide();
                        loadingIcon.hide();
                    }
                });
            });
        });
    </script>
</body>
</html>