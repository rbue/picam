<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Special routing for the motion recordings (first, cause it's a specific one)
Route::get('/vids/{fn}', function($fn)
{
  $p = storage_path().'/app/vids/'.$fn;

  // temporary adjust the memory allocation val
  ini_set('memory_limit', '250M');

  $file = File::get($p);
  return Response::make($file, 200, array('Content-Type' => mime_content_type($p)));
});

// Route Pages
Route::get('/', 'PageController@getHome');
Route::get('/dashboard', 'CamController@index');
Route::get('/streams', 'StreamController@index');

// Route Controllers
Route::controller('/dashboard', 'CamController');
Route::controller('/streams', 'StreamController');
Route::controller('/', 'PageController');
