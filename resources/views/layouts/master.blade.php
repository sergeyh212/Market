<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Market</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
   
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <div class="pb-5">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">

            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="navbar-brand nav-link" href="{{ route('index') }}">Market</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Все
                                товары</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                href="{{ route('categories') }}">Категории</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                @foreach ($categories as $category)
                                    <li><a class="dropdown-item"
                                            href="{{ route('category', $category->code) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('basket') }}">В корзину</a>
                        </li>
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                        @endguest
                        @auth
                            @admin
                                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Панель
                                        администратора</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ route('person.orders.index') }}">Мои
                                        заказы</a>
                                </li>
                            @endadmin

                            <li class="nav-item"><a class="nav-link" href="{{ route('get-logout') }}">Выйти</a>
                            </li>
                        @endauth
                    </ul>
                    <form class="d-flex" method="GET" action="{{ route('search') }}">
                        <input class="form-control me-2" name="search" type="search" placeholder="Поиск"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Найти</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="pt-5">
        <div class="container">
            <div class="text-center">
                @if (session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @endif
                @if (session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <div class="container ">
        <footer class="row row-cols-4 py-5 my-2  border-top  panel">
            <div class="col   ">
                <h5>Категория товары</h5>

                <ul class="nav flex-column">
                    @foreach ($categories as $category)
                        <li class="nav-item mb-2">
                            <a href="{{ route('category', $category->code) }}"
                                class="nav-link p-0 text-muted">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <h5>Самые популярные товары</h5>

                <ul class="nav flex-column">
                    @foreach ($bestSkus as $bestSku)
                        <li class="nav-item mb-2">
                            <a href="{{ route('sku', [$bestSku->product->category->code, $bestSku->product->code, $bestSku]) }}"
                                class="nav-link p-0 text-muted">{{ $bestSku->product->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col">
                <h5>Наши контакты</h5>

                <ul class="nav flex-column">

                    <li class="nav-item mb-2">
                        <a href="https://vk.com/v_i_t_g_t_k" class="nav-link p-0 text-muted">ВК</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="https://vitgtk.belstu.by/" class="nav-link p-0 text-muted">Сайт</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="mailto:vitgtk@belstu.by" class="nav-link p-0 text-muted">Электронная почта</a>
                    </li>
                </ul>
            </div>
            <h2 class="text-center">© 2022 ВитГТК</h2>
        </footer>
    </div>



</body>

</html>
