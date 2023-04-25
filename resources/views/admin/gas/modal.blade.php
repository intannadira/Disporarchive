<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-12 col-12 mb-3">
                            <label for="exampleFormControlSelect1">Pilih Tipe Gas</label>
                            <select  class="form-control selectpicker" id="tipegas" name="tipegas">
                                <option selected disabled>-- Pilih Tipe Gas --</option>
                                @foreach ($tipe_gas as $tipe_gas)
                                <option value="{{ $tipe_gas->id }}">{{ $tipe_gas->nama_tipe }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="error_tipegas"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="sendData()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->