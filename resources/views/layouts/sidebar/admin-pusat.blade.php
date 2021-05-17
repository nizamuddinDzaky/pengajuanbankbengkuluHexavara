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
        <a href="{{route('admin.pusat.pengelolaan_nasabah')}}" class="nav-link {{ Request::is('admin-pusat/pengelolaan_nasabah') ? 'active' : '' }} {{ Request::is('admin-pusat/pengelolaan_nasabah/*') ? 'active' : '' }}" >
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Pengelolaan Nasabah
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.cabang') }}" class="nav-link {{ Request::is('admin-pusat/list_cabang') ? 'active' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>Cs dan Cabang</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.report') }}" class="nav-link {{ Request::is('admin-pusat/report') ? 'active' : '' }}">
            <i class="nav-icon fa fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.produk_kredit') }}" class="nav-link {{ Request::is('admin-pusat/produk_kredit') ? 'active' : '' }}">
            <i class="nav-icon fa fa-credit-card"></i>
            <p>Produk dan Akad Kredit</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.testimoni') }}" class="nav-link {{ Request::is('admin-pusat/testimoni') ? 'active' : '' }} {{ Request::is('admin-pusat/testimoni/*') ? 'active' : '' }}">
            <i class="nav-icon fa fa-comment"></i>
            <p>Testimoni</p>
        </a>
    </li>
</ul>
