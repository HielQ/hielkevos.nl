<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/





//Route::get('upload' , ['middleware' => 'auth' , 'uses' => 'FileController@index']);







Route::group(['middleware' => ['web' , 'locale']], function () {
    route::get('language/{locale}' , 'SessionController@saveLocale');
    /**
     * Image viewing
     */

    Route::group(['prefix' => 's'] , function() {
        Route::get('list' , ['middleware' => 'auth' , 'uses' => 'FileController@imagelist']);
        Route::get('overview' , ['middleware' => 'auth' , 'uses' =>'FileController@imageoverview']);
        Route::get('{image_name}' , 'ImageController@showImage');
        Route::get('{image_name}/full' , 'ImageController@showFullImage');

    });

    /**
     *File and image uploading
     */

    Route::group(['[prefix' => 'u'] , function() {
        Route::post('image' , 'FIleController@saveImage');
        Route::post('file' , 'FileController@saveFile');
    });

    /**
     * file and image uploading
     */

    Route::group(['prefix' => 'f'] , function () {
        Route::get('list' , ['middleware' => 'auth' , 'uses' => 'FileController@filelist']);
        Route::get('{version}/{name}' , 'FileCOntroller@serve');
    });

    Route::get('/' , 'HomeController@index');
//Route::get('/about' , 'HomeController@about');
    Route::get('/music' , 'HomeController@music');
//Route::get('/games' , 'HomeController@games');
    Route::get('/projects' , 'HomeController@projects');
    Route::get('/licenses' , 'HomeController@licenses');
    Route::get('/clock' , 'HomeController@clock');
    Route::match(['GET' , 'POST'] , '/login' , 'UserController@login');
    Route::get('logout' , ['middleware' => 'auth' , 'uses' => 'UserController@logout']);
//Route::get('/contact' , 'HomeController@contact');

});
