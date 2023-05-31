<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-6 col-12 mb-3">
                            <label>Perihal</label>
                            <input class="form-control" name="perihal" placeholder="Masukan Perihal" readonly>
                            <span class="text-danger">
                                <strong id="perihal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tanggal Surat</label>
                            <input type="date" class="form-control" name="tanggal_surat" placeholder="Masukan Tanggal Surat" readonly>
                            <span class="text-danger">
                                <strong id="tanggal_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tujuan Surat</label>
                            <input class="form-control" name="tujuan_surat" placeholder="Masukan Tujuan Surat" readonly>
                            <span class="text-danger">
                                <strong id="tujuan_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tipe Surat</label>
                            <input class="form-control" name="tipe_surat" placeholder="Masukan Tipe Surat" readonly>
                            <span class="text-danger">
                                <strong id="tipe_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Deskripsi</label>
                            <input class="form-control" name="deskripsi" placeholder="Masukan Deskripsi" readonly>
                            <span class="text-danger">
                                <strong id="deskripsi"></strong>
                            </span>
                        </div>
                        <div class="col-md-5 col-12 mb-3">
                        </div>
                        <h6>Isi Form Dibawah Ini :</h6>
                        <div class="col-md-12 col-12 mb-3">
                            <hr>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                           
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tindakan</label>
                            <select class="form-control selectpicker" name="tindakan">
                                <option value="">-- Pilih Tindakan --</option>
                                <option value="diajukan">Diterima</option>
                                <option value="revisi">Ditolak</option>
                            </select>
                            <span class="text-danger">
                                <strong id="tindakan"></strong>
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