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
            <div class="col-md-1"></div>
            <!-- data table start -->
            <div class="col-md-10 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Daftar Surat Keluar</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="button" onclick="add()"
                                    class="btn btn-rounded btn-outline-info float-right mb-3"><i class="ti-plus"> </i>
                                    Tambah</button>                            
                                <button type="hidden" onclick="reload_table()"
                                class="btn btn-rounded btn-outline-secondary float-right mb-3 mr-1"><i
                                    class="ti-reload"> </i> Reload</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Status</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tujuan Surat</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>
</div>
@include('admin1.suratkeluar.modal')

<!-- main content area end -->
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
                  url: '{{ route('admin1.suratkeluaradmin1.index')}}',
                  type: "GET",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'no_surat', name: 'no_surat'},
                {data: 'perihal', name: 'perihal'},
                {data: 'h_status', name: 'h_status'},
                {data: 'tanggal_surat', name: 'tanggal_surat'},
                {data: 'tujuan_surat', name: 'tujuan_surat'},
                {data: 'deskripsi', name: 'deskripsi'},
                {data: 'action', name: 'action'},
            ],
        });

    });

    function add_filter(){
      var from = $("#from").val();
      var to = $("#to").val();
      table.draw();
      info();
    }

    function add(){
      $('#form')[0].reset(); // reset form on modals
      $('#no_surat').html("");
      $('#perihal').html("");
      $('#tanggal_surat').html("");
      $('#tujuan_surat').html("");
      $('#tipe_surat').html("");
      $('#lampiran').html("");
      $('#deskripsi').html("");
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Data Surat Keluar'); // Set Title to Bootstrap modal title
    }

    function filter_data(){
      $('#filter_modal').modal('show');
    }

    function save(){
        var formData = new FormData($('#form')[0]);
        $('#nama').html("");
        $('#no_surat').html("");
        $('#perihal').html("");
        $('#tanggal_surat').html("");
        $('#tujuan_surat').html("");
        $('#tipe_surat').html("");
        $('#lampiran').html("");
        $('#deskripsi').html("");
        $.ajax({
            url : "{{ route('admin1.suratkeluaradmin1.store')}}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.perihal){
                        $('#perihal').text(data.errors.perihal[0]);
                    }
                    if(data.errors.tanggal_surat){
                        $('#tanggal_surat').text(data.errors.tanggal_surat[0]);
                    }
                    if(data.errors.tujuan_surat){
                        $('#tujuan_surat').text(data.errors.tujuan_surat[0]);
                    }
                    if(data.errors.tipe_surat){
                        $('#tipe_surat').text(data.errors.tipe_surat[0]);
                    }
                    if(data.errors.deskripsi){
                        $('#deskripsi').text(data.errors.deskripsi[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
        });
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

    function edit(id){
        $('#form')[0].reset(); // reset form on modals
        $('#no_surat').html("");
        $('#perihal').html("");
        $('#tanggal_surat').html("");
        $('#tujuan_surat').html("");
        $('#tipe_surat').html("");
        $('#deskripsi').html("");
        //Ajax Load data from ajax
        $.ajax({
            url : "/admin1/suratkeluaradmin1/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="no_surat"]').val(data.no_surat);
                $('[name="perihal"]').val(data.perihal);
                $('[name="tanggal_surat"]').val(data.tanggal_surat);
                $('[name="tujuan_surat"]').val(data.tujuan_surat);
                $('[name="tipe_surat"]').val(data.tipe_surat);
                $('[name="deskripsi"]').val(data.deskripsi);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Surat Keluar'); // Set title to Bootstrap modal title   
            },
            error: function (jqXHR, textStatus , errorThrown) {
                alert(errorThrown);
            }
        });
    }

   function delete_data(id){
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
      })
      swalWithBootstrapButtons.fire({
        title: 'Konfirmasi !',
        text: "Anda Akan Menghapus Data ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url : "/admin1/suratkeluaradmin1/" + id,
            type: "DELETE",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                reload_table();
                sukseshapus();
                }else{
                    alert('Data tidak boleh dihapus');
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                console.log(errorThrown);
            }
        })
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Batal',
            'Data tidak dihapus',
            'error'
          )
        }
      })
    }

</script>
@endsection