@extends('auth.layouts.master')

@isset($sku)
    @section('title', 'Редактировать тов. преложение ' . $sku->name)
@else
@section('title', 'Создать тов. преложение')
@endisset

@section('content')

<div class="col-md-12">
    @isset($sku)
        <h1>Редактировать тов. преложение: <b>{{ $sku->name }}</b></h1>
    @else
        <h1>Добавить тов. преложение</h1>
    @endisset

    <form method="POST" enctype="multipart/form-data"
        @isset($sku)
             action="{{ route('skus.update', [$product, $sku]) }}"
             @else
             action="{{ route('skus.store', $product) }}"
            @endisset>
        <div>
            @isset($sku)
                @method('PUT')
            @endisset
            @csrf
            <div class="form-group row">
                <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                <div class="col-sm-3">

                    <input type="text" class="form-control" name="price"
                        value="@isset($sku){{ $sku->price }}@endisset">
                    @include('auth.layouts.error', ['fieldName' => 'price'])
                </div>
            </div>
            <div class="form-group row">
                <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="count"
                        value="@isset($sku){{ $sku->count }}@endisset">
                    @include('auth.layouts.error', ['fieldName' => 'count'])

                </div>

            </div>
            @foreach ($product->properties as $property)
                <div class="form-group row">
                    <label for="property_id[{{ $property->id }}]"
                        class="col-sm-2 col-form-label">{{ $property->name }}</label>
                    <div class="col-sm-6">
                        <select name="property_id[{{ $property->id }}]" class="form-control">
                            @foreach ($property->propertyOptions as $propertyOption)
                                <option value="{{ $propertyOption->id }}"
                                    @isset($sku)
                                    @if ($sku->propertyOptions->contains($propertyOption->id))
                                            selected
                                        @endif
                                @endisset>
                                    {{ $propertyOption->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach
            <button class="btn btn-success">Сохранить</button>
        </div>
    </form>
</div>
@endsection
