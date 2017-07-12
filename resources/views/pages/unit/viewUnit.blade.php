@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Unit</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li>
                <a href="{{ route('unit') }}">List of Units</a>
            </li>
            <li class="active">
                <strong>Unit Details</strong>
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
                    <h5>Unit Details Form</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                        <div class="form-group"><label class="col-sm-2 control-label">Unit Code</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $units->unit_code }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Unit Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $units->unit_name }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $units->description }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Status</label>
	                        <div class="col-sm-10">
	                        	@if($units->status == 1)
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