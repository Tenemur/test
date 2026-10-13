<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- подключение бутстрапа и своего css --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                {{-- картинка - логотип --}}
                <img src="{{ asset('images/logo.png') }}" alt="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        {{-- ссылки перехода для гостей --}}
                        @guest
                            <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Войти</a>
                            <a class="nav-link active" aria-current="page"
                                href="{{ route('register') }}">Зарегистрироваться</a>
                        @endguest
                        {{-- ссылки перехода для пользователей НЕ админов --}}
                        @if (Auth::user() && !Auth::user()->is_admin)
                            <a class="nav-link active" aria-current="page" href="{{ route('applications.index') }}">Мои
                                заявки</a>
                                <a class="nav-link active" aria-current="page" href="{{ route('applications.create') }}">
                                Создать заявку</a>
                        @endif
                        {{-- ссылки перехода для админов --}}
                        @if (Auth::user() && Auth::user()->is_admin)
                            <a class="nav-link active" aria-current="page" href="{{ route('admin.index') }}">Панель
                                администратора</a>
                        @endif
                        {{-- кнопка выхода для пользователей --}}
                        @auth
                            <form action="{{ route('logout') }}" method="post">
                                <button type="submit">Выйти</button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container">
        {{-- сюда вставляется контент каждой страницы при подключении данного шаблона --}}
        @yield('content')
    </main>
    {{-- подключение бутстрап скрипта --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
