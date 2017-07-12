@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Department</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li class="active">
                <strong>New Department</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>New Department Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('department.new.post'), 'class' => 'form-horizontal', 'id' => 'form')) }}
                        {{-- <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('division', $division, '', array('class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div> --}}
                        <div class="form-group"><label class="col-sm-2 control-label">Department Code</label>
                            <div class="col-sm-10">
                                {{ Form::text('dept_code', '', array('id' => 'dept_code', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('dept_name', '', array('id' => 'dept_name', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('dept_description', null, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"> 
                                <div class="onoffswitch" style="margin-left: -18px;">
                                        {{ Form::checkbox('dept_status', 1, null, ['class' => 'onoffswitch-checkbox', 'id' => 'dept_status']) }}
                                        <label class="onoffswitch-label" for="dept_status">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
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