<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Auth;

class UserController extends Controller
{
    public function userlist(){
        $users = Admin::with('roles')->get();
       
        $allcompanies = Company::all();
        return view('users.users',compact('users','allcompanies'));
    }

    public function index(){
        $allcompanies =Company::All();
        $allroles =Role::all();
        return view('users.addUser',compact('allcompanies','allroles'));
    }

    public function create(Request $req){

        
        $user=new Admin();
        if($req->hasfile('image')){
         $file = $req->file('image');
         $filename =time().'.'.$file->getClientOriginalExtension();
         $file->move('uploads/user',$filename);
         $user->profile =$filename;
      }
        $user->name =$req->name;
        $user->email =$req->email;
        $user->alternate_email =$req->altemail;
        $user->password =$req->pwd;
        $user->mobile =$req->contact;
        $user->gender =$req->gendar;
        $user->address=$req->address;
        $user->status =$req->status;
        $user->posting_date =$req->doj;
        $user->company_id =$req->company;
        $user->role =$req->role;
        $user->save();
        //attach role
        $Auth = Admin::whereName($req->name)->with('roles.permissions')->first();
        $admin_role = Role::where('id',$req->role)->with('permissions')->first();
        $user->roles()->attach($admin_role);
       
        \Jeybin\Toastr\Toastr::success('User Created Successfully')->toast();
        return redirect('/users');
    }

    public function userblock($id){
     
        $user=Admin::find((int)$id);

        if($user){
            if($user->status == '2'){
         
                $user->status='1';
                $user->save();
                \Jeybin\Toastr\Toastr::success('User unBlocked Successfully')->toast();
                return redirect('/users');
             }
             if($user->status == '1'){
                $user->status='2';
                $user->save();
                \Jeybin\Toastr\Toastr::success('User Blocked Successfully')->toast();
                return redirect('/users');
             }
            
        }
       
    }

    public function useredit($id){

         $allcompanies =Company::All();
         $allroles =Role::all();
          
        $user = Admin::with('company')->find((int)$id);
       
        return view('users.edituser',compact('user','allcompanies','allroles'));
    }
    public function userupdate(Request $req,$id){
    

        $user = Admin::find((int)$id);
        $user->name =$req->name;
        $user->email =$req->email;
        $user->alternate_email =$req->altemail;
       
        $user->mobile =$req->contact;
        $user->gender =$req->gender;
        $user->address=$req->address;
        $user->status =$req->status == "active" ? "1":"2";
        $user->posting_date =$req->doj;
        $user->company_id =$req->company;
        $user->role =$req->role;
       
        if($req->hasfile('image')){
            $destination = 'uploads/user/'.$user->profile;
          
            if(File::exists($destination)){
               File::delete($destination);
            }
             $file = $req->file('image');
             $filename =time().'.'.$file->getClientOriginalExtension();
             $file->move('uploads/user/',$filename);
             $user->profile=$filename;
        }
        $user->update();
        $users = Admin::find((int)$id);
        $admin_role = Role::where('id', $req->role)->with('permissions')->first();
        $users->roles()->sync([$admin_role->id]); // Syncing the role
        // $users = Admin::find((int)$id);
        // $admin_role = Role::where('id',$req->role)->with('permissions')->first();
      
        
        // $users->roles()->attach($admin_role);
        
       
        \Jeybin\Toastr\Toastr::success('User Updated Successfully')->toast();
        return redirect('/users');

    }
    public function login(){
    $companies = Company::all();
     return view('auth.login',compact('companies'));
    }

    public function loginUser(Request $req){
       $userdata = array(
            'email'      => $req->email,
            'password'      => $req->password,
            'company_id' =>$req->company,
           
        );
        if (Auth::guard('admin')->attempt($userdata)) {
           
          \Jeybin\Toastr\Toastr::success('Login Successfully')->toast();
           return redirect('/dashboard');
         }
         
         return redirect('/');
}

    public function register(){
        $companies = Company::all();
       return view('auth.register',compact('companies'));
      }
      public function registerUser(Request $req){
        
         $admin =new Admin();
         $admin->name = $req->email;
         $admin->password = bcrypt($req->password);
         $admin->company_id = $req->company;
         $admin->status = 1;
         $admin->role = 1;
         $admin->save();
       

         return redirect('/login');

      }

      public function logout(){
        Auth::guard('admin')->logout();
        \Jeybin\Toastr\Toastr::success('Logout Successfully')->toast();
        return redirect('/');
      }

      public function template(){
        
        return view('mail.template',compact('data'));
      }

      public function cities(){
        dd("cities");
      }
}
