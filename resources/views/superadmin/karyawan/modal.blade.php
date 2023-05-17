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
                            <label>Nama</label>
                            <input class="form-control" name="nama" placeholder="Masukan Nama">
                            <span class="text-danger">
                                <strong id="nama"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>No Telp</label>
                            <input class="form-control" type="number" name="no_wa" placeholder="Masukan No WhatsApp 628-">
                            <span class="text-danger">
                                <strong id="no_wa"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan_bidang_id" class="form-control selectpicker"
                                data-live-search="true">
                                <option selected disabled>--Pilih Jabatan--</option>
                                @foreach ($jabatan as $jabatan)
                                <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan_bidang }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="jabatan_bidang_id"></strong>
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