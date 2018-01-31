<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;


class User extends Authenticatable   
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','address','is_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

        public function favoirites()
    {
        return $this->belongsToMany('App\Favoirite', 'favoirites', 'user_id', 'property_id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'user_role', 'role_id', 'user_id');
     }
      public function hasAnyRole($roles)
    {
        if (is_array($roles)) 
        {
            foreach ($roles as $role) 
            {
                if ($this->hasRole($role))
                {
                    return true;
                }
            }
        } 
        else 
        {
            if ($this->hasRole($roles))
                return true;
        }
        return false;
    }

    private function hasRole($role)
    {

        if ($result=$this->roles()->where('title', $role)->first())
         {
            return true;
         } 
        else
        return false;

    }


  
}
