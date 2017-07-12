@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Section</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li>
                <a href="{{ route('section') }}">List of Sections</a>
            </li>
            <li class="active">
                <strong>Edit Section</strong>
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
                    <h5>Edit Section Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('section.update.put', $id), 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'form')) }}
                        {{-- <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('division', $division, $division_id, array('class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div> --}}
                        {{-- <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                {{ Form::select('department', $department, $department_id, array('class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div> 
                        {{ Form::hidden('department_id', $department_id) }}
                        <div class="hr-line-dashed"></div>--}}
                        <div class="form-group"><label class="col-sm-2 control-label">Section Code</label>
                            <div class="col-sm-10">
                                {{ Form::text('section_code', $section->section_code, array('id' => 'section_code', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Section Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('section_name', $section->section_name, array('id' => 'section_name', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('section_description', $section->description, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"> 
                                <div class="onoffswitch" style="margin-left: -18px;">
                                        {{ Form::checkbox('section_status', 1, $section->status, ['class' => 'onoffswitch-checkbox', 'id' => 'dept_status']) }}
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
                                <a href="{{ route('section') }}" class="btn btn-white">Cancel</a>
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