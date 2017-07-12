<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> 
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('/img/ron.jpg') }}" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                            <?php
                                $id = Session::get('user.id');
                                $groupid = Session::get('group.id');
                                $user = Sentinel::findById($id);
                            ?>
                            <span class="block m-t-xs"> 
                                <strong class="font-bold"> {{ $user->first_name }}</strong>
                            </span> 
                            <span class="text-muted text-xs block"> 
                                <?php
                                    $groupid = Session::get('group.id');
                                    if($groupid == 1)
                                    {
                                        $group = 'Administrator'; //Administrator
                                    }elseif($groupid == 2){
                                        $group = 'Moderator'; //Moderator
                                    }else{
                                        $group = 'End User'; //End User
                                    }
                                ?>
                                {{ $group }}
                                <b class="caret"></b>
                            </span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        {{-- <li><a href="mailbox.html">Mailbox</a></li> --}}
                        <li class="divider"></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    RIM
                </div>
            </li>
            @if($groupid != 3)
            <li class="{{ set_active(['/']) }}">
                <a href="{{ route('home') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>
            @else
            <li class="{{ set_active(['dashboard']) }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
            </li>
            @endif

            @if($groupid == 1)
            <li class="{{ set_active(['group', 'group/*']) }}">
                <a href="#"><i class="fa fa-user"></i> <span class="nav-label">User</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['group.list']) }}">
                        <a href="{{ route('group.list') }}">User List</a>
                    </li>
                    <li class="{{ set_active(['group.assign']) }}">
                        <a href="{{ route('group.assign') }}">User Access Control</a>
                    </li>
                </ul>
            </li>
            @endif

            @if($groupid != 3)
            <li class="{{ set_active(['division', 'division/*']) }}">
                <a href="#"><i class="fa fa-building-o"></i> <span class="nav-label">Division</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['division/new']) }}">
                        <a href="{{ route('division.new') }}">New Division</a>
                    </li>
                    <li class="{{ set_active(['division']) }}">
                        <a href="{{ route('division') }}">List of Divisions</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['department', 'department/*']) }}">
                <a href="#"><i class="fa fa-institution"></i> <span class="nav-label">Department</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['department/new']) }}">
                        <a href="{{ route('department.new') }}">New Department</a>
                    </li>
                    <li class="{{ set_active(['department']) }}">
                        <a href="{{ route('department') }}">List of Departments</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['section', 'section/*']) }}">
                <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Section</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['section/new']) }}">
                        <a href="{{ route('section.new') }}">New Section</a>
                    </li>
                    <li class="{{ set_active(['section']) }}">
                        <a href="{{ route('section') }}">List of Sections</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['unit', 'unit/*']) }}">
                <a href="#"><i class="fa fa-th-list"></i> <span class="nav-label">Unit</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['unit/new']) }}">
                        <a href="{{ route('unit.new') }}">New Unit</a>
                    </li>
                    <li class="{{ set_active(['unit']) }}">
                        <a href="{{ route('unit') }}">List of Units</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['subunit', 'subunit/*']) }}">
                <a href="#"><i class="fa fa-th"></i> <span class="nav-label">Sub Unit</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['subunit/new']) }}">
                        <a href="{{ route('subunit.new') }}">New Sub Unit</a>
                    </li>
                    <li class="{{ set_active(['subunit']) }}">
                        <a href="{{ route('subunit') }}">List of Sub Units</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['document', 'document/*']) }}">
                <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Document</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['document/new']) }}">
                        <a href="{{ route('document.new') }}">New Document</a>
                    </li>
                    <li class="{{ set_active(['document']) }}">
                        <a href="{{ route('document') }}">List of Documents</a>
                    </li>
                </ul>
            </li>
            <li class="{{ set_active(['template', 'template/*']) }}">
                <a href="#"><i class="fa fa-archive"></i> <span class="nav-label">Template</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['template/new']) }}">
                        <a href="{{ route('template.new') }}">New Template</a>
                    </li>
                    <li class="{{ set_active(['template']) }}">
                        <a href="{{ route('template') }}">List of Templates</a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="{{ set_active(['sequence', 'sequence/*']) }}">
                <a href="#"><i class="fa fa-sort-numeric-asc"></i> <span class="nav-label">Sequence</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ set_active(['sequence/new']) }}">
                        <a href="{{ route('sequence.new') }}">New Sequence</a>
                    </li>
                    <li class="{{ set_active(['sequence']) }}">
                        <a href="{{ route('sequence') }}">List of Sequences</a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="#"><i class="fa fa-paper-plane"></i> <span class="nav-label">Notification</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="#">Settings</a></li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Report</span></a>
            </li> --}}
        </ul>

    </div>
</nav>