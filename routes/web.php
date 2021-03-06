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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('api/v1/user/login', 'UsersController@login'); 
$router->post('api/v1/user/register', 'UsersController@create'); 
$router->get('api/v1/areas/index','AreaController@index');
$router->get('api/v1/calls/index','CallController@index');

$router->group(['prefix' => 'api/v1','middleware' => 'auth'],function($router){


    $router->group(['prefix' => 'user'], function ($router) {
        
        //User Routes
        $router->get('index', 'UsersController@index');
        $router->get('me', 'UsersController@me');
        $router->get('fetchEmail/{user_email}', 'UsersController@fetchEmail');
        $router->post('logout', 'UsersController@logout');
        $router->post('create', 'UsersController@create'); 
    });

   $router->group(['prefix' =>'funders'],function($router){

        $router->post('add-funder','FunderController@addFunder');
        $router->get('index','FunderController@index');
        $router->post('update','FunderController@update');
        $router->post('delete','FunderController@delete');
        $router->get('names','FunderController@getNames');
        $router->get('{id}','FunderController@getFunder');
    });

    $router->group(['prefix' =>'calls'],function($router){

        $router->post('create','CallController@create');
        $router->post('update/{id}','CallController@update');
        $router->post('delete/{id}','CallController@delete');
        $router->get('names','CallController@getNames');
        $router->get('getinfo/{id}','CallController@getCallInfo');
        $router->get('{id}','CallController@getCall');
       
        
    });

    $router->group(['prefix' =>'areas'],function($router){

        $router->post('create','AreaController@create');
        // $router->get('index','AreaController@index');
        $router->post('update','AreaController@update');
        $router->post('delete','AreaController@delete');
    
    });

    $router->group(['prefix' =>'bids'],function($router){

        $router->post('create','BidController@create');
        $router->post('check-user','BidController@checkUserExistance');
        $router->post('award','BidController@awardBid');
        $router->post('cancel','BidController@cancelAward');
        $router->get('fetch-bids/{id}','BidController@fetchBids');
       
    });

});
