<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
                       'name','category_id','user_id','rent','shared','viewed','favourited','featured','accepted','area_id','address','gpslat','gpslng','country','zipcode','energy','bathrooms','bedrooms','livingrooms','squaremeter','description','tags','features','status','ownername','telephone','yearbuilt'];

  	public function categories(){
       return $this->hasOne('App\Category','id','category_id');
     } 
    public function users()
      {
        return $this->hasOne('App\User','id','user_id');
      }
   	public function features(){
     	return $this->belongsToMany(Feature::class, 'properties_features', 'property_id', 'feature_id');
    }
     public function images()
    {
        return $this->hasMany('App\Image', 'image_id', 'id');
    }

    public function areas(){
       return $this->hasOne('App\Area','id','area_id');
     }

     public function cities(){
      return $this->hasOne('App\City','id','city_id');
     }  
    

 }

