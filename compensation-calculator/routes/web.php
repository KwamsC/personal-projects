<?php

use App\Http\Controllers\CompensationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

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

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// All Products
Route::get('/', [ProductController::class, 'index']);

// Store single product
Route::get('/product/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+');

// All Compensations
Route::get('/compensations', [CompensationController::class, 'index'])->middleware('auth');

// Show Form
Route::get('/compensation', [CompensationController::class, 'create'])->middleware('auth');

// Store Create Form
Route::post('/compensations/create', [CompensationController::class, 'compensate'])->middleware('auth');

// Manage compensations
Route::get('/compensations/manage', [CompensationController::class, 'manage'])->middleware('auth');

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
