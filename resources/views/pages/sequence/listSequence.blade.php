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
                <strong>List of Sequences</strong>
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
                    <h5>List of Sequences Data Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Document Type</th>
                                    <th class="text-center">Sequence Number</th>
                                    <th class="text-center">Template</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doc_number as $key => $doc_numbers)
                                <?php
                                    $template = DB::table('doc_notemplates')->where('id', $doc_numbers->template_id)->first();

                                    $format_data = $template->format;
                                    $format_array      = explode('/', $format_data);
                                    $format_prefix     = $format_array[0];
                                    $format_div        = $format_array[1];
                                    $format_dept       = $format_array[2];
                                    $format_sec        = $format_array[3];
                                    $format_seq        = $format_array[4];
                                    $format_year       = $format_array[5];
                                    $format_postfix    = $format_array[6];

                                    $format = $format_prefix.'/'.$format_div.'/'.$format_dept.'/'.$format_sec.'/'.convert_sequence($doc_numbers->running_number).'/'.$format_year.'/'.$format_postfix;
                                ?>
                                <tr class="gradeX">
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $doc_numbers->document_name }}</td>
                                    <td class="text-center">{{ convert_sequence($doc_numbers->running_number) }}</td>
                                    @if(!empty($template))
                                    <td class="text-center">{{ $format }}</td>
                                    @else
                                    <td class="text-center"><span class="label label-danger"><i class="fa fa-trash"></i> Deleted</span></td>
                                    @endif
                                    @if($doc_numbers->status == 1)
                                    <td class="text-center"><span class="label label-success">Used</span></td>
                                    @elseif($doc_numbers->status == 2)
                                    <td class="text-center"><span class="label label-default">Generate</span></td>
                                    @else
                                    <td class="text-center"><span class="label label-danger">Unused</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('sequence.view', $doc_numbers->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                            <span class="label label-success"><i class="fa fa-desktop"></i></span>
                                        </a>
                                        <a href="{{ route('sequence.update', $doc_numbers->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <span class="label label-warning"><i class="fa fa-pencil"></i></span>
                                        </a>
                                        {{-- <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span class="label label-danger" data-toggle="modal" data-target="#delete-{{ $doc_numbers->id }}"><i class="fa fa-trash"></i></span>
                                        </a> --}}
                                    </td>
                                </tr>
                                {{-- Modal Delete Viewer --}}
                                {{-- <div class="modal inmodal" id="delete-{{ $doc_numbers->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated flipInY">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Delete Confirmation</h4>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>
                                                    <strong><h2>Are you sure?</h2></strong>
                                                </p>
                                                <p>
                                                    You will not be able to recover this record!
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                {{ Form::open(['method' => 'post', 'route' => array('section.delete', $doc_numbers->id)]) }}
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- End Modal Delete Viewer --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Document Type</th>
                                <th class="text-center">Sequence Number</th>
                                <th class="text-center">Template</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection