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
                            <label>Username</label>
                            <input class="form-control" name="name" placeholder="Masukan Username">
                            <span class="text-danger">
                                <strong id="name"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Email</label>
                            <input class="form-control" name="email" placeholder="Masukan Email">
                            <span class="text-danger">
                                <strong id="email"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan_id" class="form-control selectpicker"
                                data-live-search="true">
                                <option selected disabled>--Pilih Jabatan--</option>
                                @foreach ($jabatan as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->bagian }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="jabatan_id"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->