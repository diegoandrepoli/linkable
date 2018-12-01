<?php

/**
 * Default route
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * User create route
 */
Route::post('/users', 'UsersController@add');

/**
 * User delete route
 */
Route::delete('/user/{id}', 'UsersController@delete');
	
/**
 * Create new URL route
 */
Route::post('/users/{userId}/urls', 'UrlsController@add');

/**
 * Get url route
 */
Route::get('/stats/{id}', 'UrlsController@get');

/**
 * Delete URL route
 */
Route::delete('/urls/{id}', 'UrlsController@delete');


/**
 * URL redirect route
 */
Route::get('/urls/{id}', 'RedirectController@redirect');

/**
 * Get system stats
 */
Route::get('/stats', 'UrlsController@stats');

/**
 * Get stats by user
 */
Route::get('/users/{userId}/stats', 'UrlsController@userStats');


