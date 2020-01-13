<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Админ-панель</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/admin.css" rel="stylesheet">
    <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap4.4.min.js"></script>
</head>
<body>
    <header>
        <div class="row">
            <div class="col-sm-3">
                Административная панель
            </div>
            <div class="col-sm-9">
                <div class="nav">
                    <a href="/">Главная</a>
                    @if (Auth::check())
                        <a href="/admin/logout">Выйти</a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>
