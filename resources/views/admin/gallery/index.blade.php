@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div>
                <a class="btn btn-primary" href="/admin/gallery/create">Добавить изображение</a>
            </div>
            <div class="list">
                @if (session('deleteSuccess'))
                    <p class="alert alert-success" role="alert">{{ session('deleteSuccess') }}</p>
                @endif
                @if (session('deleteFail'))
                    <p class="alert alert-danger" role="alert">{{ session('deleteFail') }}</p>
                @endif
                @if (session('uploadError'))
                    <p class="alert alert-danger" role="alert">{{ session('uploadError') }}</p>
                @endif
                @if ($gallery)
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Сортировка</th>
                            <th scope="col">Активно</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($gallery as $item)
                                <tr>
                                    <th scope="row">{{ $counter }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->weight }}</td>
                                    <td><span style="color: {{ $item->status ? 'green' : 'grey' }}">{{ $item->status ? 'Активно' : 'Неактивно' }}</span></td>
                                    <td>
                                        <a href="/admin/gallery/{{ $item->id }}/edit"><i class="material-icons">edit</i></a>
                                        <a href="/admin/gallery/{{ $item->id }}/delete" class="delete"><i class="material-icons">delete</i></a>
                                    </td>
                                </tr>
                                @php
                                    $counter++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
