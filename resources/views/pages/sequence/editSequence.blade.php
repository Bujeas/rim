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
                <strong>Edit Sequence</strong>
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
                    <h5>Edit Sequence Form</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open(array('route' => array('sequence.update.put', $id), 'method' => 'put', 'class' => 'form-horizontal', 'id' => 'form')) }}
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
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Date Created</label>
                            <div class="col-sm-10">
                                <span class="form-control" style="border-style: none;">{{ stampToPicker($doc_number->created_at) }}</span>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Action</label>
                            <div class="col-sm-10">
                                {{ Form::select('sequence_action', $action, $doc_number->status, array('id' => 'sequence_action', 'class' => 'form-control', 'required' => 'required')) }}
                            </div>
                        </div>
                        {{-- <div class="hr-line-dashed" id="line-seq-date"></div>
                        <div class="form-group" id="data_1"><label class="col-sm-2 control-label">Date Used</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    {{ Form::text('sequence_date_action', '', array('id' => 'date_action', 'class' => 'form-control')) }}
                                </div>
                            </div>
                        </div> --}}
                        <div class="hr-line-dashed" id="line-seq-remarks"></div>
                        <div class="form-group" id="data_2"><label class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                                {{ Form::textarea('sequence_remarks', null, ['id' => 'sequence_remarks', 'class' => 'form-control', 'style' => 'resize:none', 'required' => 'required']) }}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a href="{{ route('sequence') }}" class="btn btn-white">Cancel</a>
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