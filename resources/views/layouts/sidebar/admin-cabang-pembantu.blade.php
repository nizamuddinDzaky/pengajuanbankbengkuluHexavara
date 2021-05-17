<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Main Menu</li>
    <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link {{ Request::is('admin-pusat') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.cabang_pembantu.pengelolaan_nasabah')}}" class="nav-link {{ Request::is('admin-cabang-pembantu/pengelolaan_nasabah') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Pengelolaan Nasabah
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cabang.cabang') }}" class="nav-link {{ Request::is('admin-cabang/list_cabang') ? 'active' : '' }}">
            <i class="nav-icon fa fa-building"></i>
            <p>Capem dan CS</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cabang_pembantu.report') }}" class="nav-link {{ Request::is('admin-cabang-pembantu/report') ? 'active' : '' }}">
            <i class="nav-icon fa fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.cabang_pembantu.testimoni') }}" class="nav-link {{ Request::is('admin-cabang_pembantu/testimoni') ? 'active' : '' }} {{ Request::is('admin-cabang-pembantu/testimoni/*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-comment"></i>
            <p>Testimoni</p>
        </a>
    </li>
</ul>
