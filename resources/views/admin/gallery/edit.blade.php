@extends('admin.layout')

@php
use App\Components\ImgHelper;
@endphp

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1 class="h3">Редактирование элемента <a href="/admin/gallery" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/admin/gallery/{{ $image->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input type="text" name="title" class="form-control" value="{{ $image->title }}">
                        @error('title')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Сортировка</label>
                        <input type="text" name="weight" class="form-control" value="{{ $image->weight }}">
                        @error('weight')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('weight') }}</p>
                        @enderror
                    </div>
                    <div class="form-group image">
                        <label for="exampleFormControlFile1" class="label-block">Обложка</label>
                        @if ($image->getFile())
                            <a onclick="deleteFile('{{ $image->getFile()->module }}', '{{ $image->getFile()->content_id }}', '{{ $image->getFile()->filename }}');" id="{{ $image->getFile()->module }}{{ $image->getFile()->content_id }}" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
                                <span class="close-img-button"><img src="/images/close.png"></span>
                                <img src="{{ ImgHelper::getPath($image->getFile()->module, 'thumb', $image->getFile()->content_id, $image->getFile()->filename) }}">
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
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1" {{ $image->status ? 'checked="checked"' : '' }}>
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
