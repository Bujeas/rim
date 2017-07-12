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
            <li>
                <a href="{{ route('sequence') }}">List of Sequence</a>
            </li>
            <li class="active">
                <strong>Sequence Details</strong>
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
                    <h5>Sequence Details Form</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal">
                    	<div class="form-group"><label class="col-sm-2 control-label">Document Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $doc_number->document_name }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sequence Number</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ convert_sequence($doc_number->running_number) }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Template Name</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $doc_number->temp_name }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Format Created</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $format }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Created By</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ $doc_number->first_name }}</span>
                            </div>
                        </div><div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Date Created</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ stampToPicker($doc_number->created_at) }}</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection