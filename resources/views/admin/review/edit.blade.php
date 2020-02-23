@extends('admin.layout')

@php
use App\Components\ImgHelper;
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1 class="h3">Редактирование элемента <a href="/admin/reviews" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/admin/reviews/{{ $review->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Автор</label>
                        <input type="text" name="author" class="form-control" value="{{ $review->author }}">
                        @error('author')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('author') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Текст</label>
                        <textarea id="editor" name="body" class="form-control" rows="6">{{ $review->body }}</textarea>
                        @error('body')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('body') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Сортировка</label>
                        <input type="text" name="weight" class="form-control" value="{{ $review->weight }}">
                        @error('weight')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('weight') }}</p>
                        @enderror
                    </div>
                    <div class="form-group image">
                        <label for="exampleFormControlFile1" class="label-block">Обложка</label>
                        @if ($review->getFile())
                            <a onclick="deleteFile('{{ $review->getFile()->module }}', '{{ $review->getFile()->content_id }}', '{{ $review->getFile()->filename }}');" id="{{ $review->getFile()->module }}{{ $review->getFile()->content_id }}" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
                                <span class="close-img-button"><img src="/images/close.png"></span>
                                <img src="{{ ImgHelper::getPath($review->getFile()->module, 'thumb', $review->getFile()->content_id, $review->getFile()->filename) }}">
                            </a>
                        @else
                            <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        @endif
                        @error('image')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('image') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1" {{ $review->status ? 'checked="checked"' : '' }}>
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
