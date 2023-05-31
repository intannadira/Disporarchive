<!-- Modal -->
<div class="modal fade" id="modal-form2">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form2" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-6 col-12 mb-3">
                            <label>Perihal</label>
                            <input class="form-control" name="perihal" placeholder="Masukan Perihal">
                            <span class="text-danger">
                                <strong id="perihal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" name="tanggal_surat" placeholder="Masukan Tanggal Surat">
                            <span class="text-danger">
                                <strong id="tanggal_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tujuan Surat</label>
                            <input class="form-control" name="tujuan_surat" placeholder="Masukan Tujuan Surat">
                            <span class="text-danger">
                                <strong id="tujuan_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tipe Surat</label>
                            <input class="form-control" name="tipe_surat" placeholder="Masukan Tipe Surat">
                            <span class="text-danger">
                                <strong id="tipe_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>File Lampiran</label>
                            <input type="file" class="form-control" name="lampiran" placeholder="Masukkan Lampiran">
                            <span class="text-danger">
                                <strong id="lampiran"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Deskripsi</label>
                            <input class="form-control" name="deskripsi" placeholder="Masukan Deskripsi">
                            <span class="text-danger">
                                <strong id="deskripsi"></strong>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="save2()" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- basic modal end -->