<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Job;

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
// All jobs
Route::get('/', [JobController::class, 'index']);

// Single job
Route::get('/job/details/{Job}', [JobController::class, 'job']);

// show create form
Route::get('/job/create', [JobController::class, 'create'])->middleware('auth');

// store jobs
Route::post('/job', [JobController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/job/{job}/edit', [JobController::class, 'edit'])->middleware('auth');

// handle submit to update
Route::put('/job/{job}', [JobController::class, 'update'])->middleware('auth');

// handle delete
Route::delete('/job/{job}', [JobController::class, 'destroy'])->middleware('auth');

// Manage Jobs
Route::get('/job/manage', [JobController::class, 'manage'])->middleware('auth');

// show register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create new user
Route::post('/users', [UserController::class, 'store']);

// logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);