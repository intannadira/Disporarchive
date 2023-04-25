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
                                <h4 class="header-title">Data Relasi</h4>
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
                                    <th>Nama Relasi</th>
                                    <th>Alamat</th>
                                    <th>Stok</th>
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
@include('admin.relasi.modal')
@include('admin.relasi.detail')
@include('admin.relasi.histori')

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
    var table, table2;
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
            lengthMenu: [[10, 20, 100, -1], [10, 20, 100, "All"]],
            ajax: {
                  url: '{{ route('admin.relasi.index')}}',
                  type: "GET",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'nama_relasi', name: 'nama_relasi'},
                {data: 'alamat', name: 'alamat'},
                {data: 'stok', name: 'stok'},
                {data: 'action', name: 'action'},
            ],
        });

        table2 = $('#dataTable_detail').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [[10, 20, 100, -1], [10, 20, 100, "All"]],
            ajax: {
                  url: '{{ route('admin.relasi.edit', 1)}}',
                  type: "GET",
                  data : function(d){
                    d.id = $('[name="id_detail"]').val();
                  }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'barcode_id', name: 'barcode_id'},
                {data: 'tipegas.nama_tipe', name: 'tipegas.nama_tipe'},
            ],
        });

        table3 = $('#dataTable_histori').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            lengthMenu: [[10, 20, 100, -1], [10, 20, 100, "All"]],
            ajax: {
                  url: '{{ route('admin.relasi.create')}}',
                  type: "GET",
                  data : function(d){
                    console.log(d);
                    d.id = $('[name="id_detail"]').val();
                  }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'nama_relasi', name: 'nama_relasi'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'stok_awal', name: 'stok_awal'},
                {data: 'stok_akhir', name: 'stok_akhir'},
                {data: 'status', name: 'status'},
                {data: 'total', name: 'total'},
            ],
        });

    });

    function detail_stok(id) {
        $('[name="id_detail"]').val(id);
        table2.draw();
        $('#modal-detail').modal('show');
    }

    function histori_stok(id) {
        // console.log(id);
        $('[name="id_detail"]').val(id);
        table3.draw();
        $('#modal-histori').modal('show');
    }

    function add_filter(){
      table.draw();
      info();
    }

    function add(){
      $('#form')[0].reset(); // reset form on modals
        $('#nama_relasi').html("");
        $('#alamat').html("");
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Data Relasi'); // Set Title to Bootstrap modal title
    }

    function filter_data(){
      $('#filter_modal').modal('show');
    }

    function save(){
        $('#stok').html("");
        $('#nama_relasi').html("");
        $('#alamat').html("");
        $.ajax({
            url : "{{ route('admin.relasi.store')}}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.nama_relasi){
                        $('#nama_relasi').text(data.errors.nama_relasi[0]);
                    }
                    if(data.errors.alamat){
                        $('#alamat').text(data.errors.alamat[0]);
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
        $('#stok').html("");
        $('#nama_relasi').html("");
        $('#alamat').html("");
        //Ajax Load data from ajax
        $.ajax({
            url : "/admin/relasi/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('[name="id"]').val(data.id);
                $('[name="nama_relasi"]').val(data.nama_relasi);
                $('[name="alamat"]').val(data.alamat);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Relasi'); // Set title to Bootstrap modal title   
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
            url : "/admin/relasi/" + id,
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