<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-header">Main Menu</li>
                <li class="nav-item">
                    @if(Request::is('/'))
                        <a href="{{url('/')}}" class="nav-link active">
                            @else
                                <a href="{{url('/')}}" class="nav-link">
                                    @endif
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>

                </li>


                <li class="nav-item ">
                    @if(Request::is('user'))
                        <a href="{{url('user')}}" class="nav-link active">
                            @else
                                <a href="{{url('user')}}" class="nav-link">
                                    @endif
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                        </a>
                </li>



                <li class="nav-item has-treeview">
                    @if(Request::is('manajemenpengguna'))
                        <a href="{{url('manajemenpengguna')}}" class="nav-link active">
                            @else
                                <a href="{{url('manajemenpengguna')}}" class="nav-link">
                                    @endif
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Some Menu
                                    </p>
                                </a>

                </li>

                <li class="nav-item has-treeview">
                    @if(Request::is('manajemenrole'))
                        <a href="{{url('manajemenrole')}}" class="nav-link active">
                            @else
                                <a href="{{url('manajemenrole')}}" class="nav-link">
                                    @endif
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>
                                        Some Menu
                                    </p>
                                </a>

                </li>


            </ul>