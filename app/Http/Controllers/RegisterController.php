<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use app\User;

class RegisterController extends Controller
{
    public function GET_registerForm()
    {
    	return view('pages.form.register');
    }

    public function POST_registerForm()
    {
    	if(!empty(Input::get('agree')))
        {
            $user =  new User;
            $user->first_name   = Input::get('staff_name');
            $user->staff_id     = Input::get('number');
            $user->email        = Input::get('number').'@prasarana.com.my';
            $user->password     = Hash::make(Input::get('password'));
            $user->activated    = '0';
            $user->save();

            $msg = 'Your account successfully created and <br/> <span style="padding-left:15px;">pending for approval.</span>';
            return redirect()->route('login')->with('STATUS_OK', $msg)->withInput();
        }else{
            $msg = 'You must agree with the terms and policy.';
            return redirect()->route('register')->with('STATUS_FAIL', $msg)->withInput();
        }
    }
}
