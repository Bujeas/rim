<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use app\Classes\LDAP\LDAP;
use app\Employee;
use app\Division;
use app\Department;
use app\Section;
use app\Unit;
use app\Subunit;
use app\Template;

class APIController extends Controller
{
    public function GET_employees()
	{
		$employee_objs = Employee::all();

		$employees = array();
		foreach ($employee_objs as $key => $employee) {
			$employees[] = array(
				'id' => $employee['id'], 
				// 'email' => $employee['email']
				'name' => $employee['name']
				);
		}

		return \Response::json($employees);
	}

    public function GET_employees_email()
	{
		$emails = LDAP::employees_email();
		return Response::json($emails);
	}

    public function GET_update_db()
	{
		$counter = 0;
		$employees = LDAP::search_employees();
		foreach ($employees as $employee) {
			$exist = Employee::where('email', $employee['mail'])->get();
			if($exist->isEmpty()) {
				$email = new Employee;
				$email->name = $employee['name'];
				$email->email = $employee['mail'];
				$email->save();
				$counter++;
			}
		}
		var_dump($employees);

		return "OK. Total $counter email(s) inserted.";
	}

	public function GET_division(Request $request)
	{
		$id = $request->input('value');

		$division = Division::where('id', $id)->first();
		$division_code = $division->division_code;

		return \Response::json($division_code);
	}

	public function GET_allDivision()
	{
		$division_objs = Division::all();

		$divisions = array();
		foreach ($division_objs as $key => $division) {
			$divisions[] = array(
				'id' 	=> $division['id'], 
				'code' 	=> $division['division_code'], 
				'name' 	=> $division['division_name']
			);
		}

		return \Response::json($divisions);
	}

	public function GET_allDepartment()
	{
		$deparment_objs = Department::all();

		$departments = array();
		foreach ($deparment_objs as $key => $department) {
			$departments[] = array(
				'id' 	=> $department['id'], 
				'code' 	=> $department['dept_code'], 
				'name' 	=> $department['dept_name']
			);
		}

		return \Response::json($departments);
	}

	public function GET_department(Request $request)
	{
		$id = $request->input('value');

		$department = Department::where('id', $id)->first();
		$department_code = $department->dept_code;

		return \Response::json($department_code);
	}

	public function GET_section(Request $request)
	{
		$id = $request->input('value');

		$section = Section::where('id', $id)->first();
		$section_code = $section->section_code;

		return \Response::json($section_code);
	}

	public function GET_allSection() 
	{
		$section_objs = Section::all();

		$sections = array();
		foreach ($section_objs as $key => $section) {
			$sections[] = array(
				'id' 	=> $section['id'], 
				'code' 	=> $section['section_code'], 
				'name' 	=> $section['section_name']
			);
		}

		return \Response::json($sections);
	}

	public function GET_allUnit()
	{
		$unit_objs = Unit::all();

		$units = array();
		foreach ($unit_objs as $key => $unit) {
			$units[] = array(
				'id' 	=> $unit['id'], 
				'code' 	=> $unit['unit_code'], 
				'name' 	=> $unit['unit_name']
			);
		}

		return \Response::json($units);
	}

	public function GET_allSubunit()
	{
		$subunit_objs = Subunit::all();

		$subunits = array();
		foreach ($subunit_objs as $key => $subunit) {
			$subunits[] = array(
				'id' 	=> $subunit['id'], 
				'code' 	=> $subunit['subunit_code'], 
				'name' 	=> $subunit['subunit_name']
			);
		}

		return \Response::json($subunits);
	}

	public function GET_listDepartment($id)
	{
		try
		{
			$department_objs = Division::where('departments.division_id', $id)->join('departments', 'divisions.id', '=', 'departments.division_id')->select('divisions.division_name', 'departments.id','departments.dept_name')->get();

			$departments = array();
			foreach ($department_objs as $key => $department) {
				$departments[] = array($department['id'], $department['dept_name']);
			}

			$var_dept = str_replace(' ', '', $department['division_name']);
			$var_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $var_dept);	

			$merge = array_merge(array(array('0', 'Select Department')), $departments); 

			$concat_dept = array($var_clean => $merge);

			return \Response::json($concat_dept);
		}catch(\Exception $e){
			return \Response::json('null');
		}
		
	}

	public function GET_listSection($id)
	{
		try
		{
			$section_objs = Department::where('sections.dept_id', $id)->join('sections', 'departments.id', '=', 'sections.dept_id')->select('departments.dept_name', 'sections.id','sections.section_name')->get();

			$sections = array();
			foreach ($section_objs as $key => $section) {
				$sections[] = array($section['id'], $section['section_name']);
			}

			$var_section = str_replace(' ', '', $section['dept_name']);
			$var_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $var_section);	

			$merge = array_merge(array(array('0', 'Select Section')), $sections); 

			$concat_section = array($var_clean => $merge);

			return \Response::json($concat_section);
		}catch(\Exception $e){
			return \Response::json('null');
		}
		
	}

	public function GET_listTemplate($id)
	{
		try
		{
			$str = explode('_', $id);
			$total = count($str);

			// $div = $str[0];
			// $dept = $str[1];
			// $sect = $str[2];
			// $seq = $str[3];
			// $year = $str[4];

			// $format = $div . '/' . $dept . '/' . $sect . '/' . $seq . '/' . $year;

			if($total == 1)
			{
				$div = $str[0];
				$format = $div;
			}

			if($total == 2)
			{
				$div = $str[0];
				$dept = $str[1];
				$format = $div . '/' . $dept;
			}

			if($total == 3)
			{
				$div = $str[0];
				$dept = $str[1];
				$sect = $str[2];
				$format = $div . '/' . $dept . '/' . $sect;
			}

			$template_objs = Template::where('format', 'like', '%' . $format . '%')->get();

			$templates = array();
			foreach ($template_objs as $key => $template) {
				$templates[] = array($template['id'], $template['format']);
			}

			$array_obj = 'tempList';

			$merge = array_merge(array(array('0', 'Select Template')), $templates);

			$concat_template = array($array_obj => $merge);

			return \Response::json($concat_template);
		}catch(\Exception $e){
			return \Response::json('null');
		}
	}

	public function GET_group($params)
	{
		$ex_params = explode('_', $params);
		$group_name = ucfirst($ex_params[0]);
		$route = $ex_params[1];
		$action = $ex_params[2];

		$group = Sentinel::findRoleByName($group_name);
		$permits = $group->permissions;

		if ($action == 'push') {
			$permits[$route] = 1;
		} else if($action == 'pop') {
			$permits[$route] = 0;

			foreach ($permits as $key => $value){
			    if ($value == 0) {
			        unset($permits[$key]);
			    }
			}
		} else {
			return 'false';
		}

		$group->permissions = $permits;
		
		if ($group->save()) {
	        return 'true';
	    } else {
	        return 'false';
	    }
	}
}
