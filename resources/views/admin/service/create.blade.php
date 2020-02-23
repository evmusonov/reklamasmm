@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1 class="h3">Создание элемента <a href="/admin/services" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/admin/services" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Подзаголовок</label>
                        <input type="text" name="sub_title" class="form-control" value="{{ old('sub_title') }}">
                        @error('sub_title')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('sub_title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Цена</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('price') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст</label>
                        <textarea id="editor" name="body" class="form-control">{{ old('body') }}</textarea>
                        @error('body')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('body') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Сортировка</label>
                        <input type="text" name="weight" class="form-control" value="{{ old('weight') }}">
                        @error('weight')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('weight') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Обложка</label>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        @error('image')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('image') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="new" value="0">
                        <input type="checkbox" class="form-check-input" name="new" id="new" value="1">
                        <label class="form-check-label" for="new">Новинка</label>
                        @error('new')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('new') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="hit" value="0">
                        <input type="checkbox" class="form-check-input" name="v" id="hit" value="1">
                        <label class="form-check-label" for="hit">Хит</label>
                        @error('hit')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('hit') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="sale" value="0">
                        <input type="checkbox" class="form-check-input" name="sale" id="sale" value="1">
                        <label class="form-check-label" for="sale">Скидка</label>
                        @error('sale')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('sale') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1">
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
