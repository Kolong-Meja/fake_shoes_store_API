<?php

use App\Http\Controllers\UserControllerAPI;
use App\Http\Controllers\ProductControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', [UserControllerAPI::class, 'index'])->name('user.index');
Route::post('/user', [UserControllerAPI::class, 'store'])->name('user.store');
Route::get('/user/{id}', [UserControllerAPI::class, 'show'])->name('user.show');
Route::put('/user/edit/{id}', [UserControllerAPI::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserControllerAPI::class, 'destroy'])->name('user.delete');

Route::get('/shoes', [ProductControllerAPI::class, 'index'])->name('shoes.index');
Route::post('/shoes', [ProductControllerAPI::class, 'store'])->name('shoes.store');
Route::get('/shoes/{id}', [ProductControllerAPI::class, 'show'])->name('shoes.show');
Route::put('/shoes/edit/{id}', [ProductControllerAPI::class, 'update'])->name('shoes.update');
Route::delete('/shoes/{id}', [ProductControllerAPI::class, 'destroy'])->name('shoes.delete');


