<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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
// Route::get('/admin', [AdminController::class, 'index']);
// Route::post('/admin', [AdminController::class, 'create']);
// Route::put('/admin', [AdminController::class, 'update']);
// Route::get('/admin/{id}', [AdminController::class, 'getSingleAdmin']);
// Route::get('/all-admin/{id}', [AdminController::class, 'getAllAdmin']);
// Route::delete('/admin/{id}', [AdminController::class, 'delete']);

Route::get('/category',[CategoryController::class, 'index']);
Route::post('/create-category',[CategoryController::class, 'create']);
Route::get('/all-category',[CategoryController::class, 'category']);
Route::get('/category/{id}',[CategoryController::class, 'getSingleCategory']);
Route::put('/category/{id}',[CategoryController::class, 'update']);
Route::delete('/category/{id}',[CategoryController::class, 'delete']);


Route::get('/product',[ProductController::class, 'index']);
Route::post('/create-product',[ProductController::class, 'create']);
Route::put('/update-product/{id}',[ProductController::class, 'update']);
Route::get('/single-product/{id}',[ProductController::class, 'getSingleProduct']);
Route::get('/all-product',[ProductController::class, 'getAllProduct']);
Route::delete('/del-product/{id}',[ProductController::class, 'delete']);
Route::get('/topproduct',[ProductController::class, 'topproduct']);

Route::get('/order', [OrderController::class, 'index']);
Route::post('/create-order', [OrderController::class, 'newOrder']);
Route::put('/update-order/{id}', [OrderController::class, 'update']);
Route::get('/single-order/{id}', [OrderController::class, 'getSingleOrder']);
Route::get('/all-order', [OrderController::class, 'getAllOrder']);
Route::get('/toporder', [OrderController::class, 'topOrder']);
Route::get('/countorder', [OrderController::class, 'countOrder']);
Route::get('/orderdashboard', [OrderController::class, 'orderSummary']);
Route::post('/move-user/{id}', [OrderController::class, 'moveUser']);
Route::post('/more-product', [OrderController::class, 'manyProduct']);

Route::get('/user',[UserController::class, 'index']);
Route::post('/create-user',[UserController::class, 'create']);
Route::put('/update-user/{id}',[UserController::class, 'update']);


