<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
                       'name', 'email','images','category_id','rent','shared','viewed','favourited','featured','accepted','address','gpslat','gpslng','country','city','zipcode','area','energy','bathrooms','bedrooms','livingrooms','squaremeter','description','features','status','ownername','telephone','yearbuilt'];

  	public function categories(){
       return $this->hasOne('App\Category','id','category_id');
     } 

   	public function features(){
     	return $this->belongsToMany(Feature::class, 'properties_features', 'property_id', 'feature_id');
    }

    public function cities(){
       return $this->hasOne('App\City','id','city_id');
    } 

 }

