<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    // public function roles(){
    //     return $this->belongsTo(Role::class,'role','id');
    // }
    public function roles(){
        return $this->belongsToMany(Role::class,'user_roles');
    }
    public function hasRole($role){
        return $this->roles->contains('name',$role);
    }

}
