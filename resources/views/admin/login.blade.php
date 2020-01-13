@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="auth-form">
                <h1 class="h3">Авторизация</h1>
                @if (session('status'))
                    <p class="alert alert-danger" role="alert">{{ session('status') }}</p>
                @endif
                <form method="POST" action="/admin/login">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Логин</label>
                        <input type="text" name="login" class="form-control">
                        @error('login')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('login') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('password') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Запомнить</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
@endsection
