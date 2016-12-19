<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function ($app) {

    /* authentication controller */
    $app->post('login', array('uses' => 'AuthController@login'));

    /*routes for product */
    $app->get('product', 'ProductController@index');
    $app->get('product/featured', 'ProductController@getLatestFeaturedProducts');
    $app->get('product/latest', 'ProductController@getLatestProducts');
    $app->get('product/{id}', 'ProductController@getProduct');
    $app->post('product', 'ProductController@createProduct');
    $app->put('product/{id}', 'ProductController@updateProduct');
    $app->delete('product/{id}', 'ProductController@deleteProduct');


    /* routes for user */
    $app->get('user', 'UserController@index');
    $app->get('user/cart/{id}','UserController@getCart');
    $app->get('user/{id}', 'UserController@getUser');
    $app->post('user', 'UserController@createUser');
    $app->put('user/{id}', 'UserController@updateUser');
    $app->delete('user/{id}', 'UserController@deleteUser');

    /* routes for cart */
    $app->get('cart', 'CartController@index');
    $app->get('cart/{id}', 'CartController@getCart');
    $app->post('cart/remove','CartController@removeCart');
    $app->post('cart', 'CartController@createCart');
    $app->put('cart/{id}', 'CartController@updateCart');
    $app->delete('cart/{id}', 'CartController@deleteCart');

});

$app->get('/example', 'ExampleController@index');

$app->group(['middleware' => 'auth:api'], function ($app) {
    $app->get('/test', function () {

        $user = Auth::user();
        var_dump($user);

        return response()->json([
            'message' => 'Hello World!',
        ]);
    });
});