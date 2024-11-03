<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\Permission;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admin')->user() != null){

            $user = Auth::guard('admin')->user();

            if ($user) {
                $roles = $user->roles;
                $path = $request->path();
                $maskedPath = preg_replace('/\d+/', '*', $path);
                $newUrl = str_replace("/*", "", $maskedPath);
                $role_id = $roles[0]->id;
              
                // $Auth = Admin::where('id',$user['id'])->with('roles.permissions')->first();
                $permissions = Permission::all(); 
                $role = Role::find($user->role);
               
                // $permissions = Role::find($user->role);
                $result = $role->hasPermissionurl($newUrl);
              
                if($result == true){
                
                    return $next($request);
                }
                else{
                    return redirect()->back()->with('error', 'Access is not allowed.');
                    // return redirect('/');
                }


            }
            return $next($request);
        }
        return $next($request);
    }
}
