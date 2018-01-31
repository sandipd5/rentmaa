<?php

namespace App\Http\Controllers;
use App\Property;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;

//use App\Http\Controllers\Input;


class SearchController extends Controller
{
    //
    public function filter(Request $request, Property $property)
    {
    	//$name = Input::get('name');
    	
    	$property = Property::where('name', 'LIKE', '%'.$request->name.'%')->with('features')->get();


     //  $property = Property::where('address', 'LIKE', '%'.$request->address.'%')->with('areas','categories','features')->get();
       //$city_id=City::where('name','LIKE', '%'.$request->name.'%')->pluck('id');
        //$property =property::whereIn('area_id',$city_id)->with('areas','categories','features')->get();
        //$area_id=Area::where('name','LIKE','%'.$request->name.'%')->pluck('id');
         //$property =property::whereIn('area_id',$city_id)->with('areas','categories','features')->get();

        
           return $property;
    	

    }


    	// Search for a property based on their name.
    	

    	// if ($request->has('name')) 
    	// {
     //        $user->like('name',%$request->input('name')%);
     //    }

		
        // Search for a property based on their category.



 

}
