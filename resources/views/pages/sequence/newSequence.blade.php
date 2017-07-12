@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Sequence</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li class="active">
                <strong>New Sequence</strong>
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
                    <h5>New Sequence Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('sequence.new.post'), 'class' => 'form-horizontal', 'id' => 'form')) }}
                        <div class="form-group"><label class="col-sm-2 control-label">Document Type</label>
                            <div class="col-sm-10">
                                {{ Form::select('sequence_doc_name', $document, '', array('id' => 'sequence_doc_name', 'class' => 'form-control', 'required' => 'required')) }}
                                {{ Form::hidden('seq_doc_name', '', array('id' => 'seq_doc_name')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_div', $division, '', array('id' => 'temp_div', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_dept', array('' => 'Select Department'), null, array('class' => 'form-control', 'id' => 'temp_dept', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Section Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('temp_sec', array('' => 'Select Section'), null, array('class' => 'form-control', 'id' => 'temp_sec', 'required' => 'required')) }}
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sequence Number</label>
                            <div class="col-sm-10">
                                {{ Form::text('sequence_number', $running_no, array('id' => 'sequence_number', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                                {{ Form::hidden('seq_no',$running_no, array('id' => 'seq_no')) }}
                            </div>
                        </div> --}}

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sequence Number</label>
                            <div class="col-xs-6 col-md-6">
                                {{ Form::text('sequence_number', $running_no, array('id' => 'sequence_number', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                                {{ Form::hidden('seq_no',$running_no, array('id' => 'seq_no')) }}
                            </div>
                            <div class="col-xs-4 col-md-4">
                                <a class="btn btn-success btn-outline" id="btn-available" data-toggle="tooltip" data-placement="top" title="Check Availability">
                                <i class="fa fa-list-ul"> </i>
                                </a>
                                &nbsp;
                                <a href="{{ route('sequence.new') }}" class="btn btn-outline btn-danger" id="btn-available" data-toggle="tooltip" data-placement="top" title="Refresh">
                                <i class="fa fa-refresh"> </i>
                                </a>
                            </div>
                        </div>

                        {{-- <div class="sk-spinner sk-spinner-wave" id="temp_loader" style="display: none;">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div> --}}
                        
                        {{-- <div class="hr-line-dashed" id="hr_format"></div>
                        <div class="form-group" id="group_format"><label class="col-sm-2 control-label">Selected Format</label>
                            <div class="col-sm-10" style="margin-left: -18px;"> --}}
                                {{-- <label class="checkbox-inline"><span style="" id="temp_format_prefix"></span></label>
                                <label class="checkbox-inline">/</label> --}}
                                {{-- <label class="checkbox-inline"><span style="" id="temp_format_div"></span></label> 
                                <label class="checkbox-inline">/</label> 
                                <label class="checkbox-inline"><span style="" id="temp_format_dept"></span></label>
                                <label class="checkbox-inline">/</label> 
                                <label class="checkbox-inline"><span style="" id="temp_format_sec"></span></label>
                                <label class="checkbox-inline">/</label>
                                <label class="checkbox-inline"><span style="" id="temp_format_sequence">00000000</span></label>
                                <label class="checkbox-inline">/</label>
                                <label class="checkbox-inline"><span style="" id="temp_format_year">{{ $year }}</span></label> --}}
                                {{-- <label class="checkbox-inline">/</label>
                                <label class="checkbox-inline"><span style="" id="temp_format_postfix"></span></label> --}}
                                {{-- <label class="checkbox-inline">
                                <a class="btn btn-success" id="btn-available" style="margin-top: -6px;">
                                    <i class="fa fa-cog"> </i> Check Availability
                                </a>
                                </label> --}}


                                {{-- Hidden Format --}}
                                {{ Form::hidden('f_div', '', array('id' => 'f_div')) }}
                                {{ Form::hidden('f_dept', '', array('id' => 'f_dept')) }}
                                {{ Form::hidden('f_sec', '', array('id' => 'f_sec')) }}
                                {{-- {{ Form::hidden('f_seq', $running_no, array('id' => 'f_sec')) }} --}}
                                {{ Form::hidden('f_year', $year, array('id' => 'f_year')) }}

                            {{-- </div>
                        </div> --}}
                        <div class="hr-line-dashed" style="display: none;" id="hr-template"></div>
                        <div class="form-group" id="seq_temp" style="display: none;"><label class="col-sm-2 control-label">Available Template</label>
                            <div class="col-sm-10" >
                                {{ Form::select('sequence_name', array('' => 'Select Template'), null, array('class' => 'form-control', 'id' => 'sequence_name', 'style'=>'display:none', 'required' => 'required')) }}
                                <div class="sk-spinner sk-spinner-wave" id="temp_loader" style="display: none;margin-top: -30px;">
                                    <div class="sk-rect1"></div>
                                    <div class="sk-rect2"></div>
                                    <div class="sk-rect3"></div>
                                    <div class="sk-rect4"></div>
                                    <div class="sk-rect5"></div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('sequence_desc', null, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="reset">Reset</button>
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