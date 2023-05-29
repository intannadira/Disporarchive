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
                                <h4 class="header-title">Daftar Histori Surat</h4>
                            </div>
                            <div class="col-md-6 col-12">                        
                                <button type="hidden" onclick="reload_table()"
                                class="btn btn-rounded btn-outline-secondary float-right mb-3 mr-1"><i
                                    class="ti-reload"> </i> Reload</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>No Agenda</th>
                                    <th>Tanggal Diterima</th>
                                    <th>Status</th>
                                    <th>Instansi</th>
                                    <th>Perihal</th>
                                    <th>Didisposisikan Kpd</th>
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
@include('admin2.suratmasuk.modal')

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
                  url: '{{ route('superadmin.historisurat.index')}}',
                  type: "GET",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'no_urut', name: 'no_urut'},
                {data: 'h_tanggal_terima', name: 'h_tanggal_terima'},
                {data: 'h_status', name: 'h_status'},
                {data: 'dari_instansi', name: 'dari_instansi'},
                {data: 'perihal', name: 'perihal'},
                {data: 'karyawan.nama', name: 'karyawan.nama'},
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
      $('#nama').html("");
      $('#jabatan_bidang_id').html("");
      $('#modal-form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Data Surat Masuk'); // Set Title to Bootstrap modal title
    }

    function filter_data(){
      $('#filter_modal').modal('show');
    }

    function save(){
        $('#jabatan_bidang_id').html("");
        $('#karyawan_id').html("");
        $('#isi_disposisi').html("");
        $('#tindakan_kadin').html("");
        $('#catatan_kadin').html("");
        $.ajax({
            url : "{{ route('admin1.suratmasukadmin1.store')}}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.tindakan){
                        $('#tindakan').text(data.errors.tindakan[0]);
                    }
                    if(data.errors.jabatan_bidang_id){
                        $('#jabatan_bidang_id').text(data.errors.jabatan_bidang_id[0]);
                    }
                    if(data.errors.karyawan_id){
                        $('#karyawan_id').text(data.errors.karyawan_id[0]);
                    }
                    if(data.errors.isi_disposisi){
                        $('#isi_disposisi').text(data.errors.isi_disposisi[0]);
                    }
                    if(data.errors.tindakan_kadin){
                        $('#tindakan_kadin').text(data.errors.tindakan_kadin[0]);
                    }
                    if(data.errors.catatan_kadin){
                        $('#catatan_kadin').text(data.errors.catatan_kadin[0]);
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
        $('#no_urut').html("");
        $('#dari_instansi').html("");
        $('#no_surat').html("");
        $('#perihal').html("");
        $('#tanggal_terima').html("");
        $('#tanggal_surat').html("");
        $('#kepada').html("");
        $('#kategori_surat').html("");
        $('#tindakan').html("");
        //Ajax Load data from ajax
        $.ajax({
            url : "/admin1/suratmasukadmin1/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="no_urut"]').val(data.no_urut);
                $('[name="dari_instansi"]').val(data.dari_instansi);
                $('[name="no_surat"]').val(data.no_surat);
                $('[name="perihal"]').val(data.perihal);
                $('[name="tanggal_terima"]').val(data.tanggal_terima);
                $('[name="tanggal_surat"]').val(data.tanggal_surat);
                $('[name="kepada"]').val(data.kepada);
                $('[name="kategori_surat"]').val(data.kategori_surat);
                $('[name="tindakan"]').val(data.tindakan);
                $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Data Surat Masuk'); // Set title to Bootstrap modal title   
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
            url : "/admin1/suratmasukadmin1/" + id,
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