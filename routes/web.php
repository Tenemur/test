<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (!Auth::user()) {
        return redirect('/login');
    } else if(Auth::user()->is_admin) {
        return redirect()->route('admin.index');
    } else {
        return redirect()->route('applications.index');
    }
});

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/store', [AuthController::class, 'store'])->name('user.store')->middleware('guest');
Route::post('/auth', [AuthController::class, 'authenticate'])->name('auth')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('applications', ApplicationController::class)->middleware('auth');
Route::post('/applications/{application}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::put('/admin/{application}/update', [AdminController::class, 'update'])->name('admin.status')->middleware('auth');
