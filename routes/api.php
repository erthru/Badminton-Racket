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


// brand routes
Route::get("/brand", "BrandController@all");
Route::get("/brand/{id}", "BrandController@show");
Route::get("/brand/by/name", "BrandController@all_by_name");
Route::get("/brand/search/query", "BrandController@search");
Route::post("/brand", "BrandController@store");
Route::put("/brand/{id}", "BrandController@update");
Route::delete("/brand/{id}", "BrandController@delete");

// racket routes
Route::get("/racket", "RacketController@all");
Route::get("/racket/{id}", "RacketController@show");
Route::get("/racket/search/query", "RacketController@search");
Route::post("/racket", "RacketController@store");
Route::post("/racket/image/{id}", "RacketController@update_image");
Route::put("/racket/{id}", "RacketController@update");
Route::delete("/racket/{id}", "RacketController@delete");