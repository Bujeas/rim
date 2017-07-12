@extends ('layouts.form')

@section ('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>User</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}">Home</a>
            </li>
            <li>
                <a>Management</a>
            </li>
            <li class="active">
                <strong>List of Users</strong>
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
                    <h5>List of Users Data Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Full Name</th>
                                    <th>Email Address</th>
                                    <th class="text-center">Groups</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $users)
                                <?php
                                	$role = DB::table('role_users')->join('roles', 'role_users.role_id', '=', 'roles.id')->select('roles.name')->where('role_users.user_id', $users->id)->first();
                                ?>
                                <tr class="gradeX">
                                    <td class="text-center">{{ $key+1 }}</td>
                                    <td>{{ $users->first_name }}</td>
                                    <td>{{ $users->email }}</td>

                                    @if(empty($role->name))
                                    <td>&nbsp;</td>
                                    @endif
                                    
                                    @if(!empty($role->name) && $role->name == 'Administrator')
                                    <td class="text-center"><span class="label label-danger">Administrator</span></td>
                                    @endif

                                    @if(!empty($role->name) && $role->name == 'Moderator')
                                    <td class="text-center"><span class="label label-success">Moderator</span></td>
                                    @endif

                                    @if(!empty($role->name) && $role->name == 'EndUser')
                                    <td class="text-center"><span class="label label-warning">End User</span></td>
                                    @endif

                                    @if($users->activated == 1)
                                    <td class="text-center">
                                    	<a href="#" data-toggle="tooltip" data-placement="top" title="Activated">
                                    		<span class="label label-primary"><i class="fa fa-check"></i></span>
                                    	</a>
                                    </td>
                                    @else
                                    <td class="text-center">
                                    	<a href="#" data-toggle="tooltip" data-placement="top" title="Deactivated">
                                    		<span class="label label-danger"><i class="fa fa-times" style="width: 10px;padding-left: 1px;"></i></span>
                                    	</a>
                                    </td>
                                    @endif
                                    <td class="text-center">
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="View">
                                            <span class="label label-success"><i class="fa fa-desktop"></i></span>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <span class="label label-warning"><i class="fa fa-pencil"></i></span>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <span class="label label-danger" data-toggle="modal" data-target="#delete-{{ $users->id }}"><i class="fa fa-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                                {{-- Modal Delete Viewer --}}
                                <div class="modal inmodal" id="delete-{{ $users->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                {{-- {{ Form::open(['method' => 'post', 'route' => array('template.delete', $templates->id)]) }} --}}
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                {{-- {{ Form::close() }} --}}
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
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th class="text-center">Groups</th>
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