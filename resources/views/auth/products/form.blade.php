@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@else
@section('title', 'Создать товар')
@endisset

@section('content')
<div class="col-md-12">
    @isset($product)
        <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
    @else
        <h1>Добавить товар</h1>
    @endisset
    <form method="POST" enctype="multipart/form-data"
        @isset($product)
              action="{{ route('products.update', $product) }}"
              @else
              action="{{ route('products.store') }}"
            @endisset>
        <div>
            @isset($product)
                @method('PUT')
            @endisset
            @csrf
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">Код: </label>
                <div class="col-sm-6">
                    @include('auth.layouts.error', ['fieldName' => 'code'])
                    <input type="text" class="form-control" name="code" id="code"
                        value="{{ old('code', isset($product) ? $product->code : null) }}">
                </div>

            </div>
            <br>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Название: </label>
                <div class="col-sm-6">
                    @include('auth.layouts.error', ['fieldName' => 'name'])
                    <input type="text" class="form-control" name="name" id="name"
                        value="{{ old('name', isset($product) ? $product->name : null) }}">
                </div>

            </div>
            <br>
            <div class="form-group row">
                <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                <div class="col-sm-6">
                    <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @isset($product)
                                     @if ($product->category_id === $category->id)
                                        selected
                                     @endif
                                @endisset>
                                {{ $category->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <br>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                <div class="col-sm-6">
                    @include('auth.layouts.error', ['fieldName' => 'description'])
                    <textarea name="description" id="description" cols="72" rows="7">{{ old('description', isset($product) ? $product->description : null) }}</textarea>
                </div>
            </div>
            <br>
            <div class="group row">
                <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                <div class="col-sm-10">
                    <label class="btn btn-default btn-file">
                        Загрузить <input type="file" style="display: none;" name="image" id="image">
                    </label>
                </div>
            </div>
            <br>

            <br>

            <br>



            <div class="form-group row">
                <label for="property_id" class="col-sm-2 col-form-label">Свойство товара: </label>
                <div class="col-sm-6">
                    <select name="property_id[]" class="form-control" multiple>
                        @foreach ($properties as $property)
                            <option value="{{ $property->id }}"
                                @isset($product)
                                     @if ($product->properties->contains($property->id))
                                        selected
                                     @endif
                                @endisset>
                                {{ $property->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <br>
            @foreach (['hit' => 'Хит', 'new' => 'Новинки', 'recommend' => 'Рекомендуемые'] as $field => $title)
                <div class="group row">
                    <label for="code" class="col-sm-2 col-form-label">{{ $title }} </label>
                    <div class="col-sm-1">
                        <input type="checkbox" class="form-control" name="{{ $field }}"
                            id="{{ $field }}" @if (isset($product) && $product->$field === 1) checked="'checked'" @endif>
                    </div>

                </div>
            @endforeach
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@endsection
