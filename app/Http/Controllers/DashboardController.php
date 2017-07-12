<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function GET_dashboard(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            return view('pages.home.dashboard');
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }
}
