@extends('layouts/master')

@section('title', 'Категория' . $category->name)

@section('content')

    <h1>
        {{ $category->name }}
    </h1>
    <p>
        {{ $category->description }}
    </p>
    <div class="row">
        @foreach ($category->products->map->skus->flatten() as $sku)
            @include('layouts/card', compact('sku'))
        @endforeach
    </div>

@endsection
