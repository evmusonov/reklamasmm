@extends('errors.layout')

@section('content')
    @if ($exception)
        <div class="alert alert-danger">
            {{ $exception->getMessage() }}
        </div>
    @endif
@endsection