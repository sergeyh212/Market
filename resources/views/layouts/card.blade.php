<div class="col-sm-6 col-md-4 pt-5 ">
    <div class="thumbnail">
        <div class="labels">

        </div>

        <div class="card" style="width: 18rem;">
            <div class="container-fluid">
                <div class="row">
                    <div class="img-wrap">
                        @if ($sku->product->isNew())
                            <span class="badge bg-success">Новинка</span>
                        @endif
                        <span class="badge bg-warning text-dark">Рекомендуемые</span>
                        @if ($sku->product->isHit())
                            <span class="badge bg-danger">Хит продаж</span>
                        @endif

                    </div>
                </div>
            </div>

            <div class="card-body">
                <img class="card-img-top img-responsive img" src="{{ Storage::url($sku->product->image) }}"
                    alt="img">
                <h2 class="card-title">{{ $sku->product->name }}</h2>
                <h2 class="cart-text">
                    {{-- {{ dump($sku) }} --}}
                    @isset($sku->product->properties)

                        @foreach ($sku->propertyOptions as $propertyOption)
                            <h4>{{ $propertyOption->property->name }}: {{ $propertyOption->name }}</h4>
                        @endforeach
                    @endisset
                </h2>
                <h2 class="cart-text">
                    <p>{{ $sku->price }} руб.</p>
                </h2>
                <div class="card-body">
                    <p>
                    <form action="{{ route('basket-add', $sku) }}" method="post">
                        @if ($sku->isAvailable())
                            <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                        @else
                            Нет в наличии
                        @endif
                        <a href="{{ route('sku', [isset($category) ? $category->code : $sku->product->category->code, $sku->product->code, $sku->id]) }}"
                            class="btn btn-light" role="button">Подробнее</a>
                        @csrf
                    </form>
                    </p>
                </div>
            </div>
        </div>
        {{-- <img src="{{ Storage::url($sku->product->image) }}" alt="">
        <div class="caption">
            <h3>{{ $sku->product->name }}</h3>
            @isset($sku->product->properties)

                @foreach ($sku->propertyOptions as $propertyOption)
                    <h4>{{ $propertyOption->property->name }}: {{ $propertyOption->name }}</h4>
                @endforeach
            @endisset
            <p>{{ $sku->price }} руб.</p>
            <p>
            <form action="{{ route('basket-add', $sku) }}" method="post">
                @if ($sku->isAvailable())
                    <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                    Нет в наличии
                @endif
                <a href="{{ route('sku', [isset($category) ? $category->code : $sku->product->category->code, $sku->product->code, $sku->id]) }}"
                    class="btn btn-default" role="button">Подробнее</a>
                @csrf
            </form>
            </p>
        </div> --}}
    </div>
</div>
