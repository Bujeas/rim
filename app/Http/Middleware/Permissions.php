<?php

namespace App\Http\Middleware;

use Closure;
use app\User;
use app\Role;
use Illuminate\Support\Facades\Route;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Session;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('user.id'))
        {
          $user_id = Session::get('user.id');
          $groupid = Session::get('group.id');

          // $user_groups = Role::join('users_groups', 'roles.id', '=', 'users_groups.group_id')->select('roles.id', 'roles.name' , 'roles.permissions', 'users_groups.user_id as pivot_user_id', 'users_groups.group_id as pivot_group_id')->where('users_groups.user_id', $user_id)->first();

          $user_groups = Role::join('role_users', 'roles.id', '=', 'role_users.role_id')->select('roles.id', 'roles.name' , 'roles.permissions', 'role_users.user_id as pivot_user_id', 'role_users.role_id as pivot_group_id')->where('role_users.user_id', $user_id)->first();

          $role = $user_groups->name;
          $permissions_str = $user_groups->permissions;
          $permissions_trm = trim($permissions_str, '{}');
          $permissions_arr = explode(',', $permissions_trm);

          $permissions_list = array();
          foreach($permissions_arr as $val){
            $tmp = explode(':', $val);
            $permissions_list[$tmp[0]] = $tmp[1];
          }

          $permits = array();
          foreach ($user_groups as $group) {
              foreach ($permissions_list as $permission => $val) {
                  if(trim($permission,'" "') == Route::current()->getName()) {
                      $access = Sentinel::findRoleByName($role);
                      $permits[] = $access;
                  }
              }
          }

          if (!array_filter($permits)) {
              // return redirect()->route('login')->with('STATUS_FAIL', 'You do not have access to this page.');
              if($groupid != 3){
                return redirect()->route('home')->with('STATUS_DENIED', 'You do not have access to this page.');
              }else{
                return redirect()->route('dashboard')->with('STATUS_DENIED', 'You do not have access to this page.');
              }
          }else{
              return $next($request);
          }
        }else{
          $msg = 'Your session has expired. Please login again.';
          return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
        
    }
}
