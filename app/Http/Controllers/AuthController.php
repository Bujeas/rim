<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use app\Classes\LDAP\LDAP;
use app\RoleUser;
use app\User;

class AuthController extends Controller
{
    public function GET_loginForm()
    {
        return view ('pages.auth.login');
    }

    public function GET_loginUser(Request $request)
    {
        try
        {
            $ad_credentials = array(
                'email'    => Input::get('email'),
                'password' => Input::get('password')
            );

            $credentials = array(
                'email'    => Input::get('email').'@prasarana.com.my',
                'password' => Input::get('password')
            );

            // $position = Input::get('position');
            // $remember = Input::get('remember');
            
            // if(!$remember)
            // {
            //     $status = 'false';
            // }else{
            //     $status = $remember;
            // }

            $status = true;

            if($ad_credentials['email'] == 'ron.admin@prasarana.com.my')
            {
                $user = Sentinel::authenticateAndRemember($ad_credentials);
                if (Auth::attempt($ad_credentials, $status)) 
                {
                    $findById = User::where('email', $ad_credentials['email'])->first();
                    \Session::put('user.id', $findById->id);
                    \Session::put('group.id', '1');
                    return redirect()->route('home');
                }else{
                    $msg = 'Invalid username or password.';
                    return redirect()->route('login')->with('STATUS_FAIL', $msg)->withInput();
                }
            }elseif(preg_match("/\b@\b/i", $ad_credentials['email'], $match)){
                $ldap = LDAP::login($ad_credentials['email'], $ad_credentials['password']);
                if($ldap == 'B')
                {
                    $msg = 'Invalid domain credential.';
                    return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
                }elseif($ldap == 'C'){
                    $msg = 'Connection failed.';
                    return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
                }else{
                    $find_user = Sentinel::findByCredentials($ad_credentials);

                    if(!$find_user)
                    {
                        $user = Sentinel::registerAndActivate([
                            'staff_id'  => randomId(),
                            'email'     => $ad_credentials['email'],
                            'password'  => $ad_credentials['password'],
                        ]);

                        $find_id = User::where('email', $ad_credentials['email'])->first();
                        $id = $user->id;

                        $tblUser = User::find($id);
                        $tblUser->staff_id = randomId();
                        $tblUser->activated = 1;
                        $tblUser->save();
                    }
                }

                if (Auth::attempt($ad_credentials, $status)) 
                {
                    $user = Sentinel::authenticateAndRemember($ad_credentials);
                    $role_admin = Sentinel::findRoleByName('Administrator');
                    $role_user = Sentinel::findRoleByName('EndUser');
                    $group_admin = $this->inGroup($user->id, $role_admin->id);
                    $group_user = $this->inGroup($user->id, $role_user->id);

                    \Session::put('user.id', $user->id);
                    \Session::put('group.id', $role_user->id);

                    if($group_admin == true)
                    {
                        return redirect()->route('home');
                    }else{
                        // echo '<h1>Welcome End User</h1>';
                        return redirect()->route('dashboard');
                    }
                }else{
                    $msg = 'Invalid username or password';
                    return redirect()->route('login')->with('STATUS_FAIL', $msg)->withInput();
                }
            }else{
                if (Auth::attempt($credentials, $status)) 
                {
                    $user = Sentinel::authenticateAndRemember($credentials);
                    $role_admin = Sentinel::findRoleByName('Administrator');
                    $role_user = Sentinel::findRoleByName('EndUser');
                    $group_admin = $this->inGroup($user->id, $role_admin->id);
                    $group_user = $this->inGroup($user->id, $role_user->id);
                    
                    \Session::put('user.id', $user->id);
                    \Session::put('group.id', $role_user->id);
                    
                    if($group_admin == true)
                    {
                        return redirect()->route('home');
                    }elseif ($group_user == true){
                        // echo '<h1>Welcome End User</h1>';
                        return redirect()->route('dashboard');
                    }
                }else{
                    $msg = 'Invalid username or password';
                    return redirect()->route('login')->with('STATUS_FAIL', $msg)->withInput();
                }
            }

        }
        catch (\Cartalyst\Sentinel\Checkpoints\ThrottlingException $ex)
        {
            $msg = 'Too many attempt. Please try again after 1 hour.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }
        catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $ex){
            $msg = 'Your account is pending for approval.';
            return redirect()->back()->with('STATUS_WARNING', $msg)->withInput();
        }
        catch (\Illuminate\Database\QueryException $ex){
            $msg = 'Connection refused. Please contact Administrator.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }
        
        /*
        if (Auth::attempt($credentials, $status)) 
        {
            // $user = Sentinel::authenticateAndRemember($credentials);
            $role_admin = Sentinel::findRoleByName('Administrator');
            $group_admin = $this->inGroup($user->id, $role_admin->id);

            if($group_admin == true)
            {
                return redirect()->route('home');
            }else{
                //return to moderator view;
                echo '<h1>Welcome End User</h1>';
            }
        }elseif (Auth::loginUsingId($id, $status)){
            echo 'Sasha';
        }else{
            $msg = 'Invalid username or password';
            return redirect()->route('login')->with('STATUS_FAIL', $msg)->withInput();
        }
        */
    }

    public function inGroup($user_id, $role_id)
    {
        $role = RoleUser::where('user_id', $user_id)->where('role_id', $role_id)->first();
        
        if(!$role)
        {
            return false;
        }else{
            return true;
        }
    }

    public function GET_logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
