<?php

use Illuminate\Http\Request;

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

/*BUYERS con filtros*/
Route::resource('buyers', 'Buyer\BuyerController', ['only'=>['index', 'show']]);

/*Category con filtros*/
Route::resource('categories', 'Category\CategoryController', ['except'=>['index', 'show']]);

/*PRODUCTS*/
Route::resource('products', 'Product\ProductController', ['only'=>['index', 'show', 'create', 'edit', 'delete']]);

/*TRANSACTIONS*/
Route::resource('transactions', 'Transaction\TransactionController', ['only'=>['index', 'show', 'create', 'edit', 'delete']]);

/*SELLERS*/
Route::resource('sellers', 'Seller\SellerController', ['only'=>['index', 'show']]);

/*USERS*/
Route::resource('users', 'User\UserController', ['except'=>['index', 'show']]);