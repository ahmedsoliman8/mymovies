<?php

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');


Route::get('/genres', 'GenreController@index');

Route::get('/movies', 'MovieController@index');

Route::get('/movies/{movie}/images', 'MovieController@images');
Route::get('/movies/{movie}/actors', 'MovieController@actors');
Route::get('/movies/{movie}/related_movies', 'MovieController@related_movies');

Route::middleware('auth:sanctum')->group(function () {

    //Movies Route

    Route::get('/movies/toggle_movie', 'MovieController@toggleFavorite');



    //user route
    Route::get('/user', 'AuthController@user');
});