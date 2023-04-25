<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('img/favicon.ico')}}">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="{{ url('srtdash/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/slicknav.min.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- others css -->
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ url('srtdash/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <!-- page title area end -->
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">Scan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">Input</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="card text-center">
                                <div class="card-body mt-2">
                                    <h4 class="card-title">SCAN BARCODE DISINI</h4>
                                    <div id="qr-reader" style="width:100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="input-group mx-3 my-3">
                                <input type="number" name="barcode" id="barcode" placeholder="Masukan barcode" class="form-control" aria-label="Text input with dropdown button" autocomplete="off">
                                <div class="input-group-append">
                                    <button onclick="check_input_barcode()" class="btn btn-primary" type="button">
                                        <span class="ti-search"></span><span class="icon-name"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center mt-3">
                        <div class="col-6 col-md-6">
                            <h5>Scan</h5>
                            <h3> <span id="scanned">0</span> </h3>
                        </div>
                        <div class="col-6 col-md-6">
                            <h5>Last Barcode</h5>
                            <span id="last_product">-</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" onclick="add()" class="btn btn-primary mt-2">SUBMIT DATA</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="title text-center">Filter Data</h5>
                        <div class="row">
                            <div class="col-md-3 col-12 mt-2">
                                <label>Dari Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="from"
                                        placeholder="Pilih Tanggal Awal" value="{{ date('Y-m-01') }}" id="from">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-3 col-12 mt-2">
                                <label>Sampai Tanggal : </label>
                                <div class="input-group">
                                    <input type="date" class="form-control float-right datepicker" name="to"
                                        placeholder="Pilih Tanggal Akhir" value="{{ date('Y-m-t') }}" id="to">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-2 col-12 mt-2">
                                <label>Status : </label>
                                <div class="input-group">
                                    <select id="filter_status" name="filter_status" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="all" selected>--Semua Status--</option>
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-3 col-12 mt-2">
                                <label>Relasi : </label>
                                <div class="input-group">
                                    <select id="filter_relasi" name="filter_relasi" class="form-control selectpicker"
                                        data-live-search="true">
                                        <option value="all" selected>--Semua Relasi--</option>
                                        @foreach ($relasi as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_relasi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-1 col-12 text-center mt-2 mt-md-4">
                                <div class="form-group">
                                    <button type="button" onclick="add_filter()"
                                        class="btn btn-outline-primary mt-md-2"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
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
        </div>
        <div class="text-center">
        <a class="dropdown-item" href="{{ route('logout') }}" class="dropdown-item has-icon"><b><u>Log Out</u></b></a>
        </div>
    </div>

    <!-- main content area end -->
    @include('supir.scan.modal')

    <audio id="SuccessAudio">
        <source src="{{ url('sound/success.mp3') }}" type="audio/mpeg">
    </audio>

    <audio id="ErrorAudio">
        <source src="{{ url('sound/error.mp3') }}" type="audio/mpeg">
    </audio>
    <script src="{{ url('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <script src="{{ url('srtdash/assets/vendor/number/jquery.number.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>
    <!-- others plugins -->
    <script src="{{ url('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/scripts.js') }}"></script>
    <script src="{{ url('srtdash/assets/vendor/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{ url('js/html5-qrcode.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

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
                title: 'Barcode Tidak Terdaftar !'
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
    var lastResult, countResults = 0;
    
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
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                lastResult = decodedText;
                // set delay to clear last result
                setTimeout(function () {
                    lastResult = null;
                }, 2000);
                $.ajax({
                    url : "/supir/scan/1?barcode=" + decodedText,
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
        "reader",
        { fps: 20, qrbox: {width: 250, height: 100} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);
    });

    function check_input_barcode(){
        var barcode_id = $('#barcode').val();
        $.ajax({
            url : "/supir/scan/1?barcode=" + barcode_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    // check barcode in array
                    if (barcode.indexOf(barcode_id) == -1) {
                        ++countResults;
                        barcode.push(barcode_id);
                        
                        // play success sound 
                        playSuccess();

                        // show result
                        $('#scanned').html(countResults);
                        $('#last_product').html(barcode_id);
                        
                        // store data
                        $('#total_product').val(countResults);

                        // reset
                        $('#barcode').val('');

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

    function add(){
        if(barcode.length > 0){
            $('#error_relasi').text('');
            $('#error_status').text('');
            $('#modal-form').modal('show'); 
            $('.modal-title').text('Form Data Gas'); 
        }else{
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'error',
                title: 'Scan / Masukan Barcode !'
            })
        }
    }

    function sendData(){
        $('#error_relasi').text('');
        $('#error_status').text('');

        $.ajax({
            url : "{{ route('supir.scan.store') }}",
            type: "POST",
            data: {
                relasi : $('#relasi').val(),
                status : $('#status').val(),
                barcode
            },
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    sukses();
                    location.reload();
                }else if(data.validasi){
                    removeValue(data.validasi, data.barcode);
                }else{
                    if(data.errors.relasi){
                        $('#error_relasi').text(data.errors.relasi[0]);
                    }if(data.errors.status){
                        $('#error_status').text(data.errors.status[0]);
                    }if(data.errors.barcode){
                        $('#error_total_product').text(data.errors.barcode[0]);
                    }
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
        });
    }

    function removeValue(message, removeBarcode) {
        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
      })
      swalWithBootstrapButtons.fire({
        title: 'Konfirmasi !',
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus Barcode '+removeBarcode,
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          // remove value in array barcode where barcode in array
            for (var i = 0; i < barcode.length; i++) {
                var index = barcode.indexOf(removeBarcode[i]);
                if (index > -1) {
                barcode.splice(index, 1);
                }
            }
            --countResults;
            $('#scanned').html(countResults);
            $('#total_product').val(countResults);

        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Batal',
            'Barcode tidak dihapus',
            'error'
          )
        }
      })
    }

    </script>
    <script>
        function sukses() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'success',
                title: 'Berhasil !'
            })
        }
        function sukseshapus() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
                });
            Toast.fire({
                icon: 'error',
                title: 'Data berhasil dihapus !'
            })
        }
    </script>
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
            lengthMenu: [[10, 100, 200, -1], [10, 100, 200, "All"]],
            ajax: {
                  url: "{{ route('supir.laporan.index') }}",
                  type: "GET",
                  data: function(data) {
                    data.from       = $('#from').val();
                    data.to         = $('#to').val();
                    data.relasi     = $('#filter_relasi').val();
                    data.status     = $('#filter_status').val();
              }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'kode_trx', name: 'kode_trx'},
                {data: 'tgl_transaksi', name: 'tgl_transaksi'},
                {data: 'status_transaksi', name: 'status_transaksi'},
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
</body>

</html>