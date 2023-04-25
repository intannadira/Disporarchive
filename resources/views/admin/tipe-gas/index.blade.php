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
            
            <div class="col-md-10 col-12">
                <!-- /.card -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <h4 class="header-title">Data Tipe Gas</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="button" onclick="add()"
                                    class="btn btn-rounded btn-outline-info float-right mb-3"><i class="ti-plus"> </i>
                                    Tambah</button>
                            </div>
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Tipe Gas</th>
                                    <th>Total Gas</th>
                                    <th>Action</th>
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
@include('admin.tipe-gas.modal')

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
<script src="{{ url('js/html5-qrcode.min.js') }}"></script>
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
                  url: "{{ route('admin.tipe-gas.index') }}",
                  type: "GET",
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'nama_tipe', name: 'nama_tipe'},
                {data: 'jumlah_gas', name: 'jumlah_gas'},
                {data: 'action', name: 'action'},

            ],
        });

    });

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

    function add(){
        $('#form')[0].reset(); // reset form on modals
        $('#nama_tipe').html("");
        $('[name="id"]').val('');
        $('#modal-form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Input Data Tipe Gas'); // Set Title to Bootstrap modal title
    }

    function save(){
        $.ajax({
            url : "{{ route('admin.tipe-gas.store') }}",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data){
                console.log(data);
                if(data.status) {
                    $('#modal-form').modal('hide');
                    reload_table();
                    sukses();
                }else{
                    if(data.errors.nama_tipe){
                        $('#nama_tipe').text(data.errors.nama_tipe[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
        });
    }

    function edit(id){
        $('#form')[0].reset(); // reset form on modals
        $('#nama_tipe').html("");
        $('[name="id"]').val('');
        //Ajax Load data from ajax
        $.ajax({
        url : "/admin/tipe-gas/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('[name="id"]').val(data.id);
            $('[name="nama_tipe"]').val(data.nama_tipe);
            $('#modal-form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Tipe Gas'); // Set title to Bootstrap modal title   
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
                url : "/admin/tipe-gas/" + id,
                type: "DELETE",
                dataType: "JSON",
                success: function(data){
                    if(data.status){
                    console.log(status);
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