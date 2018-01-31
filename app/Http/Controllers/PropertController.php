<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;

class PropertController extends Controller
{
    //
    public function index()
    {

    	return property::with('areas','cities','categories','features','users')->get();

     
    }
    public function show($property_id)

    {
          $property=Property::where('id',$property_id)->with('areas','city','categories','features','users')->get();
      
    	//s property::with('cities','categories','features')->get();
      //return $property::with('cities','categories','features')->get();
      return $property;
      
    }
   public function store(Request $request)
   { 
   	 $property=$request->all();
     if(property::create($property))
   	 {
   		 return $property;
   	 }	
       
   		
   }

  public function update(property $property,Request $request)  
  {
  	if($property->update($request->all()))
  	{
  		return $property;
  	}
  }

  public function destroy($id)
  {
     $property=property::find($id);
     $property->delete();
  }


    
}
