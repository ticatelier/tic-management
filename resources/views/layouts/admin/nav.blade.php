
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                <ul class="list-inline-item list-unstyled links">
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-dashcube"></i> <span> Analytics</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.analytics.monthly') }}">Monthly Attendance</a></li>
                            <li><a href="{{ route('admin.analytics.servicenote.form') }}">Service Notes</a></li>
                            <li><a href="{{ route('admin.analytics.servicenote.today') }}">Today's Service Notes</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Clients</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Clients</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.users.index') }}">All Clients</a></li>
                            <li><a href="{{ route('admin.users.create') }}">Add Client</a></li>
                            <li><a href="{{ route('admin.users.subscription') }}">Clients Subcriptions</a></li>
                            <li><a href="{{ route('admin.users.expiring') }}">Expiring POS number</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Trainers</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Trainers</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.trainer.index') }}">All Trainers</a></li>
                            <li><a href="{{ route('admin.trainer.create') }}">Add Trainer</a></li>
                            <li><a href="{{ route('admin.trainer.assign') }}">Assign Trainers</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Services</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Services</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.service.index') }}">All Services</a></li>
                            <li><a href="{{ route('admin.service.create') }}">Add Service</a></li>
                            <li><a href="{{ route('admin.service.option') }}">Service Options</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Administrators</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Administrators</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.administrators.index') }}">All Administrators</a></li>
                            <li><a href="{{ route('admin.administrators.create') }}">Add Administrator</a></li>
                            <li><a href="{{ url('roles') }}">Roles</a></li>
                            <li><a href="{{ url('permissions') }}">Permissions</a></li>
                        </ul>
                    </li>

                </ul>

            </nav>
            <ul class="sidebar-vertical">
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-dashcube"></i> <span> Analytics</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.analytics.monthly') }}">Monthly Attendance</a></li>
                        <li><a href="{{ route('admin.analytics.servicenote.form') }}">Service Notes</a></li>
                        <li><a href="{{ route('admin.analytics.servicenote.today') }}">Today's Service Notes</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Clients</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Clients</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.users.index') }}">All Clients</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Add Client</a></li>
                        <li><a href="{{ route('admin.users.subscription') }}">Clients Subcriptions</a></li>
                        <li><a href="{{ route('admin.users.expiring') }}">Expiring POS number</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Trainers</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Trainers</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.trainer.index') }}">All Trainers</a></li>
                        <li><a href="{{ route('admin.trainer.create') }}">Add Trainer</a></li>
                        <li><a href="{{ route('admin.trainer.assign') }}">Assign Trainers</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Services</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Services</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.service.index') }}">All Services</a></li>
                        <li><a href="{{ route('admin.service.create') }}">Add Service</a></li>
                        <li><a href="{{ route('admin.service.option') }}">Service Options</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Administrators</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Administrators</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.administrators.index') }}">All Administrators</a></li>
                        <li><a href="{{ route('admin.administrators.create') }}">Add Administrator</a></li>
                        <li><a href="{{ url('roles') }}">Roles</a></li>
                    <li><a href="{{ url('permissions') }}">Permissions</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
