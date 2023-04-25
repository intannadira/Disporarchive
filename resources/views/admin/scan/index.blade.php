@extends('layouts.default')

@section('css')
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
                    <h4 class="card-title">SCAN DISINI</h4>
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
<!-- main content area end -->
@include('supir.scan.modal')

<audio id="SuccessAudio">
    <source src="{{ url('sound/success.mp3') }}" type="audio/mpeg">
</audio>

<audio id="ErrorAudio">
    <source src="{{ url('sound/error.mp3') }}" type="audio/mpeg">
</audio>

@endsection

@section('js')
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
                    url : "/scan/1?barcode=" + decodedText,
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

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });

    function add(){
        $('#modal-form').modal('show'); 
        $('.modal-title').text('Input Data Gas'); 
    }

    function sendData(){
        $.ajax({
            url : "{{ route('scan.store') }}",
            type: "POST",
            data: {
                relasi : $('#relasi').val(),
                barcode
            },
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    console.log(data);
                    sukses();
                    location.reload();
                }else{
                    alert(data);
                }
            },
            error: function (jqXHR, textStatus , errorThrown){ 
                alert(errorThrown);
            }
        });
    }

</script>
@endsection