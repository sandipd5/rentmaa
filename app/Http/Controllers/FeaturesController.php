<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feature;

class FeaturesController extends Controller
{
    //
    public function index()
    {
    	return feature::all();
    }

    public function show(feature $feature)
     {
     	return $feature;
     }

     public function store(Request $request)
     {
     	
     	$feature=$request->all();  
        if(feature::create($feature))
         {
         	return $feature;   
         }	
          
     }

   public function update(feature $feature,Request $request)
   {
   	  if($feature->update($request->all()))
   	  {
   	  	return $feature;
   	  }
   }

   public function destroy($id)
    {
    	$feature=Feature::find($id);
    	if($feature->delete())
    	{
    		return "success";
    	}
    }
}
