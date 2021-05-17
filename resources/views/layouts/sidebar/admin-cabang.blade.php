<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Main Menu</li>
    <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link {{ Request::is('admin-cabang') ? 'actived' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cabang.cabang') }}" class="nav-link {{ Request::is('admin-cabang/list_cabang') ? 'actived' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>Pengelolaan Cabang</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.cabang.cs') }}" class="nav-link {{ Request::is('admin-cabang/list_cs') ? 'actived' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>Pengelolaan Customer Service</p>
        </a>
    </li>

    
</ul>