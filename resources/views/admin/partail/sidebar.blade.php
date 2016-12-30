<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="logo-lg" style="margin: 5% auto;width: 60%">
            <img class="img-responsive" src="{{asset('images/logo.png')}}" alt="inform me logo">
        </div>

        <!-- search form (Optional) -->

        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <!-- Optionally, you can add icons to the links -->
            <li><a href="#"><i class="fa fa-map"></i> <span>Map</span></a></li>
            <li class=""><a href="#"><i class="fa fa-info-circle"></i> <span>Egypt</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-flag"></i> <span>View</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('governorates')}}">All Governorates</a></li>
                    <li><a href="{{url('cities')}}">All cities</a></li>
                    <li><a href="{{url('divisions')}}">All division</a></li>
                    <li><a href="{{url('units')}}">All units</a></li>
                    <li><a href="{{url('loctations')}}">All locations</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-edit"></i> <span>Manage</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('governorates/create')}}">Governorates</a></li>
                    <li><a href="{{url('cities/create')}}">Cities</a></li>
                    <li><a href="{{url('divisions/create')}}">Divisions</a></li>
                    <li><a href="{{url('units/create')}}">Units</a></li>
                    <li><a href="{{url('locations/create')}}">Locations</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-building"></i> <span>Centers</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('centers')}}">view all</a></li>
                    <li><a href="{{url('centers/create')}}">Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-map-marker"></i> <span>Places</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('places')}}">view all</a></li>
                    <li><a href="{{url('places/create')}}">Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Persons</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('events')}}">view all</a></li>
                    <li><a href="{{url('events/create')}}">Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i><span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('users')}}">view all</a></li>
                    <li><a href="{{url('users/create')}}">Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-comment"></i><span>Articles</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('articles')}}">view all</a></li>
                    <li><a href="{{url('articles/create')}}">Add new</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-image"></i><span>Images</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('photos')}}">view all</a></li>
                    <li><a href="{{url('photos/create')}}">Add new</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>