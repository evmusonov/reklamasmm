<?php
 use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>Админ-панель</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/admin.css" rel="stylesheet">
    <script src="/bootstrap/js/jquery-3.4.1.min.js"></script>
    <script src="/bootstrap/js/bootstrap4.4.min.js"></script>
    <script src="/js/backend.js"></script>
</head>
<body>
    <header>
        <div class="row">
            <div class="col-sm-3">
                <a href="/admin">Административная панель</a>
            </div>
            <div class="col-sm-9">
                <div class="nav">
                    <a href="/" target="_blank">На гавную</a>
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
        <div class="container">
            Developed by <a href="https://github.com/evmusonov" target="_blank">Evgeny Musonov</a> &copy; 2020 - {{ date('Y') }}
        </div>
    </footer>
    <script src="/../node_modules/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor', {
            on: {
                instanceReady: function (evt) {
                    evt.editor.document.getBody().setStyles({color: 'black', 'font-size': '15px'})
                }
            },
            customConfig: '/js/ckeditor_config.js'
        });
    </script>
</body>
</html>
