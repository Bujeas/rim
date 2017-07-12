<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Unit;

class UnitController extends Controller
{
    public function GET_unit(Request $request)
    {
    	if($request->session()->has('user.id')) 
    	{
    		$unit = Unit::all();
    		$params = array('unit' => $unit);

        	return view('pages.unit.listUnit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function GET_newUnit(Request $request) 
    {
    	if($request->session()->has('user.id'))
    	{
    		$params = array();

	    	return view('pages.unit.newUnit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function POST_newUnit()
    {
    	$units = new Unit;
        $units->unit_code   	= Input::get('unit_code');
        $units->unit_name   	= Input::get('unit_name');
        $units->description 	= Input::get('unit_description');
        $units->status       	= Input::get('unit_status');
        $units->created_by   	= Session::get('user.id');
        $units->save();
        
        $msg = 'New unit successfully created.';
        return redirect()->route('unit')->with('STATUS_OK', $msg);
    }
 
    public function GET_viewUnit(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
    		$units = Unit::where('id', $id)->first();
            $params = array('id' => $id, 'units' => $units);

            return view('pages.unit.viewUnit', $params);
		}else{
			$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function GET_updateUnit(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
            $unit = Unit::where('id', $id)->first();
            $params = array('id' => $id, 'unit' => $unit);

            return view('pages.unit.editUnit', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function PUT_updateUnit($id)
    {
    	$units = Unit::where('id', $id)->first();
        $units->unit_code     = Input::get('unit_code');
        $units->unit_name     = Input::get('unit_name');
        $units->description   = Input::get('unit_description');
        $units->status        = Input::get('unit_status');
        $units->modified_by   = Session::get('user.id');
        $units->save();

        $msg = 'Selected unit successfully updated.';
        return redirect()->route('unit')->with('STATUS_OK', $msg);
    }

    public function DELETE_unit($id) 
    {
    	$units = Unit::where('id', $id)->first();
        $units->delete();

        $msg = 'Selected unit successfully deleted.';
        return redirect()->route('unit')->with('STATUS_OK', $msg);
    }
}
