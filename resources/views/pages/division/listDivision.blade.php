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
            <li class="active">
                <strong>List of Divisions</strong>
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
                    <h5>List of Divisions Data Table</h5>
                    {{-- <div class="ibox-tools">
                        <a href="{{ route('division.new') }}">
                            <button type="button" class="btn btn-info btn-xs"><i class="fa fa-sitemap"></i> New Division</button>
                        </a>
                    </div> --}}
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Division Code</th>
                                    <th>Division Name</th>
                                    <th class="text-center">Division Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($division as $key => $divisions)
                                <tr class="gradeX">
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td class="text-center">{{ $divisions->division_code }}</td>
                                    <td>{{ $divisions->division_name }}</td>
                                    @if(!empty($divisions->status))
                                    <td class="text-center"><span data-toggle="tooltip" data-placement="top" title="Published" style="color: #1ab394; cursor:pointer;"><i class="fa fa-check"></i></span></td>
                                    @else
                                    <td class="text-center"><span data-toggle="tooltip" data-placement="top" title="Unpublished" style="color: #ed5565; cursor:pointer;"><i class="fa fa-times"></i></span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('division.view', $divisions->id) }}" data-toggle="tooltip" data-placement="top" title="View">
                                            <span class="label label-success"><i class="fa fa-desktop"></i></span>
                                        </a>
                                        <a href="{{ route('division.update', $divisions->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <span class="label label-warning"><i class="fa fa-pencil"></i></span>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span class="label label-danger" data-toggle="modal" data-target="#delete-{{ $divisions->id }}"><i class="fa fa-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Modal Delete Viewer --}}
                                <div class="modal inmodal" id="delete-{{ $divisions->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                {{ Form::open(['method' => 'post', 'route' => array('division.delete', $divisions->id)]) }}
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal Delete Viewer --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Division Code</th>
                                <th>Division Name</th>
                                <th class="text-center">Division Status</th>
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