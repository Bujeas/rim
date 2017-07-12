<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Database\Capsule\Manager as Capsule;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            // return redirect()->intended('dashboard');
            return redirect('/home');
        }

        $email = $request->input('email');
        $password = $request->input('password');

        return redirect('/home');

        // if (Auth::attempt(['email' => $email, 'password' => $password])) {
        //     // Authentication passed...
        //     return redirect()->intended('home');
        // }
        
        // try
        // {
        //     // Login credentials
        //     $credentials = array(
        //         'email'    => $email,
        //         'password' => $password,
        //     );

        //     if ($email == 'ron.admin@prasarana.com.my') {
        //         // $user = Sentry::authenticateAndRemember($credentials, false);
        //         $user = Sentinel::authenticate($credentials);
        //     } else {
        //         // LDAP
        //         $ldap = LDAP::login($credentials['email'], $credentials['password']);
        //         if(!$ldap) {
        //             $msg = 'Invalid domain credential.';
        //             return Redirect::back()->with('STATUS_FAIL', $msg)->withInput();
        //         } else {
        //             $find_user = Sentry::findUserByLogin($credentials['email']);
        //             if($find_user) {
        //                 if(!$find_user->checkPassword($credentials['password'])) {
        //                     $find_user->password = $credentials['password'];
        //                     $find_user->save();
        //                 }
        //                 // Authenticate the user
        //                 $user = Sentry::authenticateAndRemember($credentials, false);
        //             }
        //         }
        //     }
            
        // } catch (Cartalyst\Sentinel\Checkpoints\ThrottlingException $ex) {
        //     echo "Too many attempts!";

        //     return;
        // } catch (Cartalyst\Sentinel\Checkpoints\NotActivatedException $ex){
        //     // echo "Please activate your account before trying to log in";

        //     // return;
        //     $msg = 'Please activate your account before trying to log in';
        //     // return Redirect::to(route('auth.login'))->with('STATUS_FAIL', $msg);
        //     return redirect()->route('auth.login')>with('STATUS_FAIL', $msg);
        // }

        // return Redirect::to(route('pages.home.index'));
        // return redirect()->route('home');
        // return view('pages.home.index');
    }
}
