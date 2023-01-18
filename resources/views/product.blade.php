@extends('layouts/master')

@section('title', 'Продукты')

@section('content')

    <h1>{{ $skus->product->name }}</h1>
    <p>Цена: <b>{{ $skus->price }} руб.</b></p>
    <img src="{{ Storage::url($skus->product->image) }}">
    <h2>Описание:</h2>
    <p>{{ $skus->product->description }}</p>
    <h2>Характеристики:</h2>
    @isset($skus->product->properties)
        @foreach ($skus->propertyOptions as $propertyOption)
            <h4>{{ $propertyOption->property->name }}: {{ $propertyOption->name }}</h4>
        @endforeach
    @endisset
    @if ($skus->isAvailable())
        <form action="{{ route('basket-add', $skus) }}" method="post">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
            @csrf
        </form>
    @else
        <span>Нет в наличии</span>
        <br>
        <span>Сообщить о появлении товара в магазине</span>

        <div class="warning">
            @error('email')
                {{ $message }}
            @enderror
        </div>
        <form method="post" action="{{ route('subscription', $skus) }}">
            @csrf
            <input type="text" name="email">
            <button type="submit">Отправить</button>

        </form>
    @endif

@endsection
