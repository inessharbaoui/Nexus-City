<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\PublicTransportController;
use App\Http\Controllers\EnergyController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WeatherController;

Route::get('/create-role-and-permission', [AdminController::class, 'createRoleAndPermission']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->middleware('redirect.register')->name('profile');

Route::get('/traffic/analytics', [TrafficController::class, 'showAnalytics'])->middleware('redirect.register')->name('traffic.analytics');

Route::get('/public-transport/locations', [PublicTransportController::class, 'showLocations'])->middleware('redirect.register')->name('public-transport.locations');
Route::get('/public-transport/location/{locationName}', [PublicTransportController::class, 'showLocationDetails'])->middleware('redirect.register')->name('public-transport.location-details');

Route::get('/energy', [EnergyController::class, 'index'])->middleware('redirect.register')->name('energy.index');
Route::get('/energy/usage/{id}', [EnergyController::class, 'show'])->middleware('redirect.register')->name('usage.show');

Route::get('/weather', [WeatherController::class, 'index'])->middleware('redirect.register')->name('weather.index');
