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
	//Route::group(['middleware' => ['roles:Super Admin', 'jwt.auth']], function () {
		//users
		 Route::post('/users/assign-role', 'RegistrationController@assignRoleToUser');
    //});		 
 

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
//Group for Admin
Route::group(['middleware' => ['roles:admin,super admin', 'jwt.auth']], function () {

//categories
route::get('categories','CategoryController@index');
route::get('category/{category}','CategoryController@show');
route::post('category','CategoryController@add');
route::put('category/{category}','CategoryController@update');
route::delete('category/{category}','CategoryController@destroy');
});

//roles for user
Route::group(['middleware' => ['roles:admin,user', 'jwt.auth']], function () {

  //properties
Route::get('properties', 'PropertController@index');
Route::get('property/{property_id}','PropertController@show');
Route::post('property','PropertController@store');
route::put('property/{property_id}','PropertController@update');
Route::delete('property/{property_id}','PropertController@destroy');


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

  //Image Upload API
  Route::post('/images/upload', 'ImageController@upload');
    Route::post('/images-property', 'ImageController@addImagesToProperty');
    Route::delete('/images-property/{image}', 'ImageController@deletePropertyImage');

  });

  
  
    Route::group(['middleware' => ['roles:guest,user', 'jwt.auth']], function () {
    //search

   route::post('search','SearchController@filter');

  //Favourite
   Route::get('/favoirites', 'FavoiriteController@getAllFavoirites');
  
    Route::post('/favoirites', 'FavoiriteController@createFavoirite');
    
    Route::get('/user/{user}/favoirites', 'FavoiriteController@getUserFavoirites');
    Route::delete('/property/{property_id}/users/{user_id}', 'FavoiriteController@delete'); //removing from favourite list


   });



