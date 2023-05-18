<?php

use App\Http\Controllers\CAuth;
use App\Http\Controllers\CClient;
use App\Http\Controllers\CProject;
use App\Http\Controllers\CUser;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/laravel', function () {
    return view('welcome');
});

Route::controller(CAuth::class)->group(function () {
    Route::get('/', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
    Route::get('/dashboard', 'dashboard')->name('home')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::resource('/project', CProject::class)->except('destroy', 'edit', 'show', 'create');
    Route::resource('/client', CClient::class)->except('create', 'show', 'edit');
    Route::post('/filter-project', [CProject::class, 'index']);
    Route::post('/delete-data', [CProject::class, 'destroy']);
    Route::get('/user', [CUser::class, 'index']);
    Route::post('/user', [CUser::class, 'store']);
    Route::post('/user/{user}', [CUser::class, 'update']);
    Route::delete('/user/{user}', [CUser::class, 'destroy']);
});
