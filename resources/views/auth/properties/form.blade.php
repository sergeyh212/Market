@extends('auth.layouts.master')

@isset($property)
    @section('title', 'Редактировать свойства ' . $property->name)
@else
@section('title', 'Создать свойство')
@endisset

@section('content')
<div class="col-md-12">
    @isset($property)
        <h1>Редактировать Свойство: <b>{{ $property->name }}</b></h1>
    @else
        <h1>Добавить Свойство</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
        @isset($property)
             action="{{ route('properties.update', $property) }}"
             @else
             action="{{ route('properties.store') }}"
            @endisset>
        <div>
            @isset($property)
                @method('PUT')
            @endisset
            @csrf

            <br>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ old('name', isset($property) ? $property->name : null) }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <br>
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@endsection
