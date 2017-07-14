<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Division;
use app\Department;
use app\Section;
use app\Unit;
use app\Subunit;
use app\Document;
use app\Template;
use app\TemplateHistory;
use app\Sequence;

class TemplateController extends Controller
{
    public function GET_template(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            $template = Template::all();
        	$params = array('template' => $template);

        	return view('pages.template.listTemplate', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newTemplate(Request $request)
    {
    	if($request->session()->has('user.id'))
    	{
			// Division
    		$division_collection = Division::all();
            $division_data = $division_collection->pluck('division_name', 'id');
            $division_list = $division_data->all();
            $division = array('' => 'Select Division') + $division_list;

            // Department
            $department_collection = Department::orderBy('dept_name', 'asc')->get();
	    	$department_data = $department_collection->pluck('dept_name', 'id');
	    	$department_list = $department_data->all();
			$department = array('' => 'Select Department') + $department_list;

			// Section
            $section_collection = Section::orderBy('section_name', 'asc')->get();
	    	$section_data = $section_collection->pluck('section_name', 'id');
	    	$section_list = $section_data->all();
			$section = array('' => 'Select Section') + $section_list;

			// Document
            $doc_collection = Document::orderBy('doc_cat', 'asc')->get();
	    	$doc_data = $doc_collection->pluck('doc_cat', 'id');
	    	$doc_list = $doc_data->all();
			$document = array('' => 'Select Document') + $doc_list;

            // $sequence = Sequence::orderBy('id', 'desc')->limit('1')->first();

            // if(!empty($sequence))
            // {
            //     $index = $sequence->id + 1;
            //     $new_index = str_pad($index, 8, "0", STR_PAD_LEFT);
            //     $running_no = $new_index;
            // }else{
            //     $index = 1;
            //     $new_index = str_pad($index, 8, "0", STR_PAD_LEFT);
            //     $running_no = $new_index;
            // }   

            $year = date('Y');
			
			$params = array(
                'division'      => $division, 
                'department'    => $department, 
                'section'       => $section, 
                'document'      => $document, 
                'year'          => $year, 
                // 'running_no'    => $running_no
            );

	    	return view('pages.template.newTemplate', $params);
    	}else{
    		$msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
    	}
    }

    public function POST_newTemplate()
    {
        $obj_dept = Input::get('f_dept');
        if(!empty($obj_dept))
        {
            $department_raw = $obj_dept;
            $department = $obj_dept;
        }else{
            $department_raw = '-/';
            $department = '';
        }
        
        $obj_sec = Input::get('f_sec');
        if(!empty($obj_sec))
        {
            $section_raw = $obj_sec;
            $section = $obj_sec;
        }else{
            $section_raw = '-/';
            $section = '';
        }

        $obj_unit = Input::get('f_unit');
        if(!empty($obj_unit))
        {
            $unit_raw = $obj_unit;
            $unit = $obj_unit;
        }else{
            $unit_raw = '-/';
            $unit = '';
        }

        $obj_subunit = Input::get('f_subunit');
        if(!empty($obj_subunit))
        {
            $subunit_raw = $obj_subunit;
            $subunit = $obj_subunit;
        }else{
            $subunit_raw = '-/';
            $subunit = '';
        }

        $format =   Input::get('temp_prefix').
                    '/'.Input::get('f_div').
                    $department.
                    $section.
                    $unit.
                    $subunit.
                    Input::get('temp_postfix');

        $format_raw =   Input::get('temp_prefix').
                        '/'.Input::get('f_div').
                        $department_raw.
                        $section_raw.
                        $unit_raw.
                        $subunit_raw.
                        Input::get('temp_postfix');

        // $format =   Input::get('temp_prefix').
        //             '/'.Input::get('f_div').
        //             '/'.Input::get('f_dept').
        //             '/'.
        //             $section.
        //             $unit.
        //             $subunit.
        //             Input::get('temp_postfix');
                    // '-00000000-'.
                    // Input::get('f_year');

        // $format_raw =   Input::get('temp_prefix').
        //             '/'.Input::get('f_div').
        //             '/'.Input::get('f_dept').
        //             '/'.
        //             $section_raw.
        //             $unit_raw.
        //             $subunit_raw.
        //             Input::get('temp_postfix');
                    // '-00000000-'.
                    // Input::get('f_year');

        // echo 'Format: '.$format.'<br/>';
        // echo 'Format Raw: '.$format_raw.'<br/>';
        
        $temp_dept = explode(',', Input::get('temp_dept'));
        $department = $temp_dept[0];

        $temp_sec = explode(',', Input::get('temp_sec'));
        $section = $temp_sec[0];

        $db_name    = Template::select('temp_name')->where('temp_name', Input::get('temp_name'))->first();
        $db_code    = Template::select('temp_code')->where('temp_code', Input::get('temp_code'))->first();
        $db_format  = Template::select('format')->where('format', $format)->first();

        if(!empty($db_name))
        {
            $temp_name   = $db_name->temp_name;
        }else{
            $temp_name   = '';
        }

        if(!empty($db_code))
        {
            $temp_code   = $db_code->temp_code;
        }else{
            $temp_code   = '';
        }

        if(!empty($db_format))
        {
            $temp_format = $db_format->format;
        }else{
            $temp_format = '';
        }

        if($db_name != '')
        {
            $msg = 'Template Name <strong> '.Input::get('temp_name').' </strong>already created. Please enter new name.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }elseif($db_code != ''){
            $msg = 'Template Code <strong> '.Input::get('temp_code').' </strong>already created. Please enter new code.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }elseif($db_format != ''){
            $msg = 'Template Format <strong> '.$format.' </strong>already created. Please create new format.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }else{
            //Insert into Table Template
            //-------------------------------------------------------------         
            $template = new Template;
            $template->temp_code    = Input::get('temp_code');
            $template->temp_name    = Input::get('temp_name');
            $template->description  = Input::get('temp_description');
            $template->prefix       = Input::get('temp_prefix');
            $template->postfix      = Input::get('temp_postfix');
            $template->division_id  = Input::get('temp_div_id');
            $template->dept_id      = Input::get('temp_dept_id');
            $template->section_id   = Input::get('temp_section_id');
            $template->unit_id      = Input::get('temp_unit_id');
            $template->subunit_id   = Input::get('temp_subunit_id');
            $template->category_id  = Input::get('temp_doc');
            $template->format       = $format;
            $template->format_raw   = $format_raw;
            $template->created_by   = Session::get('user.id');
            $template->save();

            //Insert into Table Template History
            //-------------------------------------------------------------
            $templateHistory = new TemplateHistory;
            $templateHistory->temp_code    = Input::get('temp_code');
            $templateHistory->temp_name    = Input::get('temp_name');
            $templateHistory->description  = Input::get('temp_description');
            $templateHistory->prefix       = Input::get('temp_prefix');
            $templateHistory->postfix      = Input::get('temp_postfix');
            $templateHistory->division_id  = Input::get('temp_div_id');
            $templateHistory->dept_id      = Input::get('temp_dept_id');
            $templateHistory->section_id   = Input::get('temp_section_id');
            $templateHistory->unit_id      = Input::get('temp_unit_id');
            $templateHistory->subunit_id   = Input::get('temp_subunit_id');
            $templateHistory->category_id  = Input::get('temp_doc');
            $templateHistory->format       = $format;
            $templateHistory->format_raw   = $format_raw;
            $templateHistory->created_by   = Session::get('user.id');
            $templateHistory->save();

            //Insert into Table Sequence
            //-------------------------------------------------------------
            // $sequence = new Sequence;
            // $sequence->sequence_number  = Input::get('f_seq');
            // $sequence->save();   

            $msg = 'New template successfully created.';
            return redirect()->route('template')->with('STATUS_OK', $msg);

            // echo 'Template Code : '.Input::get('temp_name').'<br>';
            // echo 'Template Name : '.Input::get('temp_code').'<br>';
            // echo 'Template Description : '.Input::get('temp_description').'<br>';
            // echo 'Template Prefix : '.Input::get('temp_prefix').'<br>';
            // echo 'Template Postfix : '.Input::get('temp_postfix').'<br>';
            // echo 'Template Division : '.Input::get('temp_div_id').'<br>';
            // echo 'Template Department : '.Input::get('temp_dept_id').'<br>';
            // echo 'Template Section : '.Input::get('temp_section_id').'<br>';
            // echo 'Template Unit : '.Input::get('temp_unit_id').'<br>';
            // echo 'Template Sub Unit : '.Input::get('temp_subunit_id').'<br>';
            // echo 'Template Category : '.Input::get('temp_doc').'<br>';
            // echo 'Template Format : '.$format.'<br/>';
            // echo 'Template Format Raw : '.$format_raw.'<br/>';
            // echo 'Template created_by : '.Session::get('user.id').'<br>';
        }
        
    }

    public function GET_viewTemplate(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $temp_objs = Template::where('id', $id)->first();
            if(!empty($temp_objs))
            {
                $temp_name = $temp_objs->temp_name;
                $temp_code = $temp_objs->temp_code;
                $temp_prefix = $temp_objs->prefix;
                $temp_postfix = $temp_objs->postfix;
                $temp_format = $temp_objs->format;
                $temp_cat_id = $temp_objs->category_id;
                $temp_desc = $temp_objs->description;
            }else{
                $temp_name = '';
                $temp_code = '';
                $temp_prefix = '';
                $temp_postfix = '';
                $temp_format = '';
                $temp_cat_id = '';
                $temp_desc = '';
            }

            $div_objs = Division::join('doc_notemplates', 'divisions.id', '=', 'doc_notemplates.division_id')->select('divisions.division_name')->where('doc_notemplates.id', $id)->where('doc_notemplates.division_id', $temp_objs->division_id)->first();
            if(!empty($div_objs))
            {
                $divisions = $div_objs->division_name;
            }else{
                $divisions = '';
            }
            
            $dept_objs = Department::join('doc_notemplates', 'departments.id', '=', 'doc_notemplates.dept_id')->select('departments.dept_name')->where('doc_notemplates.id', $id)->where('doc_notemplates.dept_id', $temp_objs->dept_id)->first();
            if(!empty($dept_objs))
            {
                $departments = $dept_objs->dept_name;
            }else{
                $departments = '';
            }
            
            $sec_objs = Section::join('doc_notemplates', 'sections.id', '=', 'doc_notemplates.section_id')->select('sections.section_name')->where('doc_notemplates.id', $id)->where('doc_notemplates.section_id', $temp_objs->section_id)->first();
            if(!empty($sec_objs))
            {
                $sections = $sec_objs->section_name;
            }else{
                $sections = '';
            }

            $unit_objs = Unit::join('doc_notemplates', 'units.id', '=', 'doc_notemplates.unit_id')->select('units.unit_name')->where('doc_notemplates.id', $id)->where('doc_notemplates.unit_id', $temp_objs->unit_id)->first();
            if(!empty($unit_objs))
            {
                $units = $unit_objs->unit_name;
            }else{
                $units = '';
            }

            $subunit_objs = Subunit::join('doc_notemplates', 'subunits.id', '=', 'doc_notemplates.subunit_id')->select('subunits.subunit_name')->where('doc_notemplates.id', $id)->where('doc_notemplates.subunit_id', $temp_objs->subunit_id)->first();
            if(!empty($subunit_objs))
            {
                $subunits = $subunit_objs->subunit_name;
            }else{
                $subunits = '';
            }
            
            $doc_objs = Document::join('doc_notemplates', 'doc_categories.id', '=', 'doc_notemplates.category_id')->select('doc_categories.doc_cat')->where('doc_notemplates.id', $id)->where('doc_notemplates.category_id', $temp_objs->category_id)->first();
            if(!empty($doc_objs))
            {
                $documents = $doc_objs->doc_cat;
            }else{
                $documents = '';
            }
            
            $params = array(
                'id'            => $id, 
                // 'templates'     => $templates, 
                'temp_name'     => $temp_name,
                'temp_code'     => $temp_code,
                'temp_prefix'   => $temp_prefix,
                'temp_postfix'  => $temp_postfix,
                'temp_format'   => $temp_format,
                'temp_cat_id'   => $temp_cat_id,
                'temp_desc'     => $temp_desc,
                'divisions'     => $divisions, 
                'departments'   => $departments, 
                'sections'      => $sections, 
                'units'         => $units,
                'subunits'      => $subunits,
                'documents'     => $documents
            );

            return view('pages.template.viewTemplate', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_updateTemplate(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $template = Template::where('id', $id)->first();
            $division_id = $template->division_id;
            $dept_id = $template->dept_id;
            $section_id = $template->section_id;
            $unit_id = $template->unit_id;
            $subunit_id = $template->subunit_id;
            $document_id = $template->category_id;
            $format = $template->format_raw;

            // if(!empty($template->category_id))
            // {
                $format_array           = explode('/', $format);
                $temp_format_prefix     = $format_array[0];
                $temp_format_div        = $format_array[1];
                $temp_format_dept       = $format_array[2];
                $temp_format_sec        = $format_array[3];
                $temp_format_unit       = $format_array[4];
                $temp_format_subunit    = $format_array[5];
                $temp_format_postfix    = $format_array[6];

            if($temp_format_div == '-')
            {
                $format_div = '';
            }else{
                $format_div = $temp_format_div . '/';
            }

            if($temp_format_dept == '-')
            {
                $format_dept = '';
            }else{
                $format_dept = $temp_format_dept . '/';
            }

            if($temp_format_sec == '-')
            {
                $format_sec = '';
            }else{
                $format_sec = $temp_format_sec . '/';
            }

            if($temp_format_unit == '-')
            {
                $format_unit = '';
            }else{
                $format_unit = $temp_format_unit . '/';
            }

            if($temp_format_subunit == '-')
            {
                $format_subunit = '';
            }else{
                $format_subunit = $temp_format_subunit . '/';
            }

            // }else{
                // $format_array           = explode('/', $format);
                // $temp_format_prefix     = $format_array[0];
                // $temp_format_div        = $format_array[1];
                // $temp_format_dept       = $format_array[2];
                // $temp_format_sec        = $format_array[3];
                // $temp_format_sequence   = '';
                // $temp_format_year       = $format_array[4];
                // $temp_format_postfix    = $format_array[5];
            // }
            
            // Division
            $div_obj = Division::where('id', $division_id)->first();
            if(!empty($division = $div_obj))
            {
                $division = $div_obj->division_name;
            }else{
                $division = '';
            }
            // $division_collection = Division::all();
            // $division_data = $division_collection->pluck('division_name', 'id');
            // $division_list = $division_data->all();
            // $division = array('' => 'Select Division') + $division_list;

            // Department
            $dept_obj = Department::where('id', $dept_id)->first();
            if(!empty($dept_obj))
            {
                $department = $dept_obj->dept_name;
            }else{
                $department = '';
            }
            // $department_collection = Department::orderBy('dept_name', 'asc')->get();
            // $department_data = $department_collection->pluck('dept_name', 'id');
            // $department_list = $department_data->all();
            // $department = array('' => 'Select Department') + $department_list;

            // Section
            $sect_obj = Section::where('id', $section_id)->first();
            if(!empty($sect_obj))
            {
                $section = $sect_obj->section_name;
            }else{
                $section = '';
            }
            // $section_collection = Section::orderBy('section_name', 'asc')->get();
            // $section_data = $section_collection->pluck('section_name', 'id');
            // $section_list = $section_data->all();
            // $section = array('' => 'Select Section') + $section_list;

            //Unit
            $unit_obj = Unit::where('id', $unit_id)->first();
            if(!empty($unit_obj))
            {
                $unit = $unit_obj->unit_name;
            }else{
                $unit = '';
            }

            //Subunit
            $subunit_obj = Subunit::where('id', $subunit_id)->first();
            if(!empty($subunit_obj))
            {
                $subunit = $subunit_obj->subunit_name;
            }else{
                $subunit = '';
            }

            // Document
            $doc_collection = Document::orderBy('doc_cat', 'asc')->get();
            $doc_data = $doc_collection->pluck('doc_cat', 'id');
            $doc_list = $doc_data->all();
            $document = array('' => 'Select Document') + $doc_list;

            $year = date('Y');

            $params = array(
                'id'                    => $id,
                'template'              => $template, 
                'division_id'           => $division_id, 
                'division'              => $division, 
                'dept_id'               => $dept_id, 
                'department'            => $department, 
                'section_id'            => $section_id, 
                'section'               => $section, 
                'unit_id'               => $unit_id,
                'unit'                  => $unit, 
                'subunit_id'            => $subunit_id,
                'subunit'               => $subunit, 
                'document_id'           => $document_id, 
                'document'              => $document, 
                'temp_format_div'       => $format_div, 
                'temp_format_dept'      => $format_dept, 
                'temp_format_sec'       => $format_sec, 
                'temp_format_unit'      => $format_unit, 
                'temp_format_subunit'   => $format_subunit, 
                // 'temp_format_sequence'  => $temp_format_sequence, 
                'temp_format_prefix'    => $temp_format_prefix. ' /', 
                // 'temp_format_year'      => $temp_format_year,
                'temp_format_postfix'   => $temp_format_postfix,
                'year'                  => $year
            );

            return view('pages.template.editTemplate', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function PUT_updateTemplate($id)
    {
        // $sequence = Input::get('f_seq');

        // if(!empty($sequence))
        // {
            // $format = Input::get('temp_prefix').'/'.Input::get('f_div').'/'.Input::get('f_dept').'/'.Input::get('f_sec').'/'.Input::get('f_seq').'/'.Input::get('f_year').'/'.Input::get('temp_postfix');
        // }else{
            // $format = Input::get('temp_prefix').'/'.Input::get('f_div').'/'.Input::get('f_dept').'/'.Input::get('f_sec').'/00000000/'.Input::get('f_year').'/'.Input::get('temp_postfix');
        // }

        $obj_dept = Input::get('f_dept');
        if(!empty($obj_dept))
        {
            $department_raw = $obj_dept;
            $department = $obj_dept;
        }else{
            $department_raw = '-/';
            $department = '';
        }

        $obj_sec = Input::get('f_sec');
        if(!empty($obj_sec))
        {
            $section_raw = $obj_sec;
            $section = $obj_sec;
        }else{
            $section_raw = '-/';
            $section = '';
        }

        $obj_unit = Input::get('f_unit');
        if(!empty($obj_unit))
        {
            $unit_raw = $obj_unit;
            $unit = $obj_unit;
        }else{
            $unit_raw = '-/';
            $unit = '';
        }

        $obj_subunit = Input::get('f_subunit');
        if(!empty($obj_subunit))
        {
            $subunit_raw = $obj_subunit;
            $subunit = $obj_subunit;
        }else{
            $subunit_raw = '-/';
            $subunit = '';
        }

        $format =   Input::get('temp_prefix').
                    '/'.Input::get('f_div').
                    $department.
                    $section.
                    $unit.
                    $subunit.
                    Input::get('temp_postfix');

        $format_raw =   Input::get('temp_prefix').
                        '/'.Input::get('f_div').
                        $department_raw.
                        $section_raw.
                        $unit_raw.
                        $subunit_raw.
                        Input::get('temp_postfix');

        // $temp_dept = explode(',', Input::get('temp_dept'));
        // $department = $temp_dept[0];

        // $temp_sec = explode(',', Input::get('temp_sec'));
        // $section = $temp_sec[0];

        //Update Table Template
        //-------------------------------------------------------------
        $template = Template::where('id', $id)->first();
        $template->temp_code    = Input::get('temp_code');
        $template->temp_name    = Input::get('temp_name');
        $template->description  = Input::get('temp_description');
        $template->prefix       = Input::get('temp_prefix');
        $template->postfix      = Input::get('temp_postfix');
        $template->division_id  = Input::get('temp_div_id');
        $template->dept_id      = Input::get('temp_dept_id');
        $template->section_id   = Input::get('temp_section_id');
        $template->unit_id      = Input::get('temp_unit_id');
        $template->subunit_id   = Input::get('temp_subunit_id');
        $template->category_id  = Input::get('temp_doc');
        $template->format       = $format;
        $template->format_raw   = $format_raw;
        $template->modified_by  = Session::get('user.id');
        // $template->save();

        //Update Table Template History
        //-------------------------------------------------------------
        $templateHistory = TemplateHistory::where('id', $id)->first();
        $templateHistory->temp_code    = Input::get('temp_code');
        $templateHistory->temp_name    = Input::get('temp_name');
        $templateHistory->description  = Input::get('temp_description');
        $templateHistory->prefix       = Input::get('temp_prefix');
        $templateHistory->postfix      = Input::get('temp_postfix');
        $templateHistory->division_id  = Input::get('temp_div_id');
        $templateHistory->dept_id      = Input::get('temp_dept_id');
        $templateHistory->section_id   = Input::get('temp_section_id');
        $templateHistory->unit_id      = Input::get('temp_unit_id');
        $templateHistory->subunit_id   = Input::get('temp_subunit_id');
        $templateHistory->category_id  = Input::get('temp_doc');
        $templateHistory->format       = $format;
        $templateHistory->format_raw   = $format_raw;
        $templateHistory->modified_by  = Session::get('user.id');
        // $templateHistory->save();

        // $msg = 'Selected template successfully updated.';
        // return redirect()->route('template')->with('STATUS_OK', $msg);

        echo 'Template Code : '.Input::get('temp_name').'<br>';
        echo 'Template Name : '.Input::get('temp_code').'<br>';
        echo 'Template Description : '.Input::get('temp_description').'<br>';
        echo 'Template Prefix : '.Input::get('temp_prefix').'<br>';
        echo 'Template Postfix : '.Input::get('temp_postfix').'<br>';
        echo 'Template Division : '.Input::get('temp_div_id').'<br>';
        echo 'Template Department : '.Input::get('temp_dept_id').'<br>';
        echo 'Template Section : '.Input::get('temp_section_id').'<br>';
        echo 'Template Unit : '.Input::get('temp_unit_id').'<br>';
        echo 'Template Sub Unit : '.Input::get('temp_subunit_id').'<br>';
        echo 'Template Category : '.Input::get('temp_doc').'<br>';
        echo 'Template Format : '.$format.'<br/>';
        echo 'Template Format Raw : '.$format_raw.'<br/>';
        echo 'Template created_by : '.Session::get('user.id').'<br>';
    }

    public function DELETE_Template($id)
    {
        $template = Template::where('id', $id)->first();
        $template->delete();

        $msg = 'Selected template successfully deleted.';
        return redirect()->route('template')->with('STATUS_OK', $msg);
    }
}
