@extends('layouts.default')

@section('css')
@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6 col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-area">
                            <div class="invoice-head">
                                <div class="row text-center">
                                    <div class="iv-left col-12">
                                        <span>LAPORAN KELUAR MASUK GAS</span>
                                        <br>
                                        <span>KODE : {{ $transaksi->kode_transaksi }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="invoice-address">
                                        <h4>RELASI : </h4>
                                        <h5>{{ $transaksi->relasi->nama_relasi }}</h5>
                                        <p>{{ $transaksi->relasi->alamat }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <ul class="invoice-date">
                                        <li>Tanggal Transaksi : {{ date('d/m/Y', strtotime($transaksi->tanggal))}}</li>
                                        <li>Waktu Transaksi : {{ date('H:i:s', strtotime($transaksi->tanggal))}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-table table-responsive mt-5">
                                <table class="table table-bordered table-hover text-right">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th class="text-center" style="width: 5%;">No</th>
                                            <th class="text-left" style="width: 45%; min-width: 130px;">Nama Gas</th>
                                            <th>Barcode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($transaksi->detail_transaksi as $data)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            @foreach ($data->namagas as $gas )
                                                @foreach ($gas->tipenama as $tipe )
                                                <td class="text-left">{{ $tipe->nama_tipe }}</td>
                                                @endforeach
                                            @endforeach
                                            <td>{{ $data->id_barcode }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right d-print-none">
                            <a href="#" onclick="window.print();" class="invoice-btn"><i class="ti-printer"></i> Print</a>
                            <a href="/admin/laporan" class="invoice-btn"><i class="ti-back-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection