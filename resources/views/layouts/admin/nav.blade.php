
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
                            <li><a href="{{ route('admin.analytics.monthly') }}" class="active">Monthly Attendance</a></li>
                            <li><a href="">Employee Dashboard</a></li>
                            <li><a href="">Deals Dashboard</a></li>
                            <li><a href="">Leads Dashboard</a></li>
                        </ul>
                    </li>

                    <li class="menu-title">
                        <span>Users</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Users</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
                            <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                            <li><a href="{{ route('admin.users.subscription') }}">Users Subcriptions</a></li>
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
                            <li><a href="">Administrators' Permissions</a></li>
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
                        <li><a href="{{ route('admin.analytics.monthly') }}" class="active">Monthly Attendance</a></li>
                        <li><a href="">Employee Dashboard</a></li>
                        <li><a href="">Deals Dashboard</a></li>
                        <li><a href="">Leads Dashboard</a></li>
                    </ul>
                </li>

                <li class="menu-title">
                    <span>Users</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Users</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                        <li><a href="{{ route('admin.users.subscription') }}">Users Subcriptions</a></li>
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
                        <li><a href="">Administrators' Permissions</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
