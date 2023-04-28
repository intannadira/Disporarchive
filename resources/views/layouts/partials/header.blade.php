<div class="container d-print-none ">
    <div class="row align-items-center">
        <div class="col-lg-9 d-none d-lg-block">
            <div class="horizontal-menu ml-md-2">
                <nav>
                    <ul id="nav_menu">
                        @if ( auth()->user()->jabatan_id == '1')
                        <li>
                            <li class="active"><a href="{{ route('superadmin.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                            <li>
                                <a href="javascript:void(0)"><i class="ti-dashboard"></i><span>Master Data</span></a>
                                <ul class="submenu">
                                    <li><a href="{{ route('superadmin.hakakses.index')}}"><i class="ti-user"></i> <span>Pengguna</span></a></li>
                                    <li><a href="{{ route('superadmin.jabatan.index')}}"><i class="ti-user"></i> <span>Jabatan</span></a></li>
                                    <li><a href="{{ route('superadmin.karyawan.index')}}"><i class="ti-pin-alt"></i> <span>Karyawan</span></a></li>
                                </ul>
                            </li>   
                            <li><a href="{{ route('superadmin.suratmasuk.index')}}"><i class="ti-user"></i> <span>Surat Masuk</span></a></li>
                            <li><a href="{{ route('superadmin.hakakses.index')}}"><i class="ti-user"></i> <span>Surat Keluar</span></a></li>
                            <li><a href="{{ route('superadmin.hakakses.index')}}"><i class="ti-user"></i> <span>Histori Surat</span></a></li>
                        </li>      
            
                        @endif
                        @if ( auth()->user()->jabatan_id == '2')
                            <li class="active"><a href="{{ route('admin1.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{ route('admin1.suratmasukadmin1.index')}}"><i class="ti-user"></i> <span>Surat Masuk</span></a></li>
                            <li><a href="{{ route('admin1.suratmasukadmin1.index')}}"><i class="ti-user"></i> <span>Histori Surat</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '3')
                        <li class="active"><a href="{{ route('admin2.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('admin2.suratmasukadmin2.index')}}"><i class="ti-user"></i> <span>Surat Masuk</span></a></li>
                        <li><a href="{{ route('admin2.suratmasukadmin2.index')}}"><i class="ti-user"></i> <span>Histori Surat</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '4')
                        <li><a href="{{ route('supir.scan.index')}}"><i class="ti-search"></i> <span>Scan Barcode</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '5')
                        <li><a href="{{ route('supir.scan.index')}}"><i class="ti-search"></i> <span>Scan Barcode</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '6')
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