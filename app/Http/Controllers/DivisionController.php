<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Division;

class DivisionController extends Controller
{
    public function GET_division(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            $division = Division::all();
        	$params = array('division' => $division);

        	return view('pages.division.listDivision', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newDivision(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            return view('pages.division.newDivision');
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function POST_newDivision()
    {
        $divisions = new Division;
        $divisions->division_code    = Input::get('div_code');
        $divisions->division_name    = Input::get('div_name');
        $divisions->description      = Input::get('div_description');
        $divisions->status           = Input::get('div_status');
        $divisions->created_by       = Session::get('user.id');
        $divisions->save();
        
        $msg = 'New division successfully created.';
        return redirect()->route('division')->with('STATUS_OK', $msg);
    }

    public function GET_viewDivision(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $divisions = Division::where('id', $id)->first();
            $params = array('id' => $id, 'divisions' => $divisions);

            return view('pages.division.viewDivision', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_updateDivision(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $divisions = Division::where('id', $id)->first();
            $params = array('id' => $id, 'divisions' => $divisions);

            return view('pages.division.editDivision', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function PUT_updateDivision($id)
    {
        $divisions = Division::where('id', $id)->first();
        $divisions->division_code    = Input::get('div_code');
        $divisions->division_name    = Input::get('div_name');
        $divisions->description      = Input::get('div_description');
        $divisions->status           = Input::get('div_status');
        $divisions->modified_by      = Session::get('user.id');
        $divisions->save();

        $msg = 'Selected division successfully updated.';
        return redirect()->route('division')->with('STATUS_OK', $msg);
    }

    public function DELETE_division($id)
    {
        $divisions = Division::where('id', $id)->first();
        $divisions->delete();

        $msg = 'Selected division successfully deleted.';
        return redirect()->route('division')->with('STATUS_OK', $msg);
    }
}
