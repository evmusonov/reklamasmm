@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1 class="h3">Создание элемента</h1>
                @if (session('status'))
                    <p class="alert alert-danger" role="alert">{{ session('status') }}</p>
                @endif
                <form method="POST" action="/admin/menu">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ссылка</label>
                        <input type="text" name="link" class="form-control" value="{{ old('link') }}">
                        @error('link')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('link') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Сортировка</label>
                        <input type="text" name="weight" class="form-control" value="{{ old('weight') }}">
                        @error('weight')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('weight') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="status" id="status">
                        <label class="form-check-label" for="status">Включено</label>
                        @error('status')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('status') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
