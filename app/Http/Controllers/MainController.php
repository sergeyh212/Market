<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Sku;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use function PHPUnit\Framework\isNull;

class MainController extends Controller
{

    public function index(ProductsFilterRequest $request)
    {
        $skusQuery = Sku::with(['product', 'product.category']);
        if ($request->filled('price_from')) {
            $skusQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $skusQuery->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $skusQuery->whereHas('product', function ($query) use ($field) {
                    $query->$field();
                });
            }
        }

        $skus = $skusQuery->paginate(9)->withPath("?" . $request->getQueryString());

        return view('index', compact('skus'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($code)
    {

        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function sku($categoryCode, $productCode, Sku $skus)
    {
        if ($skus->product->code != $productCode) {
            abort(404, 'Товар не найден');
        }
        if ($skus->product->category->code != $categoryCode) {
            abort(404, 'Категория не найдена');
        }
        $productInfo = Product::where('code', $productCode)->withTrashed()->firstOrFail();
        return view('product', compact('skus'));
    }

    public function subscribe(SubscriptionRequest $request, Sku $skus)
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $skus->id
        ]);
        return redirect()->route('index')->with('success', 'Спасибо за подписку, мы сообщим вам, когда товар появится в магазине!');
    }

    public function changeLocale($locale)
    {
        $availavleLocales = ['ru', 'en'];
        if (!in_array($locale, $availavleLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->route('index');
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }

    public function search(SearchRequest $request, $fil = false)
    {

        $skus = collect([]);
        $name = $request->search;
        $skusQuery = Sku::with(['product', 'product.category']);
        $skusNs = $skusQuery->paginate(100)->withPath("?" . $request->getQueryString());
        $products = Product::where("name", 'LIKE', "%{$request->search}%")->get();

        foreach ($skusNs as $sku) {
            foreach ($products as $product)
                if ($sku->product->id == $product->id)
                    $skus->push($sku);
        }

        $sear = true;
        return view('index', compact('skus', 'sear', 'name'));
    }
}