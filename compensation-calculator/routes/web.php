<?php

use App\Http\Controllers\CompensationController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'index']);

Route::get('/compensation', [CompensationController::class, 'create']);

Route::post('/compensation/create', [CompensationController::class, 'compensate']);

Route::get('/compensations', [CompensationController::class, 'index']);

Route::get('/product/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+');
// Route::get('/search', function (Request $request) {
//     // dd($request);
//     return response('Hello' . ' ' . $request->name . $request->lastName);
// })->where('id', '[0-9]+');
