@extends('layouts/master')

@section('title', 'Главная')

@section('content')
    <form method="GET" action="{{ route('index') }}">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-md-3">
                    <div class="col-sm-3 col-md-3">
                        <label for="price_from">Цена от
                            <input type="text" name="price_from" id="price_from" size="6"
                                value="{{ request()->price_from }}">

                        </label>
                        <label for="price_to">до
                            <input type="text" name="price_to" id="price_to" size="6"
                                value="{{ request()->price_to }}">
                        </label>
                    </div>

                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="hit">
                        <input type="checkbox" name="hit" id="hit"
                            @if (request()->has('hit')) checked @endif>
                        Хит
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="new">
                        <input type="checkbox" name="new" id="new"
                            @if (request()->has('new')) checked @endif>
                        Новинки
                    </label>
                </div>
                <div class="col-sm-2 col-md-2">
                    <label for="recommend">
                        <input type="checkbox" name="recommend" id="recommend"
                            @if (request()->has('recommend')) checked @endif>
                        Рекомендуемые
                    </label>
                </div>
                <div class="col-sm-6 col-md-3">
                    <button type="submit" class="btn btn-primary">Фильтр</button>
                    <a href="{{ route('index') }}" class="btn btn-warning">Сброс</a>
                </div>
            </div>
        </div>
    </form>
    @if (@isset($name) && count($skus) >= 1)
        <div class="text-center">

            <h1>Результат поиска: {{ $name }}</h1>
        </div>
    @elseif (count($skus) >= 1)
        <div class="text-center">

            <h1>Все товары</h1>
        </div>
    @endif

    @if (@isset($skus) && count($skus) < 1)
        <div class="text-center">

            <h1>Ничего не найдено</h1>
        </div>
    @else
    @endif
    <div class="row">
        @foreach ($skus as $sku)
            @include('layouts/card', compact('sku'))
        @endforeach
    </div>
    @isset($sear)
    @else
        <div class="container">
            <div class="pt-5">
                {{ $skus->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endisset
@endsection
