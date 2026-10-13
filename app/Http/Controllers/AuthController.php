<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    // отображение страницы регистрации
    public function register()
    {
        return view('register');
    }

    // сохранение пользователя
    public function store(Request $request)
    {
        // валидация
        $validated = $request->validate([
            'login' => 'required|min:6|max:255|unique:users|regex:/^[A-Za-z0-9]+$/',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|size:15|unique:users|regex:/^8\(\d{3}\)\d{3}-\d{2}-\d{2}$/',
            'password' => 'required|min:8',
            'full_name' => 'required|regex:/^[А-Яа-яЁё\s]+$/u'
        ]);

        // создание пользователя, с использованием всего реквеста, но добавляя хеширование пароля
        User::create($request->all() + ['password' => bcrypt($request->password)]);
        return redirect()->route('login');
    }

    // отображение страницы входа
    public function login()
    {
        return view('login');
    }

    // выполнение входа в аккаунт
    public function authenticate(Request $request)
    {
        // валидация
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);

        // попытка аутентификации
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // если админ, переадресовываем на админку
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.index');
            } else { // иначе переадресовываем на страницу заявок
                return redirect()->route('applications.index');
            }
        }

        // если нет пользователя с таким емейлом или паролем, возвращаем обратно и выводим ошибку
        return back()->withErrors([
            'login' => 'Такого пользователя не существует',
        ])->onlyInput('login');
    }

    // выход из аккаунта
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
