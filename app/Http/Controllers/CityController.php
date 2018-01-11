<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
    //
    public function index()
    {
        return City::all();  
    }
    public function show(City $city)
    {
           return $city;
    } 
     public function add(Request $request)
    {
        $city=$request->all();  
        if(City::create($city))
         {
         	return $city;   
         }	
   }

    public function update(City $city ,Request $request)
    {
    	if($city->update($request->all()))
    	{
    		return $city;
    	}



    }
    public function destroy($id)
    {
           $city=City::find($id);
          if($city->delete())
          {
          	    return "success";
          }
           
    }


}
