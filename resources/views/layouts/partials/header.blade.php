<div class="container d-print-none ">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        @if ( auth()->user()->jabatan_id == '1')
                        <li><a href="{{ route('admin.dashboard.index')}}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('admin.sopir.index')}}"><i class="ti-user"></i> <span>Sopir</span></a></li>
                        <li><a href="{{ route('admin.tipe-gas.index')}}"><i class="ti-pin-alt"></i> <span>Tipe Gas</span></a></li>
                        <li><a href="{{ route('admin.gas.index')}}"><i class="ti-briefcase"></i> <span>Gas</span></a></li>
                        <li><a href="{{ route('admin.relasi.index')}}"><i class="ti-truck"></i> <span>Relasi</span></a></li>
                        <li><a href="{{ route('admin.laporan.index')}}"><i class="ti-receipt"></i> <span>Laporan</span></a></li>
                        <li><a href="{{ route('admin.searchbarcode.index')}}"><i class="ti-receipt"></i> <span>Cari Barcode</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '2')
                        <li><a href="{{ route('supir.scan.index')}}"><i class="ti-search"></i> <span>Scan Barcode</span></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        <!-- mobile_menu -->
        <div class="col-12 d-block d-lg-none">
            <div id="mobile_menu"></div>
        </div>
    </div>
</div>
<!-- header area end -->