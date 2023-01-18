<h2>Hi, Mr. {{ $name }}</h2>

<p>@lang('mail/order_created.your_order'): {{ $fullSum }} has been created</p>

<table>
    <tbody>
        @foreach ($order->skus as $sku)
            <tr>
                <td>
                    <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
                        <img height="56px" src="{{ Storage::url($sku->product->image) }}">
                        {{ $sku->product->name }}
                    </a>
                </td>
                <td><span class="badge">{{ $sku->countInOrder }}</span>
                    <div class="btn-group form-inline">
                    </div>
                </td>
                <td>{{ $sku->price }}</td>
                <td>{{ $sku->getPriceForCount() }} </td>
            </tr>
        @endforeach
    </tbody>
</table>
