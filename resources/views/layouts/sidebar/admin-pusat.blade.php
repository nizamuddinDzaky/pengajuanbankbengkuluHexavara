<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Main Menu</li>
    <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link {{ Request::is('admin-pusat') ? 'actived' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{route('admin.pusat.pengelolaan_nasabah')}}" class="nav-link {{ Request::is('admin-pusat/pengelolaan_nasabah') ? 'actived' : '' }} {{ Request::is('admin-pusat/pengelolaan_nasabah/*') ? 'actived' : '' }}" >
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Pengelolaan Nasabah
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.cabang') }}" class="nav-link {{ Request::is('admin-pusat/list_cabang') ? 'actived' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>
                Pengelolaan Cabang
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.pusat.cs') }}" class="nav-link {{ Request::is('admin-pusat/list_cs') ? 'actived' : '' }}">
        <i class="nav-icon fa fa-building"></i>
            <p>
                Pengelolaan CS
            </p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('admin.pusat.report') }}" class="nav-link {{ Request::is('admin-pusat/report') ? 'actived' : '' }}">
            <i class="nav-icon fa fa-file-alt"></i>
            <p>Report</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.produk_kredit') }}" class="nav-link {{ Request::is('admin-pusat/produk_kredit') ? 'actived' : '' }}">
            <i class="nav-icon fa fa-credit-card"></i>
            <p>Produk dan Akad Kredit</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.pusat.testimoni') }}" class="nav-link {{ Request::is('admin-pusat/testimoni') ? 'actived' : '' }} {{ Request::is('admin-pusat/testimoni/*') ? 'actived' : '' }}">
            <i class="nav-icon fa fa-comment"></i>
            <p>Testimoni</p>
        </a>
    </li>
</ul>
