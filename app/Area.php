<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
      protected $fillable =['name'];

      public function cities()
    {
       return $this->hasOne('App\City','id','city_id');
     } 
}
