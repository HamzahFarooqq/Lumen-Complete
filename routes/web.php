<?php




/** @var \Laravel\Lumen\Routing\Router $router */

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
    return ['lumen' => 'demo'];
});




// user section 

// $router->post('register', 'UserController@register');

// $router->post('login', 'UserController@login');

// $router->put('users/{user}', 'UserController@update');

// $router->delete('users/{user}', 'UserController@delete');




// // article section 

// $router->group(['middleware' => 'auth'], function() use($router) {

//     $router->get('articles', 'ArticleController@list');
//     $router->post('article/save', 'ArticleController@save');

// });




// country routes 

// $router->get('country/index', ['as'=>'index', 'uses'=>'CountryController@index']);

// $router->get('country/list', ['as' => 'list' , 'uses'=>'CountryController@list']);

// $router->get('country/show/{id}', 'CountryController@show');

// $router->post('country/create', 'CountryController@create');

// $router->put('country/edit/{id}', 'CountryController@edit');

// $router->delete('country/delete/{id}', 'CountryController@delete');




// jwt routes 

$router->post('register', 'UserController@register');
$router->post('login', 'UserController@login');

$router->group(['middleware' => 'auth'], function() use($router) {

    $router->post('logout', 'UserController@logout');
    $router->post('refresh', 'UserController@refresh');
    $router->post('me', 'UserController@me');

    $router->post('article/save', 'ArticleController@save');
    $router->get('country/list', ['as' => 'list' , 'uses'=>'CountryController@list']);

});




