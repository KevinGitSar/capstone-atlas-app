<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;


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
    return view('app');
});

// Route::resource('posts', PostController::class)
//     ->only(['index', 'store'])
//     ->middleware(['auth', 'verified']);

// Show the register an user account page
Route::get('/register', [UserController::class, 'create']);

// Store a user into the database
Route::post('/users', [UserController::class, 'store']);

// Show the login page
Route::get('/login', [UserController::class, 'login']);

// Log in to an account page
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Log user out
Route::post('/logout', [UserController::class, 'logout']);

// require __DIR__.'/auth.php';
