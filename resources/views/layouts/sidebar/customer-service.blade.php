<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">Main Menu</li>
    <li class="nav-item">
        <a href="{{url('/')}}" class="nav-link {{ Request::is('customer-service') ? 'active' : '' }}">
            <i class="nav-icon fas fa-calendar"></i>
            <p>
                Jadwal
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('customer_service.pelayanan_nasabah') }}" class="nav-link {{ Request::is('customer-service/pelayanan_nasabah') ? 'active' : '' }}">
            <i class="nav-icon fa fa-users"></i>
            <p>Pelayanan Nasabah</p>
        </a>
    </li>
</ul>
