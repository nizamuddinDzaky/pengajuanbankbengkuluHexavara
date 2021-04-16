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
        <a href="{{ route('admin.pusat.cabang') }}" class="nav-link {{ Request::is('admin-pusat/list_cabang') ? 'active' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>Cs dan Cabang</p>
        </a>
    </li>
</ul>