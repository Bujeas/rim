@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Division</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li>
                <a href="{{ route('division') }}">List of Divisions</a>
            </li>
            <li class="active">
                <strong>Edit Division</strong>
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
                    <h5>Edit Division Form</h5>
                </div>
                <div class="ibox-content">
                	{{ Form::open(array('route' => array('division.update.put', $id), 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'form')) }}
                        <div class="form-group"><label class="col-sm-2 control-label">Division Code</label>
                            <div class="col-sm-10">
                                {{ Form::text('div_code', $divisions->division_code, array('id' => 'div_code', 'class' => 'form-control')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                {{ Form::text('div_name', $divisions->division_name, array('id' => 'div_name', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('div_description', $divisions->description, ['class' => 'form-control', 'style' => 'resize:none']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <label class="checkbox-inline"> 
                                <div class="onoffswitch" style="margin-left: -18px;">
                                        {{ Form::checkbox('div_status', 1, $divisions->status, ['class' => 'onoffswitch-checkbox', 'id' => 'div_status']) }}
                                        <label class="onoffswitch-label" for="div_status">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('division') }}" class="btn btn-white">Cancel</a>
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