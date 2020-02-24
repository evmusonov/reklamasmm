@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">dehaze</i></span>
            </div>
            <a href="/admin/menu" class="main-page-link">Меню</a>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">border_all</i></span>
            </div>
            <a href="/admin/infoblocks" class="main-page-link">Инфоблоки</a>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">ballot</i></span>
            </div>
            <a href="/admin/services" class="main-page-link">Услуги</a>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">portrait</i></span>
            </div>
            <a href="/admin/reviews" class="main-page-link">Отзывы</a>
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">photo_camera</i></span>
            </div>
            <a href="/admin/gallery" class="main-page-link">Галерея</a>
        </div>
    </div>
@endsection
