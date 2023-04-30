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
                                    <li><a href="{{ route('superadmin.karyawan.index')}}"><i class="ti-user"></i> <span>Karyawan</span></a></li>
                                </ul>
                            </li>   
                            <li><a href="{{ route('superadmin.suratmasuk.index')}}"><i class="ti-share"></i> <span>Surat Masuk</span></a></li>
                            <li><a href="{{ route('superadmin.suratkeluar.index')}}"><i class="ti-share-alt"></i> <span>Surat Keluar</span></a></li>
                            <li><a href="{{ route('superadmin.historisurat.index')}}"><i class="ti-archive"></i> <span>Histori Surat</span></a></li>
                        </li>      
            
                        @endif
                        @if ( auth()->user()->jabatan_id == '2')
                            <li class="active"><a href="{{ route('admin1.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                            <li><a href="{{ route('admin1.suratmasukadmin1.index')}}"><i class="ti-agenda"></i> <span>Surat Masuk</span></a></li>
                            <li><a href="{{ route('admin1.historisuratadmin1.index')}}"><i class="ti-user"></i> <span>Histori Surat</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '3')
                        <li class="active"><a href="{{ route('admin2.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('admin2.suratmasukadmin2.index')}}"><i class="ti-agenda"></i> <span>Surat Masuk</span></a></li>
                        <li><a href="{{ route('admin2.historisuratadmin2.index')}}"><i class="ti-archive"></i> <span>Histori Surat</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '4')
                        <li class="active"><a href="{{ route('admin3.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('admin3.suratmasukadmin3.index')}}"><i class="ti-agenda"></i> <span>Surat Masuk</span></a></li>
                        <li><a href="{{ route('admin3.historisuratadmin3.index')}}"><i class="ti-archive"></i> <span>Histori Surat</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '5')
                        <li class="active"><a href="{{ route('user1.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user1.historisuratuser1.index')}}"><i class="ti-agenda"></i> <span>Surat Masuk</span></a></li>
                        @endif
                        @if ( auth()->user()->jabatan_id == '6')
                        <li class="active"><a href="{{ route('user2.home.index') }}"><i class="ti-bar-chart-alt"></i> <span>Dashboard</span></a></li>
                        <li><a href="{{ route('user2.suratmasukuser2.index')}}"><i class="ti-agenda"></i> <span>Surat Masuk</span></a></li>
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