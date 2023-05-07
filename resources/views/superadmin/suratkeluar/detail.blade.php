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
                                        <span>PEMERINTAH KOTA SURAKARTA</span>
                                        <br>
                                        <span>DINAS KEPEMUDAAN DAN OLAHRAGA</span>
                                        <br>
                                        <p>Jl. Adisucipto No. 1 Manahan Surakarta (0271) 742207 Pswt: Fax (0271) 729101 SURAKARTA 57139</p>
                                        <br>
                                        <h6><b>DISPOSISI KEPALA DINAS KEPEMUDAAN DAN OLAHRAGA</b></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-area mt-2">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <table class="table table-sm table-borderless">
                                            <tr>
                                                <td>No Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->no_surat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Perihal</td>
                                                <td>:</td>
                                                <td>{{ $surat->perihal }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ date('d-m-Y', strtotime($surat->tanggal_surat)) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tujuan Surat</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->tujuan_surat }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi</td>
                                                <td>:</td>
                                                <td><strong>{{ $surat->deskripsi }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-buttons text-right d-print-none">
                            <a href="#" onclick="window.print();" class="invoice-btn"><i class="ti-printer"></i> Print</a>
                            <a href="{{ route('superadmin.suratkeluar.index')}}" class="invoice-btn"><i class="ti-back-left"></i> Kembali</a>
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