{{-- подключение шаблона --}}
@extends('layout')
@section('content')
    <h1 class="text-center">Регистрация</h1>
    <form action="{{ route('user.store') }}" method="post">
        <div class="mb-3">
            <label for="login" class="form-label">Логин*</label>
            <input type="text" class="form-control" id="login" name="login" data-testid="reg-login" required>
        </div>
        {{-- вывод ошибки валидации для поля логин --}}
        @error('login')
            <div class="alert alert-danger">
                 {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="email" class="form-control" id="email" name="email" data-testid="reg-email" required>
        </div>
        {{-- вывод ошибки валидации для поля email --}}
        @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="phone" class="form-label">Номер телефона*</label>
            <input type="text" class="form-control" id="phone" name="phone" data-testid="reg-phone" required>
        </div>
        {{-- вывод ошибки валидации для поля номер телефона --}}
        @error('phone')
            <div class="alert alert-danger">
                 {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="full_name" class="form-label">ФИО*</label>
            <input type="text" class="form-control" id="full_name" name="full_name" data-testid="reg-fullname" required>
        </div>
        {{-- вывод ошибки валидации для поля ФИО --}}
        @error('full_name')
            <div class="alert alert-danger">
                 {{ $message }}
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Пароль*</label>
            <input type="password" class="form-control" id="password" name="password" data-testid="reg-password" required>
        </div>
        {{-- вывод ошибки валидации для поля пароль --}}
        @error('password')
            <div class="alert alert-danger">
                 {{ $message }}
            </div>
        @enderror
        <button type="submit" class="btn btn-primary mx-auto d-block" data-testid="reg-submit">Зарегистрироваться</button>
        <a href="{{ route('login') }}" class="d-block text-center">Уже есть аккаунт? Вход</a>
    </form>
@endsection
