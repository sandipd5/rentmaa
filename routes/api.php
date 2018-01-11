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
	//Route::group(array('middleware'=>'role:admin'), function() {
 
//properties
Route::get('properties', 'PropertController@index');
Route::get('property/{property_id}','PropertController@show');
Route::post('property','PropertController@store');
route::put('property/{property_id}','PropertController@update');
Route::delete('property/{property_id}','PropertController@destroy');

//user

route::get('registeredusers', 'RegistrationController@index');
route::get('registereduser/{user}','RegistrationController@show');
route::post('registeruser','RegistrationController@register');
route::put('registereduser/{user}','RegistrationController@update');
route::delete('registereduser/{user}','RegistrationController@destroy');
route::post('userlogin','RegistrationController@login');
route::post('recover','RegistrationController@recover');
 Route::post('logout', 'RegistrationController@logout');
 route::post('refresh','RegistrationController@token');

Route::group(['middleware' => ['jwt.auth','']], function() {
  

    Route::get('test', function(){
        return response()->json(['foo'=>'bar']);
   });

});
//categories
route::get('categories','CategoryController@index');
route::get('category/{category}','CategoryController@show');
route::post('category','CategoryController@add');
route::put('category/{category}','CategoryController@update');
route::delete('category/{category}','CategoryController@destroy');

//features
route::get('features','FeaturesController@index');
route::get('feature/{feature}','FeaturesController@show');
route::post('feature','FeaturesController@store');
route::put('feature/{feature}','FeaturesController@update');
route::delete('feature/{feature}','FeaturesController@destroy');


//area
route::get('areas','AreaController@index');
route::get('area/{area}','AreaController@show');
route::post('area','AreaController@add');
route::put('area/{area}','AreaController@update');
route::delete('area/{area}','AreaController@destroy');

//city

route::get('cities','CityController@index');
route::get('city/{city}','CityController@show');
route::post('city','CityController@add');
route::put('city/{city}','CityController@update');
route::delete('city/{city}','CityController@destroy');

//serach
route::post('search','SearchController@filter');
//});



