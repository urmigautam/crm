<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Spatie\Permission\Middlewares\PermissionMiddleware;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
  

    public function index(){
        $allPermissions = Permission::all();
        return view('admin.permissionsList',compact('allPermissions'));
    }

    public function addPermission(){
        return view('admin.addpermission');
    }
    public function storePermission(Request $req){
   
       
    $path = $req->pageurl;
    $maskedPath = preg_replace('/\d+/', '*', $path);
    $newpermission =new Permission();
    $newpermission->name=$req->permission;
    $newpermission->url=$maskedPath;
    $newpermission->save();
    return redirect('/permission');
    }

    public function editPermission($id){
    
     $permission = Permission :: find($id);
     return view('admin.editpermission',compact('permission'));
    }
    public function updatePermission(Request $req,$id){
       $path = $req->pageurl;
       $maskedPath = preg_replace('/\d+/', '*', $path);
       $newUrl = str_replace("/*", "", $maskedPath);
       $permission =Permission:: find($id);
       $permission->name =$req->permission;
       $permission->url =$newUrl;

       $permission->update();
       return redirect('/permission');
    }

    public function delete($id){
       $permission = Permission::find($id);

       if ($permission) {
        $permission->delete();
        return redirect('/permission');
        // return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    // } else {
    //     return redirect()->route('permissions.index')->with('error', 'Permission not found');
    }
    }
}
