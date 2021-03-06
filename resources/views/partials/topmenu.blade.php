<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    <form role="search" class="navbar-form-custom" action="search_results.html">
        <div class="form-group">
            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
        </div>
    </form>
</div>
    <ul class="nav navbar-top-links navbar-right">
        <?php 
            $id = Session::get('user.id');
            $groupid = Session::get('group.id');
            $user = Sentinel::findById($id);
            $acc_ttl = DB::table('users')->where('activated', 0)->get();
        ?>
        <li>
            <span class="m-r-sm text-muted welcome-message">Welcome to RIM {{ $user->first_name }}</span>
        </li>
        @if($groupid != 3)
        <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i>  <span class="label label-warning">{{ count($acc_ttl) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-messages" style="overflow-y:scroll; height:210px;">
                @foreach($acc_ttl as $account)
                <li>
                    <div class="dropdown-messages-box">
                        <a href="#" class="pull-left">
                            <img alt="image" class="img-circle" src="img/new_user.jpg">
                        </a>
                        <div>
                            {{-- <small class="pull-right text-navy"><i class="fa fa-lock" style="font-size: medium; color: #ed5565;"></i></small> --}}
                            <strong>{{ $account->first_name }}</strong> <br> {{ $account->staff_id }} <br>
                            <small class="text-muted">Created at : {{ stampToTime($account->created_at) }} - {{ stampToPicker($account->created_at) }}</small>
                        </div>
                    </div>
                </li>
                <li class="divider"></li>
                @endforeach
                {{-- <li>
                    <div class="dropdown-messages-box">
                        <a href="profile.html" class="pull-left">
                            <img alt="image" class="img-circle" src="img/profile.jpg">
                        </a>
                        <div>
                            <small class="pull-right">23h ago</small>
                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                        </div>
                    </div>
                </li>
                <li class="divider"></li> --}}
                <li>
                    <div class="text-center link-block">
                        <a href="{{ route('group.list') }}">
                            <i class="fa fa-envelope"></i> <strong>See All Applicants</strong>
                        </a>
                    </div>
                </li>
            </ul>
        </li>
        @endif
        {{-- <li class="dropdown">
            <a href="{{ route('locked') }}">
                <i class="fa fa-lock" style="font-size: medium;"></i>
            </a>
        </li> --}}
        {{-- <li class="dropdown">
            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                 <li>
                    <a href="profile.html">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="grid_options.html">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="text-center link-block">
                        <a href="notifications.html">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </li> 
            </ul>
        </li> --}}
        <li>
            <a href="{{ route('logout') }}">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
        @if($groupid != 3)
        <li>
            <a class="right-sidebar-toggle">
                <i class="fa fa-tasks"></i>
            </a>
        </li>
        @endif
    </ul>

</nav>
</div>