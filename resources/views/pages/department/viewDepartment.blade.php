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
                <a href="{{ route('department') }}">List of Departments</a>
            </li>
            <li class="active">
                <strong>Departments Details</strong>
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
                    <h5>Department Details Form</h5>
                </div>
                <div class="ibox-content">
                	<form class="form-horizontal">
                        {{-- <div class="form-group"><label class="col-sm-2 control-label">Division Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $divisions->division_name }}</span>
                            </div>
                        </div> 
                        <div class="hr-line-dashed"></div>--}}
	                    <div class="form-group"><label class="col-sm-2 control-label">Department Code</label>
	                        <div class="col-sm-10">
	                            <span class="form-control" style="border-style: none;">{{ $departments->dept_code }}</span>
	                        </div>
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    <div class="form-group"><label class="col-sm-2 control-label">Department Name</label>
	                        <div class="col-sm-10">
	                            <span class="form-control" style="border-style: none;">{{ $departments->dept_name }}</span>
	                        </div>
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    <div class="form-group"><label class="col-sm-2 control-label">Description</label>
	                        <div class="col-sm-10">
	                            <span class="form-control" style="border-style: none;">{{ $departments->description }}</span>
	                        </div>
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    <div class="form-group"><label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-10">
	                        	@if($departments->status == 1)
	                            <span class="form-control" style="border-style: none;">Published</span>
	                            @else
	                            <span class="form-control" style="border-style: none;">Unpublished</span>
	                            @endif
	                        </div>
	                    </div>
	                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection