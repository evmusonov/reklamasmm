@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1 class="h3">Редактирование элемента <a href="/admin/infoblocks" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/admin/infoblocks/{{ $infoblock->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Заголовок</label>
                        <input type="text" name="title" class="form-control" value="{{ $infoblock->title }}">
                        @error('title')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Алиас</label>
                        <input type="text" name="alias" class="form-control" value="{{ $infoblock->alias }}">
                        @error('alias')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('alias') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст</label>
                        <textarea id="editor" name="body" class="form-control">{{ $infoblock->body }}</textarea>
                        @error('body')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('body') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1" {{ $infoblock->status ? 'checked="checked"' : '' }}>
                        <label class="form-check-label" for="status">Включено</label>
                        @error('status')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('status') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
