<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
      protected $fillable = ['property_id', 'alt', 'thumbnail', 'url'];
    protected $hidden=['created_at', 'updated_at', 'property_id'];
}
