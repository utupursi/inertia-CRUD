<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/about', function () {
    $messages = \App\Models\Message::all();
    return view('about', ['messages' => $messages]);
});

//laravel  inertia

Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');

Route::get('/contact', function () {
    return inertia('Contact');
})->name('contact');

Route::post('/save-data', [\App\Http\Controllers\UserController::class, 'store']);

Route::get('/getUser',[\App\Http\Controllers\UserController::class,'getUserById']);

Route::post('/update-user',[\App\Http\Controllers\UserController::class,'update']);
Route::delete('/delete-user/{id}',[\App\Http\Controllers\UserController::class,'delete']);

