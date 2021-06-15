<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin', [AdminController::class, 'create']);
Route::put('/admin/{id}', [AdminController::class, 'update']);
Route::get('/admin/{id}', [AdminController::class, 'getSingleAdmin']);
Route::get('/all-admin', [AdminController::class, 'getAllAdmin']);
Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
