<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


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

// Redirects to /home
Route::get('/', [UserController::class, 'index']);

// Filter home page with filter tags of images
Route::get('/home/{tag?}', [PostController::class, 'getAll']);

// Show search page of filtered users
Route::get('/profile/search/{profile?}', [UserController::class, 'userSearch']);

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

// Show logged in user their posting page
Route::get('/postpage/{username?}', [UserController::class, 'postpage']);

// Store post in database
Route::post('/userpage/post', [PostController::class, 'store']);

// Delete post
Route::post('/post/delete/{id}', [PostController::class, 'delete']);

// Show Settings page
Route::get('/settings', [UserController::class, 'settings']);

// Show Settings page
Route::get('/password', [UserController::class, 'password']);

// Update Settings
Route::put('/settings/updating/{userid}', [UserController::class, 'update']);

// Update Password
Route::put('/settings/password/{userid}', [UserController::class, 'updatePassword']);

// Show a specific post
Route::get('/userpost/{username}/post/{postid}', [PostController::class, 'show']);

// Show report page
Route::get('/report/{reported}', [ReportController::class, 'index']);

// Store a report
Route::post('/report/reported', [ReportController::class, 'store']);

// Show view of a reported user
Route::post('/reported/{name}', [ReportController::class, 'show']);

// Show admin page
Route::get('/admin', [ReportController::class, 'showView']);

// Return page with reported users
Route::get('/admin/getReports', [ReportController::class, 'getAllReported']);

// Suspend a user
Route::post('/admin/suspend/{name}', [UserController::class, 'suspend']);

// Unsuspend a user
Route::post('/admin/unsuspend/{name}', [UserController::class, 'unsuspend']);

// Dismiss a reported/banned user
Route::post('/admin/dismiss/{name}', [ReportController::class, 'dismiss']);

// Return all suspended/banned user
Route::get('/admin/getBanned', [ReportController::class, 'getAllBanned']);

// Show logged in user and their user page
Route::get('/profile/{username}', [PostController::class, 'index']);

// Show Comments
Route::post('/comment/show/posts/{post}', [CommentController::class, 'show']);

// Save Comment
Route::post('/comment/add', [CommentController::class, 'store']);

// Delete Comment
Route::post('/comment/delete/{id}', [CommentController::class, 'delete']);