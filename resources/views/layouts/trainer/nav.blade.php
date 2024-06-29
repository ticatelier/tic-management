
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <nav class="greedys sidebar-horizantal">
                <ul class="list-inline-item list-unstyled links">
                    <li class="menu-title">
                        <span>My Clients</span>
                    </li>
                    <li class="submenu">
                        <a href="#" class="noti-dot"><i class="la la-user"></i> <span>My Clients</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('trainer.clients.index') }}">My Clients</a></li>
                            <li><a href="{{ route('admin.users.create') }}">Client History</a></li>
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


                </ul>

            </nav>
            <ul class="sidebar-vertical">

                <li class="menu-title">
                    <span>My Clients</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span>My Clients</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('trainer.clients.index') }}">My Clients</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Client History</a></li>
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



            </ul>
        </div>
    </div>
</div>
