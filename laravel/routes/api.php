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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * Product routes
 */
//create product
Route::post('/product',[
    'uses'  => 'ProductController@create',
    'as'    => 'product.create'
])->middleware('jwt.auth');
//get list of products
Route::get('/products',[
    'uses'  => 'ProductController@index',
    'as'    => 'product.index'
]);
//update product
Route::put('/product/{id}',[
    'uses'  => 'ProductController@update',
    'as'    => 'product.update'
])->middleware('jwt.auth');
//delete produt from db
Route::delete('/product/{id}',[
    'uses'  => 'ProductController@delete',
    'as'    => 'product.delete'
])->middleware('jwt.auth');
/**
 * user routes
 */
//sign up user
Route::post('/user',[
    'uses'  => 'UserController@signUp'
]);
//sign in user
Route::post('/user/sing_in',[
    'uses'  => 'UserController@signIn'
]);
/**
 * Cart routes
 */
//show all carts
Route::get('/carts',[
    'uses'  => 'CartController@index'
])->middleware('jwt.auth');
//create a new cart by user
Route::post('/cart',[
    'uses'  => 'CartController@create',
    'as'    => 'cart.create'
])->middleware('jwt.auth');
//add product to cart
Route::post('/cart/{cart_id}/product/{product_id}',[
    'uses'  => 'CartController@addProductToCart'
])->middleware('jwt.auth');
//delete product from a cart
Route::delete('/cart/{cart_number}/product/{product_id}',[
    'uses'  => 'CartController@deleteProductFromCart'
])->middleware('jwt.auth');
//delete product from a cart
Route::delete('/cart/{cart_number}',[
    'uses'  => 'CartController@deleteCart'
])->middleware('jwt.auth');
//price product from a cart
Route::post('/cart/{cart_number}',[
    'uses'  => 'CartController@show'
])->middleware('jwt.auth');

