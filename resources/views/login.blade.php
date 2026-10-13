{{-- подключение шаблона --}}
@extends('layout')
@section('content')
    <h1 class="text-center">Вход в аккаунт</h1>
    <form action="{{ route('auth') }}" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Логин*</label>
            <input type="text" class="form-control" id="login" name="login" data-testid="login-login" required>
        </div>
        {{-- вывод ошибки валидации для поля логин --}}
        @error('login')
            <div class="alert alert-danger">
                Нет такого юзера
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Пароль*</label>
            <input type="password" class="form-control" id="password" name="password" data-testid="login-password" required>
        </div>
        <button type="submit" class="btn btn-primary d-block mx-auto" data-testid="login-submit">Войти</button>
        <a href="{{ route('register') }}" class=" d-block text-center">Еще не зарегистрированы? Регистрация</a>
    </form>
@endsection
