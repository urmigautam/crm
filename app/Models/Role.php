<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table='roles';

    protected $guarded=[];
     
    public function users(){
        return $this->belongsToMany(Admin::class,'user_roles');
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }

    // public function hasPermission($permission){
    //      return $this->permissions->contains('name',$permission);
    // }

    public function hasPermission($permissionName)
    {
        // Logic to check if the role has the given permission
        // Example logic:
        return $this->permissions()->where('name', $permissionName)->exists();
    }
    public function hasPermissionurl($permissionName)
    {
        return $this->permissions()->where('url', $permissionName)->exists();
    }

    // public function permissions()
    // {
    //     return $this->belongsToMany(Permission::class);
    // }

}
