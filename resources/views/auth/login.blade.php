<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>{{ $title }}</title>
</head>

<body>
    <div class="container">
        <div class="mt-5">
            @include('layouts.alerts')
        </div>

        <div class="row justify-content-center align-items-center" style="">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="{{ route('login.auth') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <input type="text" class="form-control form-control-sm" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                                <input type="password" class="form-control form-control-sm" name="password" required>
                            </div>
                            <div align="right">
                                <button type="submit" id="sendlogin" class="btn btn-primary btn-sm mt-2">login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--JS-->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

<style>
    body {
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: left;
        background-color: #f5f8fa;
    }
    .navbar-laravel {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
    }
    .navbar-brand,
    .nav-link,
    .my-form,
    .login-form {
        font-family: Raleway, sans-serif;
    }
    .my-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .my-form .row {
        margin-left: 0;
        margin-right: 0;
    }
    .login-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    .login-form .row {
        margin-left: 0;
        margin-right: 0;
    }
</style>

</html>

