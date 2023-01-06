<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

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

Route::post('/registration', 'UserController@create'); // Регистрация пользователя
Route::post('/auth', 'UserController@auth'); // Авторизация пользователя

// Роуты в авторизованной зоне
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/logout', 'UserController@logout'); // Выход пользователя из авторизованного режима
    Route::get('/get', function () { return "Всё good!"; }); // Тест авторизованной зоны
});

Route::get('/category', 'CategoryController@get'); // Получение дерева категорий
Route::get('/products', 'ProductController@get'); // Получение товаров

Route::post('/bascets', 'BascetController@create'); // Добавление товара в корзину
Route::put('/bascets/{bascet_id}', 'BascetController@edit'); // Добавление товара в корзину
Route::delete('/bascets/{bascet_id}', 'BascetController@delete'); // Добавление товара в корзину

Route::post('/orders/create', 'OrderController@create'); // Формирование нового заказа









// Тестовый роут
Route::get('/test', function (Request $request) {
    // return 'Sofia + Chingiz = LOVE';
    // return User::find(2);
    // return session()->getId();
    return $request->cookie('laravel_session');
});