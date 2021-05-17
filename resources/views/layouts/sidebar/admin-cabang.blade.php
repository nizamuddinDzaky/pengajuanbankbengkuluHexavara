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
        <a href="{{route('admin.cabang.pengelolaan_nasabah')}}" class="nav-link {{ Request::is('admin-cabang/pengelolaan_nasabah') ? 'actived' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Pengelolaan Nasabah
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
    <li class="nav-item">
        <a href="{{ route('admin.cabang.report') }}" class="nav-link {{ Request::is('admin-cabang/report') ? 'actived' : '' }}">
            <i class="nav-icon fa fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cabang.testimoni') }}" class="nav-link {{ Request::is('admin-cabang/testimoni') ? 'actived' : '' }} {{ Request::is('admin-cabang/testimoni/*') ? 'actived' : '' }}">
            <i class="nav-icon fa fa-comment"></i>
            <p>Testimoni</p>
        </a>
    </li>
</ul>
