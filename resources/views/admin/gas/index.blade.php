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
    <div class="row container">
        <div class="col-md-3"></div>
        <div class="col-12 col-md-6 mt-4">
            <div class="card text-center">
                <div class="card-body">
                    <h4 class="card-title">SCAN DISINI BARCODE ANDA</h4>
                    <div id="qr-reader" style="width:100%"></div>
                    <div id="qr-reader-results"></div>
                    <div class="row mt-1">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Scan</h3>
                                    <h1> <span id="scanned">0</span> </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Last Barcode</h3>
                                    <h3> <span id="last_product">-</span> </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="add()" class="btn btn-primary">SUBMIT DATA</button>
                </div>
            </div>
        </div>
    </div>
</div> 

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
                                <h4 class="header-title">Data Barcode Gas</h4>
                            </div>
                            {{-- <div class="col-md-6 col-12">
                                <button type="button" onclick="add()"
                                    class="btn btn-rounded btn-outline-info float-right mb-3"><i class="ti-plus"> </i>
                                    Tambah</button>
                            </div> --}}
                        </div>
                        <table id="dataTable" class="text-center" width="100%">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>No</th>
                                    <th>Barcode</th>
                                    <th>Tipe Gas</th>
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
@include('admin.gas.modal')

<audio id="SuccessAudio">
    <source src="{{ url('sound/success.mp3') }}" type="audio/mpeg">
</audio>

<audio id="ErrorAudio">
    <source src="{{ url('sound/error.mp3') }}" type="audio/mpeg">
</audio>

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
                  url: "{{ route('admin.gas.index') }}",
                  type: "GET",
                  data: function(data) {
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                    data.jabatan = $('#jabatan').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'barcode_id', name: 'barcode_id'},
                {data: 'tipegas.nama_tipe', name: 'tipegas.nama_tipe'},
                {data: 'action', name: 'action'},

            ],
        });

    });

    function add_filter(){
      var from = $("#from").val();
      var to = $("#to").val();
      var distributor = $("#jabatan").val();
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

        function show_filter(){
            $('.modal-title').text('Filter Data'); // Set Title to Bootstrap modal title
            $("#stok").val('');
            $('#modal-filter').modal('show'); // show bootstrap modal
        }

        function add(){
            $('#form')[0].reset(); // reset form on modals
            $('#barcode_id').html("");
            $('#sn').html("");
            $('[name="id"]').val('');
            $('#modal-form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Input Data Gas'); // Set Title to Bootstrap modal title
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
                    url : "/admin/gas/" + id,
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

<script>
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    });


    var x = document.getElementById("SuccessAudio"); 
    var y = document.getElementById("ErrorAudio"); 
    
    function playSuccess() { 
      x.play(); 
    } 

    function playError() { 
      y.play(); 
    } 
    
</script>


<script>
    function alertInvalidBarcode() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
            });
        Toast.fire({
            icon: 'info',
            title: 'Barcode Sudah Terdaftar !'
        })
    }

    function alertValidateBarcode() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
            });
        Toast.fire({
            icon: 'error',
            title: 'Barcode Sudah Discan !'
        })
    }
</script>

<script>
    // array for the barcode
    const barcode = [];
    
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1000);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                lastResult = decodedText;
                // set delay to clear last result
                setTimeout(function () {
                    lastResult = null;
                }, 3000);
                $.ajax({
                    url : "/admin/gas/1?barcode=" + decodedText,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data){
                        if(data.status){
                            // check barcode in array
                            if (barcode.indexOf(decodedText) == -1) {
                                ++countResults;
                                barcode.push(decodedText);
                                
                                // play success sound 
                                playSuccess();

                                // show result
                                $('#scanned').html(countResults);
                                $('#last_product').html(decodedText);
                                
                                // store data
                                $('#total_product').val(countResults);

                            } else {
                                playError();
                                alertValidateBarcode();
                            }
                        }else{
                            alertInvalidBarcode();
                        }
                        
                    },
                    error: function (jqXHR, textStatus , errorThrown){ 
                        alert(errorThrown);
                    }
                });

                
            }
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader",
        { fps: 30, qrbox: {width: 250, height: 150} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);

        
    });

    function add(){
        $('#error_tipegas').text('');
        $('#modal-form').modal('show'); 
        $('.modal-title').text('Input Data Gas'); 
    }

    function sendData(){
        $('#error_tipegas').text('');

        $.ajax({
            url : "{{ route('admin.gas.store') }}",
            type: "POST",
            data: {
                tipegas : $('#tipegas').val(),
                barcode
            },
            dataType: "JSON",
            success: function(data){
                console.log(data);
                if(data.status){
                    console.log(data);
                    sukses();
                    location.reload();
                }else{
                    if(data.errors.tipegas){
                        $('#error_tipegas').text(data.errors.tipegas[0]);
                    }
                    alert(data);
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
                console.log(errorThrown);
            }
        });
    }

</script>

@endsection