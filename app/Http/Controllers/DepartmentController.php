<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Division;
use app\Department;

class DepartmentController extends Controller
{
    public function GET_department(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            $department = Department::all();
        	$params = array('department' => $department);

        	return view('pages.department.listDepartment', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newDepartment(Request $request)
    {
    	if($request->session()->has('user.id'))
    	{
	    	$division_collection = Division::all();
	    	$division_data = $division_collection->pluck('division_name', 'id');
	    	$division_list = $division_data->all();
			$division = array('' => 'Select Division') + $division_list;
			
			$params = array('division' => $division);

	    	return view('pages.department.newDepartment', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function POST_newDepartment()
    {
    	$departments = new Department;
        $departments->dept_code    	= Input::get('dept_code');
        $departments->dept_name    	= Input::get('dept_name');
        $departments->description 	= Input::get('dept_description');
        $departments->status        = Input::get('dept_status');
        // $departments->division_id   = Input::get('division');
        $departments->created_by    = Session::get('user.id');
        $departments->save();
        
        $msg = 'New department successfully created.';
        return redirect()->route('department')->with('STATUS_OK', $msg);
    }

    public function GET_viewDepartment(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $departments = Department::where('id', $id)->first();
            $divisions = Department::join('divisions', 'departments.division_id', '=', 'divisions.id')->select('departments.*', 'divisions.division_name')->where('departments.id', $id)->first();

            $params = array('id' => $id, 'divisions' => $divisions, 'departments' => $departments);

            return view('pages.department.viewDepartment', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_updateDepartment(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $division_collection = Division::all();
            $division_data = $division_collection->pluck('division_name', 'id');
            $division_list = $division_data->all();
            $division = array('' => 'Select Division') + $division_list;

            $departments = Department::where('id', $id)->first();
            $division_id = $departments->division_id;

            $params = array('id' => $id, 'departments' => $departments, 'division_id' => $division_id, 'division' => $division);

            return view('pages.department.editDepartment', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function PUT_updateDepartment($id)
    {
        $departments = Department::where('id', $id)->first();
        $departments->dept_code     = Input::get('dept_code');
        $departments->dept_name     = Input::get('dept_name');
        $departments->description   = Input::get('dept_description');
        $departments->status        = Input::get('dept_status');
        $departments->division_id   = Input::get('division_id');
        $departments->modified_by   = Session::get('user.id');
        $departments->save();

        $msg = 'Selected department successfully updated.';
        return redirect()->route('department')->with('STATUS_OK', $msg);
    }

    public function DELETE_department($id)
    {
        $departments = Department::where('id', $id)->first();
        $departments->delete();

        $msg = 'Selected department successfully deleted.';
        return redirect()->route('department')->with('STATUS_OK', $msg);
    }
}
