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
            <li>
                <a href="{{ route('template') }}">List of Templates</a>
            </li>
            <li class="active">
                <strong>Template Details</strong>
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
                    <h5>Template Details Form</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                    	<div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $temp_name }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Code</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $temp_code }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Prefix Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $temp_prefix }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $divisions }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $departments }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Section Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $sections }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Unit Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $units }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sub Unit Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $subunits }}</span>
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Document Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $documents }}</span>
                            </div>
                        </div> --}}
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Postfix Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $temp_postfix }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Format</label>
                            <div class="col-sm-10">
                            	<span class="form-control" style="border-style: none;">{{ $temp_format }}</span>
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Status</label>
                            <div class="col-sm-10">
                                @if(!empty($temp_cat_id))
                                <span class="form-control" style="border-style: none;">Complete</span>
                                @else
                                <span class="form-control" style="border-style: none;">Incomplete</span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $temp_desc }}</span>
                            </div>
                        </div>
                        <!-- <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('template') }}" class="btn btn-primary" style="margin-left: 10px;">OK</a>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection