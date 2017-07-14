@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Template</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li class="active">
                <strong>New Template</strong>
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
                    <h5>New Template Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('template.new.post'), 'class' => 'form-horizontal', 'id' => 'form')) }}
                    	<div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_name', '', array('id' => 'temp_name', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Code</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_code', '', array('id' => 'temp_code', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Document Category</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_doc', $document, '', array('id' => 'temp_doc', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Prefix Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_prefix', '', array('id' => 'temp_prefix', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{-- {{ Form::select('temp_div', $division, '', array('id' => 'temp_div', 'class' => 'form-control', 'required' => 'required')) }} --}}
                                {{ Form::text('temp_div', '', array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'temp_div', 'required' => 'required')) }}
                                {{ Form::hidden('temp_div_id', '', array('id' => 'temp_div_id')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                {{-- {{ Form::select('temp_dept', array('' => 'Select Department'), null, array('class' => 'form-control', 'id' => 'temp_dept')) }} --}}
                                {{ Form::text('temp_dept', '', array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'temp_dept')) }}
                                {{ Form::hidden('temp_dept_id', '', array('id' => 'temp_dept_id')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Section Name</label>
                            <div class="col-sm-10">
                                {{-- {{ Form::select('temp_sec', array('' => 'Select Section'), null, array('class' => 'form-control', 'id' => 'temp_sec')) }} --}}
                                {{ Form::text('temp_section', '', array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'temp_section')) }}
                                {{ Form::hidden('temp_section_id', '', array('id' => 'temp_section_id')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Unit Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_unit', '', array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'temp_unit')) }}
                                {{ Form::hidden('temp_unit_id', '', array('id' => 'temp_unit_id')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sub Unit Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_subunit', '', array('class' => 'form-control', 'autocomplete' => 'off', 'id' => 'temp_subunit')) }}
                                {{ Form::hidden('temp_subunit_id', '', array('id' => 'temp_subunit_id')) }}
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Current Year</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_seq', $year, array('id' => 'temp_seq', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sequence No</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_year', $running_no, array('id' => 'temp_year', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                            </div>
                        </div> --}}
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Postfix Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('temp_postfix', '', array('id' => 'temp_postfix', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed" id="hr_format"></div>
                        <div class="form-group" id="group_format"><label class="col-sm-2 control-label" style="margin-top: 8px;">Template Format</label>
                            <div class="col-sm-10">
                                <div class="alert alert-success" style="height: 50px;">
                                    <span style="" id="temp_default">
                                        <img src="{{ asset('/img/sand_spinner.gif') }}" style="width: 16px; height: 16px; margin-top: -3px;" /> 
                                        Waiting ....
                                    </span>
                                    <span style="" id="temp_format_prefix"></span>
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    <span id="temp_format_div"></span>
                                    {{-- <label class="checkbox-inline">/</label>  --}}
                                    <span id="temp_format_dept"></span>
                                    {{-- <label class="checkbox-inline">/</label>  --}}
                                    <span id="temp_format_sec"></span>
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    <span id="temp_format_unit"></span>
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    <span id="temp_format_subunit"></span>
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    <span id="temp_format_postfix"></span>
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    {{-- <span style="display: none;" id="temp_format_sequence">00000000 - </span> --}}
                                    {{-- <label class="checkbox-inline">/</label> --}}
                                    {{-- <span style="display: none;" id="temp_format_year">{{ $year }}</span> --}}
                                </div>

                                {{-- Hidden Format --}}
                                {{ Form::hidden('f_div', '', array('id' => 'f_div')) }}
                                {{ Form::hidden('f_dept', '', array('id' => 'f_dept')) }}
                                {{ Form::hidden('f_sec', '', array('id' => 'f_sec')) }}
                                {{ Form::hidden('f_unit', '', array('id' => 'f_unit')) }}
                                {{ Form::hidden('f_subunit', '', array('id' => 'f_subunit')) }}
                                {{-- {{ Form::hidden('f_seq', $running_no, array('id' => 'f_seq')) }} --}}
                                {{ Form::hidden('f_year', $year, array('id' => 'f_year')) }}

                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('temp_description', null, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" id="btn-reset" type="reset">Reset</button>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>
                    {{ Form::close() }}    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection