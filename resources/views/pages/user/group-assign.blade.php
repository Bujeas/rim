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
                <a>User</a>
            </li>
            <li class="active">
                <strong>User Access Control</strong>
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
                    <h5>List of Assign Groups Data Table</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Route Name</th>
                                    <th>Route Path</th>
                                    @foreach ($groups as $key => $group)
						          	<th class="text-center">
						          		{{ $group->name }}
						          	</th>
						          	@endforeach
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $k = 1; ?>
                                @foreach ($routes as $route)
                                @if(!str_contains($route->getName(), ['auth', 'debugbar', '_api', 'login', 'logout', 'register', 'home', 'locked']) && !str_contains($route->uri(), ['api']))
                                <tr class="gradeX">
                                    <td class="text-center">{{ $k++ }}</td>
                                    <td>{{ $route->getName() }}</td>
                                    <td>{{ $route->uri() }}</td>
                                    @foreach ($groups as $group)
                                    <td class="text-center">
						          		@if (in_array($route->getName(), $permits[$group->name]))
                                            {{-- <a href="{{ route('group.assign.post', strtolower($group->name).'_'.$route->getName().'_pop') }}" data-toggle="tooltip" data-placement="top" title="Disable">
                                                <span class="label label-primary"><i class="fa fa-check"></i></span>
                                            </a> --}}

                                            <a data-toggle="tooltip" data-placement="top" title="Disable" id="toggled-{{ $k }}-{{ strtolower($group->name) }}">
                                                <span class="label label-primary"><i class="fa fa-check"></i></span>
                                            </a>

                                            <a data-toggle="tooltip" data-placement="top" title="Enable" id="toggled-push-{{ $k }}-{{ strtolower($group->name) }}" style="display: none;">
                                                <span class="label label-danger"><i class="fa fa-times" style="width: 10px;"></i></span>
                                            </a>

                                            <span id="url_pop_{{ $k }}" style="display: none;">{{ '_'.$route->getName().'_pop' }}</span>
                                            <span id="url_push_{{ $k }}" style="display: none;">{{ '_'.$route->getName().'_push' }}</span>
                                            
                                            <div class="sk-spinner sk-spinner-fading-circle" id="spinner-pop-{{ $k }}-{{ strtolower($group->name) }}" style="display: none;">
                                                <div class="sk-circle1 sk-circle"></div>
                                                <div class="sk-circle2 sk-circle"></div>
                                                <div class="sk-circle3 sk-circle"></div>
                                                <div class="sk-circle4 sk-circle"></div>
                                                <div class="sk-circle5 sk-circle"></div>
                                                <div class="sk-circle6 sk-circle"></div>
                                                <div class="sk-circle7 sk-circle"></div>
                                                <div class="sk-circle8 sk-circle"></div>
                                                <div class="sk-circle9 sk-circle"></div>
                                                <div class="sk-circle10 sk-circle"></div>
                                                <div class="sk-circle11 sk-circle"></div>
                                                <div class="sk-circle12 sk-circle"></div>
                                            </div>

					                    @else
					                    	{{-- <a href="{{ route('group.assign.post', strtolower($group->name).'_'.$route->getName().'_push') }}" data-toggle="tooltip" data-placement="top" title="Enable">
	                                            <span class="label label-danger"><i class="fa fa-times"></i></span>
	                                        </a> --}}

                                            <a data-toggle="tooltip" data-placement="top" title="Enable" id="push-{{ $k }}-{{ strtolower($group->name) }}">
                                                <span class="label label-danger"><i class="fa fa-times" style="width: 10px;"></i></span>
                                            </a>

                                            <a data-toggle="tooltip" data-placement="top" title="Disable" id="pop-toggled-{{ $k }}-{{ strtolower($group->name) }}" style="display: none;">
                                                <span class="label label-primary"><i class="fa fa-check"></i></span>
                                            </a>

                                            <span id="push_url_{{ $k }}" style="display: none;">{{ '_'.$route->getName().'_push' }}</span>
                                            <span id="pop_url_{{ $k }}" style="display: none;">{{ '_'.$route->getName().'_pop' }}</span>

                                            <div class="sk-spinner sk-spinner-fading-circle" id="spinner-push-{{ $k }}-{{ strtolower($group->name) }}" style="display: none;">
                                                <div class="sk-circle1 sk-circle"></div>
                                                <div class="sk-circle2 sk-circle"></div>
                                                <div class="sk-circle3 sk-circle"></div>
                                                <div class="sk-circle4 sk-circle"></div>
                                                <div class="sk-circle5 sk-circle"></div>
                                                <div class="sk-circle6 sk-circle"></div>
                                                <div class="sk-circle7 sk-circle"></div>
                                                <div class="sk-circle8 sk-circle"></div>
                                                <div class="sk-circle9 sk-circle"></div>
                                                <div class="sk-circle10 sk-circle"></div>
                                                <div class="sk-circle11 sk-circle"></div>
                                                <div class="sk-circle12 sk-circle"></div>
                                            </div>
					                    @endif
						          	</td>
						          	@endforeach
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Route Name</th>
                                <th>Route Path</th>
                                @foreach ($groups as $key => $group)
					          	<th class="text-center">
					          		{{ $group->name }}
					          	</th>
					          	@endforeach
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