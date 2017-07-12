<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Division;
use app\Department;
use app\Section;

class SectionController extends Controller
{
    public function GET_section(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            $section = Section::all();
        	$params = array('section' => $section);

        	return view('pages.section.listSection', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newSection(Request $request)
    {
    	if($request->session()->has('user.id'))
    	{
			$department_collection = Department::orderBy('dept_name', 'asc')->get();
	    	$department_data = $department_collection->pluck('dept_name', 'id');
	    	$department_list = $department_data->all();
			$department = array('' => 'Select Department') + $department_list;
			
			$params = array('department' => $department);

	    	return view('pages.section.newSection', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function POST_newSection()
    {
    	$sections = new Section;
        $sections->section_code   	= Input::get('section_code');
        $sections->section_name   	= Input::get('section_name');
        $sections->description 		= Input::get('section_description');
        $sections->status       	= Input::get('section_status');
        // $sections->dept_id   		= Input::get('department');
        $sections->created_by   	= Session::get('user.id');
        $sections->save();
        
        $msg = 'New section successfully created.';
        return redirect()->route('section')->with('STATUS_OK', $msg);
    }

    public function GET_viewSection(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
    		$sections = Section::where('id', $id)->first();

    		// $departments = Section::join('departments', 'sections.dept_id', '=', 'departments.id')->select('sections.*', 'departments.dept_name')->where('sections.id', $id)->first();

            // $divisions = Department::join('divisions', 'departments.division_id', '=', 'divisions.id')->select('departments.*', 'divisions.division_name')->where('departments.id', $departments->dept_id)->first();

            // $params = array('id' => $id, 'sections' => $sections, 'divisions' => $divisions, 'departments' => $departments);
            $params = array('id' => $id, 'sections' => $sections);

            return view('pages.section.viewSection', $params);
		}else{
			$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function GET_updateSection(Request $request, $id)
    {
    	if($request->session()->has('user.id'))
    	{
    		// Division
    		// $division_collection = Division::all();
            // $division_data = $division_collection->pluck('division_name', 'id');
            // $division_list = $division_data->all();
            // $division = array('' => 'Select Division') + $division_list;

            // Department
            // $department_collection = Department::orderBy('dept_name', 'asc')->get();
	    	// $department_data = $department_collection->pluck('dept_name', 'id');
	    	// $department_list = $department_data->all();
			// $department = array('' => 'Select Department') + $department_list;

            $section = Section::where('id', $id)->first();
            // $department_id = $section->dept_id;

            // $divisions_temp = Department::join('divisions', 'departments.division_id', '=', 'divisions.id')->select('departments.*', 'divisions.division_name')->where('departments.id', $department_id)->first();

            // $division_id = $divisions_temp->division_id;

            // $params = array('id' => $id, 'section' => $section, 'department' => $department, 'department_id' => $department_id, 'division' => $division, 'division_id' => $division_id);
            $params = array('id' => $id, 'section' => $section);

            return view('pages.section.editSection', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
        	return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function PUT_updateSection($id)
    {
    	$sections = Section::where('id', $id)->first();
        $sections->section_code     = Input::get('section_code');
        $sections->section_name     = Input::get('section_name');
        $sections->description   	= Input::get('section_description');
        $sections->status        	= Input::get('section_status');
        $sections->dept_id   		= Input::get('department_id');
        $sections->modified_by   	= Session::get('user.id');
        $sections->save();

        $msg = 'Selected section successfully updated.';
        return redirect()->route('section')->with('STATUS_OK', $msg);
    }

    public function DELETE_section($id)
    {
    	$sections = Section::where('id', $id)->first();
        $sections->delete();

        $msg = 'Selected section successfully deleted.';
        return redirect()->route('section')->with('STATUS_OK', $msg);
    }
}
