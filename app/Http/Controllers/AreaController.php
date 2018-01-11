<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
class AreaController extends Controller
{
    //

    public function index()
    {
        return Area::with('cities')->get();  
    }
    public function show(Area $area)
    {
           return $area;
    } 
     public function add(Request $request)
    {
        $area=$request->all();  
        if(Area::create($area))
         {
         	return $area;   
         }	
   }

    public function update(Area $area ,Request $request)
    {
    	if($area->update($request->all()))
    	{
    		return $area;
    	}



    }
    public function destroy($id)
    {
           $area=Area::find($id);
          if($area->delete())
          {
          	    return "success";
          }
           
    }

}   

