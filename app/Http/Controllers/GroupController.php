<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Support\Facades\Route;
use app\Role;
use app\User;

class GroupController extends Controller
{
    public function GET_assignGroup(Request $request)
    {
	    if($request->session()->has('user.id'))
        {
	    	$routes = Route::getRoutes();
	  		// $routes = [];
			// foreach($route_collection as $route) {
			//     $routes[] = $route->uri();
			// }

			$groups = Role::all();

			$permits = array();
			// if(is_array($groups)) {
				foreach ($groups as $group) {
					$findGroup = Sentinel::findRoleById($group->id);
					$permissions = $findGroup->getPermissions();
					$permits[$group->name] = array();
					foreach ($permissions as $key => $permission) {
						$permits[$group->name][] = $key;
					}
				}
			// }

			$params = array('routes' => $routes, 'groups' => $groups, 'permits' => $permits);
			return view('pages.user.group-assign', $params);
		}else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function POST_assignGroup($params)
    {
    	$ex_params = explode('_', $params);
		$group_name = ucfirst($ex_params[0]);
		$route = $ex_params[1];
		$action = $ex_params[2];

		$group = Sentinel::findRoleByName($group_name);
		$permits = $group->permissions;

		if ($action == 'push') {
			$permits[$route] = 1;
			$msg = 'Route `'.$route.'` successfully added to group `'.$group_name.'`';
		} else if($action == 'pop') {
			$permits[$route] = 0;
			$msg = 'Route `'.$route.'` successfully removed from group `'.$group_name.'`';

			foreach ($permits as $key => $value){
			    if ($value == 0) {
			        unset($permits[$key]);
			    }
			}

		} else {
			return redirect()->route('group.assign');
		}

		$group->permissions = $permits;
		if ($group->save()) {
	        return redirect()->route('group.assign')->with('STATUS_OK', $msg);
	    } else {
	        return redirect()->route('group.assign')->with('STATUS_FAIL', $msg);
	    }
    }

    public function GET_listGroup(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
        	$user = User::all();
        	$params = array('user' => $user);

        	return view('pages.user.group-list', $params);
        }else{
        	$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }
}
