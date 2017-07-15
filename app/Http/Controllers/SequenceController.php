<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use app\Division;
use app\Department;
use app\Section;
use app\Sequence;
use app\DocumentNumber;
use app\DocumentNumberHistory;
use app\Document;
use app\Template;
use app\TemplateHistory;
use app\Action;
use Date;

class SequenceController extends Controller
{
    public function GET_sequence(Request $request)
    {
    	if($request->session()->has('user.id'))
        {
            $doc_number = DocumentNumber::all();
        	$params = array('doc_number' => $doc_number);

        	return view('pages.sequence.listSequence', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_newSequence(Request $request)
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

            //Document
            $doc_collection = Document::orderBy('doc_cat', 'asc')->get();
            $doc_data = $doc_collection->pluck('doc_cat', 'id');
            $doc_list = $doc_data->all();
            $document = array('' => 'Select Document') + $doc_list;

            //Template
            $temp_collection = Template::orderBy('format', 'asc')->get();
            $temp_data = $temp_collection->pluck('format', 'id');
            $temp_list = $temp_data->all();
            $template = array('' => 'Select Template') + $temp_list;

            $sequence_no = Sequence::orderBy('id', 'desc')->limit('1')->first();
            // $sequence = DocumentNumber::orderBy('id', 'desc')->limit('1')->first();

            $sequence_date = Sequence::orderBy('created_at', 'desc')->limit('1')->first();
            if(!empty($sequence_date))
            {
                $date = $sequence_date->date_created;
                $str_year = new Date($date);
                $prv_year = $str_year->format('Y');
            }else{
                $prv_year = Date::today()->format('Y');
            }

            $crr_year = Date::today()->format('Y');

            if(!empty($sequence_no) && ($prv_year == $crr_year))
            {
                // $index = $sequence_no->running_number + 1;
                $index = $sequence_no->sequence_number + 1;
                $new_index = convert_sequence($index); //str_pad($index, 8, "0", STR_PAD_LEFT);
                $running_no = $new_index;
            }else{
                $index = 1;
                $new_index = convert_sequence($index); //str_pad($index, 8, "0", STR_PAD_LEFT);
                $running_no = $new_index;
            }

            $year = date('Y');
            
            $params = array(
                'division'      => $division, 
                'department'    => $department, 
                'section'       => $section, 
                'document'      => $document, 
                'template'      => $template, 
                'running_no'    => $running_no,
                'year'          => $year
            );

            return view('pages.sequence.newSequence', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function POST_newSequence()
    {
        // $doc_numbers = DocumentNumber::all();

        // foreach($doc_numbers as $doc_number)
        // {
        //     if(Input::get('sequence_doc_name') == $doc_number->document_id && Input::get('sequence_name') == $doc_number->template_id)
        //     {
        //         $msg = 'Selected document type and format already generated.';
        //         // return redirect()->route('sequence')->with('STATUS_FAIL', $msg)->withInput();
        //         return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        //     }
        // }

        if(!empty(Input::get('sequence_name')))
        {
            //Insert into Table Document Number
            //-------------------------------------------------------------
            $doc_no = new DocumentNumber;
            $doc_no->document_id    = Input::get('seq_doc_id');
            $doc_no->document_name  = Input::get('seq_doc_name');
            $doc_no->running_number = Input::get('seq_no');
            $doc_no->description    = Input::get('sequence_desc');
            $doc_no->template_id    = Input::get('sequence_name');
            $doc_no->created_by     = Session::get('user.id');
            $doc_no->status         = '2';
            $doc_no->save();

            //Insert into Table Document Number History
            //-------------------------------------------------------------
            $doc_no_history = new DocumentNumberHistory;
            $doc_no_history->document_id    = Input::get('seq_doc_id');
            $doc_no_history->document_name  = Input::get('seq_doc_name');
            $doc_no_history->running_number = Input::get('seq_no');
            $doc_no_history->description    = Input::get('sequence_desc');
            $doc_no_history->template_id    = Input::get('sequence_name');
            $doc_no_history->created_by     = Session::get('user.id');
            $doc_no_history->status         = '2';
            $doc_no_history->save();

            //Insert into Table Template Sequence
            //-------------------------------------------------------------
            $sequence = new Sequence;
            $sequence->sequence_number  = Input::get('seq_no');
            $sequence->template_id      = Input::get('sequence_name');
            $sequence->save();

            //Update Table Template
            //-------------------------------------------------------------
            // $template = Template::where('id', Input::get('sequence_temp_name'))->first();
            // $format_data = $template->format;

            // $format_array      = explode('/', $format_data);
            // $format_prefix     = $format_array[0];
            // $format_div        = $format_array[1];
            // $format_dept       = $format_array[2];
            // $format_sec        = $format_array[3];
            // $format_year       = $format_array[4];
            // $format_postfix    = $format_array[5];

            // $format = $format_prefix.'/'.$format_div.'/'.$format_dept.'/'.$format_sec.'/'.Input::get('seq_no').'/'.$format_year.'/'.$format_postfix;

            // $template->category_id  = Input::get('sequence_doc_name');
            // $template->format       = $format;
            // $template->modified_by  = Session::get('user.id');
            // $template->save();

            //Update Table Template History
            //-------------------------------------------------------------
            // $templateHistory = TemplateHistory::where('id', Input::get('sequence_temp_name'))->first();
            // $format_data = $templateHistory->format;

            // $format_array      = explode('/', $format_data);
            // $format_prefix     = $format_array[0];
            // $format_div        = $format_array[1];
            // $format_dept       = $format_array[2];
            // $format_sec        = $format_array[3];
            // $format_year       = $format_array[4];
            // $format_postfix    = $format_array[5];

            // $format = $format_prefix.'/'.$format_div.'/'.$format_dept.'/'.$format_sec.'/'.Input::get('seq_no').'/'.$format_year.'/'.$format_postfix;

            // $templateHistory->category_id  = Input::get('sequence_doc_name');
            // $templateHistory->format       = $format;
            // $templateHistory->modified_by  = Session::get('user.id');
            // $templateHistory->save();

            $msg = 'New sequence successfully created.';
            return redirect()->route('sequence')->with('STATUS_OK', $msg);

            // echo 'Table Document Number <br/>';
            // echo '---------------------------- <br/>';
            // echo 'Document ID : '.Input::get('seq_doc_id').'<br/>';
            // echo 'Document Name : '.Input::get('seq_doc_name').'<br/>';
            // echo 'Document Run No : '.Input::get('seq_no').'<br/>';
            // echo 'Document Description : '.Input::get('sequence_desc').'<br/>';
            // echo 'Document Template ID : '.Input::get('sequence_name').'<br/>';
            // echo 'Document Created By : '.Session::get('user.id').'<br/><br/><br/>';

            // echo 'Table Sequence <br/>';
            // echo '---------------------------- <br/>';
            // echo 'Sequence No : '.Input::get('seq_no').'<br/>';
            // echo 'Template ID : '.Input::get('sequence_name').'<br/><br/><br/>';

            // echo 'Table Template <br/>';
            // echo '---------------------------- <br/>';
            // echo 'Category ID : '.Input::get('seq_doc_id').'<br/>';
            // echo 'Format : '.$format.'<br/>';
            // echo 'Modified By : '.Session::get('user.id').'<br/>';
        }else{
            $msg = 'Template is not selected. Please check availability and select template.';
            return redirect()->back()->with('STATUS_FAIL', $msg)->withInput();
        }
        
    }

    public function GET_viewSequence(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $doc_number = DocumentNumber::join('doc_notemplates', 'doc_numbers.template_id', '=', 'doc_notemplates.id')->join('users', 'doc_numbers.created_by', '=', 'users.id')->select('doc_numbers.id', 'doc_numbers.document_id', 'doc_numbers.document_name', 'doc_numbers.running_number', 'doc_notemplates.temp_name', 'doc_notemplates.format', 'users.first_name', 'doc_numbers.created_at')->where('doc_numbers.id', $id)->first();

            $obj_format = $doc_number->format;
            $format_array = explode('/', $obj_format);
            $indexs = count($format_array);
            $postfix = array_pop($format_array); //get last array
            /*$last = array_shift($format_array); //get first array*/
            unset($format_array[$indexs - 1]);
            $objs = array_values($format_array);

            $format = implode('/',$objs).'/'.convert_sequence($doc_number->running_number).'/'.Date::today()->format('Y').'/'.$postfix;            
            
            // $format_data = $doc_number->format;
            // $format_array      = explode('/', $format_data);
            // $format_prefix     = $format_array[0];
            // $format_div        = $format_array[1];
            // $format_dept       = $format_array[2];
            // $format_sec        = $format_array[3];
            // $format_seq        = $format_array[4];
            // $format_year       = $format_array[5];
            // $format_postfix    = $format_array[6];

            // $format = $format_prefix.'/'.$format_div.'/'.$format_dept.'/'.$format_sec.'/'.convert_sequence($doc_number->running_number).'/'.$format_year.'/'.$format_postfix;

            $params = array('doc_number' => $doc_number, 'format' => $format);
            return view('pages.sequence.viewSequence', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function GET_updateSequence(Request $request, $id)
    {
        if($request->session()->has('user.id'))
        {
            $doc_number = DocumentNumber::join('doc_notemplates', 'doc_numbers.template_id', '=', 'doc_notemplates.id')->join('users', 'doc_numbers.created_by', '=', 'users.id')->select('doc_numbers.id', 'doc_numbers.document_id', 'doc_numbers.document_name', 'doc_numbers.running_number', 'doc_notemplates.temp_name', 'doc_notemplates.format', 'users.first_name', 'doc_numbers.created_at', 'doc_numbers.status')->where('doc_numbers.id', $id)->first();

            /*
            $format_data = $doc_number->format;
            $format_array      = explode('/', $format_data);
            $format_prefix     = $format_array[0];
            $format_div        = $format_array[1];
            $format_dept       = $format_array[2];
            $format_sec        = $format_array[3];
            $format_seq        = $format_array[4];
            $format_year       = $format_array[5];
            $format_postfix    = $format_array[6];

            $format = $format_prefix.'/'.$format_div.'/'.$format_dept.'/'.$format_sec.'/'.convert_sequence($doc_number->running_number).'/'.$format_year.'/'.$format_postfix;
            */

            $obj_format = $doc_number->format;
            $format_array = explode('/', $obj_format);
            $indexs = count($format_array);
            $postfix = array_pop($format_array); //get last array
            /*$last = array_shift($format_array); //get first array*/
            unset($format_array[$indexs - 1]);
            $objs = array_values($format_array);

            $format = implode('/',$objs).'/'.convert_sequence($doc_number->running_number).'/'.Date::today()->format('Y').'/'.$postfix;

            $act_collection = Action::all();
            $act_data = $act_collection->pluck('action_name', 'id');
            $action_list = $act_data->all();
            $action = array('' => 'Select Actions') + $action_list;

            $params = array('id' => $id, 'doc_number' => $doc_number, 'format' => $format, 'action' => $action);
            return view('pages.sequence.editSequence', $params);
        }else{
            $msg = 'Your session has expired. Please login again.';
            return redirect()->route('login')->with('STATUS_WARNING', $msg);
        }
    }

    public function PUT_updateSequence($id)
    {
        //Update Table Document Number
        //-------------------------------------------------------------
        $doc_no = DocumentNumber::where('id', $id)->first();
        $doc_no->status   = Input::get('sequence_action');
        $doc_no->remarks  = Input::get('sequence_remarks');
        $doc_no->save();

        //Update Table Document Number History
        //-------------------------------------------------------------
        $doc_no_history = DocumentNumberHistory::where('id', $id)->first();
        $doc_no_history->status   = Input::get('sequence_action');
        $doc_no_history->remarks  = Input::get('sequence_remarks');
        $doc_no_history->save();

        $msg = 'Selected sequence template successfully updated.';
        return redirect()->route('sequence')->with('STATUS_OK', $msg);
    }
}
