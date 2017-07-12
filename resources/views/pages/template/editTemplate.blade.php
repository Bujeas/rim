@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Document</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li>
                <a href="{{ route('template') }}">List of Templates</a>
            </li>
            <li class="active">
                <strong>Edit Template</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <p> {{ bootstrap_alert() }} </p>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Edit Template Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('template.update.put', $id), 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'form')) }}
                    	<div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_name', $template->temp_name, array('id' => 'temp_name', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Code</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_code', $template->temp_code, array('id' => 'temp_code', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Prefix Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_prefix', $template->prefix, array('id' => 'temp_prefix', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_div', $division, $division_id, array('id' => 'temp_div', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                {{-- {{ Form::select('temp_dept', array('' => 'Select Department'), null, array('class' => 'form-control', 'id' => 'temp_dept', 'required' => 'required')) }} --}}
                                {{ Form::select('temp_dept', $department, $dept_id, array('id' => 'temp_dept', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Section Name</label>
                            <div class="col-sm-10">
                                {{-- {{ Form::select('temp_sec', array('' => 'Select Section'), null, array('class' => 'form-control', 'id' => 'temp_sec', 'required' => 'required')) }} --}}
                                {{ Form::select('temp_sec', $section, $section_id, array('id' => 'temp_sec', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Document Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_doc', $document, $document_id, array('id' => 'temp_doc', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div> --}}
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Postfix Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_postfix', $template->postfix, array('id' => 'temp_postfix', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Format</label>
                            <div class="col-sm-10" style="margin-left: -18px;">
                                <label class="checkbox-inline"><span style="" id="temp_format_prefix">{{ $temp_format_prefix }}</span></label>
                                <label class="checkbox-inline">/</label>
                            	<label class="checkbox-inline"><span style="" id="temp_format_div">{{ $temp_format_div }}</span></label> 
                            	<label class="checkbox-inline">/</label> 
                                <label class="checkbox-inline"><span style="" id="temp_format_dept">{{ $temp_format_dept }}</span></label>
                            	<label class="checkbox-inline">/</label> 
                            	<label class="checkbox-inline"><span style="" id="temp_format_sec">{{ $temp_format_sec }}</span></label>
                                <label class="checkbox-inline">/</label>
                                {{-- @if(!empty($template->category_id)) --}}
                                <label class="checkbox-inline"><span style="" id="temp_format_sequence">{{ $temp_format_sequence }}</span></label>
                                <label class="checkbox-inline">/</label>
                                {{-- @endif --}}
                                <label class="checkbox-inline"><span style="" id="temp_format_year">{{ $temp_format_year }}</span></label>
                                <label class="checkbox-inline">/</label>
                                <label class="checkbox-inline"><span style="" id="temp_format_postfix">{{ $temp_format_postfix }}</span></label>

                                {{-- Hidden Format --}}
                                {{ Form::hidden('f_div', $temp_format_div, array('id' => 'f_div')) }}
                                {{ Form::hidden('f_dept', $temp_format_dept, array('id' => 'f_dept')) }}
                                {{ Form::hidden('f_sec', $temp_format_sec, array('id' => 'f_sec')) }}
                                {{ Form::hidden('f_seq', $temp_format_sequence, array('id' => 'f_seq')) }}
                                {{-- {{ Form::hidden('f_doc', $temp_format_doc, array('id' => 'f_doc')) }} --}}
                                {{ Form::hidden('f_year', $year, array('id' => 'f_year')) }}

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('temp_description', $template->description, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('template') }}" class="btn btn-white">Cancel</a>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    {{ Form::close() }}    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection