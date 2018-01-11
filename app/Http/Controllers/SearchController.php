<?php

namespace App\Http\Controllers;
use App\Property;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\Input;


class SearchController extends Controller
{
    //
    public function filter(Request $request, Property $property)
    {
    	//$name = Input::get('name');
    	
    	$property = Property::where('name', 'LIKE', '%'.$request->name.'%')->get();
    	return $property;
    	//return $property::with('cities','categories','features')->get();


    }


    	// Search for a property based on their name.
    	

    	// if ($request->has('name')) 
    	// {
     //        $user->like('name',%$request->input('name')%);
     //    }

		
        // Search for a property based on their category.



 

}
