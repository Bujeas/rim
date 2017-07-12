<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Subunit;

class SubunitController extends Controller
{
    public function GET_subunit(Request $request)
    {
    	if($request->session()->has('user.id')) 
    	{
    		$subunit = Subunit::all();
    		$params = array('subunit' => $subunit);

        	return view('pages.subunit.listSubunit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function GET_newSubunit(Request $request)
    {
    	if($request->session()->has('user.id'))
    	{
    		$params = array();

	    	return view('pages.subunit.newSubunit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function POST_newSubunit()
    {
    	$subunits = new Subunit;
        $subunits->subunit_code   	= Input::get('subunit_code');
        $subunits->subunit_name   	= Input::get('subunit_name');
        $subunits->description 		= Input::get('subunit_description');
        $subunits->status       	= Input::get('subunit_status');
        $subunits->created_by   	= Session::get('user.id');
        $subunits->save();
        
        $msg = 'New sub unit successfully created.';
        return redirect()->route('subunit')->with('STATUS_OK', $msg);
    }

    public function GET_viewSubunit(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
    		$subunits = Subunit::where('id', $id)->first();
            $params = array('id' => $id, 'subunits' => $subunits);

            return view('pages.subunit.viewSubunit', $params);
		}else{
			$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function GET_updateSubunit(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
            $subunits = Subunit::where('id', $id)->first();
            $params = array('id' => $id, 'subunits' => $subunits);

            return view('pages.subunit.editSubunit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function PUT_updateSubunit($id)
    {
    	$subunits = Subunit::where('id', $id)->first();
        $subunits->subunit_code  = Input::get('subunit_code');
        $subunits->subunit_name  = Input::get('subunit_name');
        $subunits->description   = Input::get('subunit_description');
        $subunits->status        = Input::get('subunit_status');
        $subunits->modified_by   = Session::get('user.id');
        $subunits->save();

        $msg = 'Selected sub unit successfully updated.';
        return redirect()->route('subunit')->with('STATUS_OK', $msg);
    }

    public function DELETE_subunit($id)
    {
    	$subunits = Subunit::where('id', $id)->first();
        $subunits->delete();

        $msg = 'Selected sub unit successfully deleted.';
        return redirect()->route('subunit')->with('STATUS_OK', $msg);
    }
}
