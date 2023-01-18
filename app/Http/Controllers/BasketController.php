<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{

    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $email = Auth::check() ? Auth::user()->email : $request->email;
        if ((new Basket())->saveOrder($request->name, $request->phone, $email)) {
            session()->flash('success', 'Заказ успешно оформлен!');
        } else {
            session()->flash('warning', 'Товар не доступен в полном объеме!');
        }
        return redirect()->route('index');
    }

    public function basketPlace()
    {

        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable()) {
            session()->flash('warning', 'Товар не доступен в полном объеме!');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }


    public function basketAdd(Sku $skus)
    {

        $result = (new Basket(true))->addSku($skus);

        if ($result) {

            session()->flash('success', 'Добавлен товар ' . $skus->product->name);
        } else {
            session()->flash('warning', 'Товар ' . $skus->product->name . ' в большем количестве не доступен!');
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Sku $skus)
    {
        (new Basket())->removeSku($skus);

        session()->flash('warning', 'Удален товар ' . $skus->product->name);

        return redirect()->route('basket');
    }
}