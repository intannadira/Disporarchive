@extends('layouts.default')

@section('css')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<!-- page title area end -->
<div class="main-content-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="title">Filter Data</h5>
                        <div class="row">
                            <div class="col-md-12 col-12 mt-2">
                                <label>Dari Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="from"
                                        placeholder="Pilih Tanggal Awal" value="{{ date('Y-m-01') }}" id="from">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Sampai Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="to"
                                        placeholder="Pilih Tanggal Akhir" value="{{ date('Y-m-t') }}" id="to">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Status : </label>
                                <div class="input-group">
                                    <select id="status" name="status" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="all" selected>--Semua Status--</option>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Relasi : </label>
                                <div class="input-group">
                                    <select id="relasi" name="relasi" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="all" selected>--Semua Relasi--</option>
                                        @foreach ($relasi as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_relasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-12 col-12 mt-2">
                                <label>Supir : </label>
                                <select name="supir" id="supir" class="form-control selectpicker" data-live-search="true">
                                    <option value="all" selected>-- Semua Supir --</option>
                                    @foreach ($supir as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-12 text-center mt-2">
                                <div class="form-group">
                                    <button type="button" onclick="add_filter()" class="btn btn-outline-primary"><i
                                            class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- /.card -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="text-center">
                            <h4>LAPORAN TRANSAKSI</h4>
                            <h6>Keluar / Masuk Gas</h6>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Supir</th>
                                    <th>Relasi</th>
                                    <th>Total Gas</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <!-- data table end -->
        </div>
    </div>
</div>
<!-- main content area end -->
@include('admin.gas.modal')

@endsection

@section('js')
<!-- Start datatable js -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script src="{{ url('srtdash/assets/vendor/number/jquery.number.min.js') }}"></script>

<script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript">
    var table;
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [[50, 100, 200, -1], [50, 100, 200, "All"]],
            ajax: {
                  url: "{{ route('admin.laporan.index') }}",
                  type: "GET",
                  data: function(data) {
                    data.from       = $('#from').val();
                    data.to         = $('#to').val();
                    data.relasi     = $('#relasi').val();
                    data.supir      = $('#supir').val();
                    data.status     = $('#status').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'kode_trx', name: 'kode_trx'},
                {data: 'tgl_transaksi', name: 'tgl_transaksi'},
                {data: 'status_transaksi', name: 'status_transaksi'},
                {data: 'sopir.nama', name: 'sopir.nama'},
                {data: 'relasi.nama_relasi', name: 'relasi.nama_relasi'},
                {data: 'total_gas', name: 'total_gas'},
            ],
        });

    });

    function add_filter(){
      table.draw();
      info();
    }

    function info() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
            });
        Toast.fire({
            icon: 'info',
            title: 'Sukses Filter Data !'
        })
    }

    function reload_table(){
        table.ajax.reload(null,false);
    }

</script>
@endsection