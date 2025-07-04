<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TrafficController;
use App\Http\Controllers\PublicTransportController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;







Route::get('/create-role-and-permission', [AdminController::class, 'createRoleAndPermission']);


Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);












Route::get('/traffic', [TrafficController::class, 'index'])->name('traffic.index');
Route::get('/public-transport', [PublicTransportController::class, 'index'])->name('public-transport.index');
Route::get('/energy', [EnergyController::class, 'index'])->name('energy.index');
Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
