<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GiftController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/accueil/login', [UserController::class, 'index'])->name('login');
Route::post('/accueil/user-login', [UserController::class, 'userLogin'])->name('userLogin');
Route::get('/accueil/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/accueil/user-registration', [UserController::class, 'userRegistration'])->name('userRegistration');
Route::get('/accueil/user-signout', [UserController::class, 'signout'])->name('signout');


Route::resource('/accueil', GroupController::class)->middleware('auth')->only('index');

Route::resource('/accueil/gifts', GiftController::class)->middleware('auth')->except('show');