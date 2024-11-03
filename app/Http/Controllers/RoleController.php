<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Roles_Permissions;
use Illuminate\Http\Request;
use Auth;


class RoleController extends Controller
{
    public function roleindex(){
      
        $roles = Role::with('permissions')->get();
        return view('admin.roles',compact('roles'));
    }
    public function addRole(){
        $permissions = Permission::all();
        return view('admin.addRole',compact('permissions'));
    }
    public function addNewRole(Request $req){

       
        $roles = new Role();
        $roles->name=$req->name;
        $roles->desc="description";
        $roles->save();
        // $roleID = $roles->id;
        // $permissions = $req->permissions;

       
        // foreach($permissions as $key => $per){
        //     $roles_permissions = new Roles_Permissions();
        //     $roles_permissions->permission_id =$per;
        //     $roles_permissions->role_id =$roleID;
        //     $roles_permissions->save();


        // }
        return redirect('/roles-management-system');
       
    }

    public function editRole($id){
        $role = Role::with('permissions')->find($id);
        $permissions = Permission::all();
        return view('admin.editRole',compact('permissions','role'));
    }
    public function updateRole(Request $req,$id){
   
      $roles = Role::find($id);
      $roles->name=$req->name;
      $roles->desc="description";
      $roles->update();
      $roleID = $roles->id;
      $permissions = $req->permissions;

        Roles_Permissions::where('role_id', $roleID)->delete();
        // $admin_role->permissions()->deattach($permission->id);
        
      if($permissions != null){
        foreach($permissions as $key => $per){
          $permission = Permission::find($per);
         
          $admin_role = Role::where('id',$roleID)->first();
          $admin_role->permissions()->attach($permission->id);
        
       }
      }
            
        
      
      //code for attaching roles
      
    //   $Auth = Admin::whereName('urmila')->with('roles.permissions')->first();
    //   $admin_role = Role::whereName('admin')->with('permissions')->first();

    //    $Auth->roles()->attach($admin_role);

    // if($Auth->hasRole('admin')){
    //   dd("yes");
    // }
    // dd($Auth);

    //$setting

    // $settings =Permission::whereName('settings')->first();
    // $admin_role->permissions()->attach($settings);

    // dd($Auth->toArray());
    
    
    //   foreach($permissions as $key => $per){
    //       $roles_permissions = new Roles_Permissions();
    //       $roles_permissions->permission_id =$per;
    //       $roles_permissions->role_id =$roleID;
    //       $roles_permissions->save();
    //   }
      // toastr()->success('Mail Created Sucessfully');
      \Jeybin\Toastr\Toastr::success('Role Updated Successfully')->toast();
      return redirect('/roles-management-system');
    }
}
