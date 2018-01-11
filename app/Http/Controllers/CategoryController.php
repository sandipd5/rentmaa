<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    //
    public function index()
    {
        return category::all();  
    }
    

    public function show(category $category)
    {
           return $category;
    } 
    public function add(Request $request)
    {
        $category=$request->all();  
        if(category::create($category))
         {
         	return $category;   
         }	
          
    }
    public function update(category $category ,Request $request)
    {
    	if($category->update($request->all()))
    	{
    		return $category;
    	}



    }
    public function destroy($id)
    {
           $category=Category::find($id);
          if($category->delete())
          {
          	    return "success";
          }
           
    }
}
