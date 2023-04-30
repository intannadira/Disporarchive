<!-- Modal -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="form">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="hidden" name="id">
                        <div class="col-md-6 col-12 mb-3">
                            <label>Instansi Pengirim</label>
                            <input class="form-control" name="dari_instansi" placeholder="Masukan Instansi Pengirim" readonly>
                            <span class="text-danger">
                                <strong id="dari_instansi"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Nomor Surat</label>
                            <input class="form-control" name="no_surat" placeholder="Masukan Nomor Surat" readonly>
                            <span class="text-danger">
                                <strong id="no_surat"></strong>
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
                            <label>Tanggal Terima</label>
                            <input type="date" class="form-control" name="tanggal_terima" placeholder="Masukan Tanggal Terima" readonly>
                            <span class="text-danger">
                                <strong id="tanggal_terima"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>No Agenda</label>
                            <input class="form-control" name="no_urut" placeholder="Masukan No Urut" readonly>
                            <span class="text-danger">
                                <strong id="no_urut"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Kepada Yth</label>
                            <input class="form-control" name="kepada" placeholder="Masukan Kepada Yth" readonly>
                            <span class="text-danger">
                                <strong id="kepada"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Perihal</label>
                            <input class="form-control" name="perihal" placeholder="Masukan Perihal" readonly>
                            <span class="text-danger">
                                <strong id="perihal"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Sifat</label>
                            <select class="form-control" name="kategori_surat" readonly>
                                <option value="">-- Pilih Sifat --</option>
                                <option value="segera">Segera</option>
                                <option value="sangat-segera">Sangat Segera</option>
                                <option value="biasa">Biasa</option>
                            </select>
                            <span class="text-danger">
                                <strong id="kategori_surat"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Jabatan</label>
                            <select name="jabatan_bidang_id" class="form-control selectpicker" readonly
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
                        <div class="col-md-6 col-12 mb-3">
                            <label>Karyawan</label>
                            <select name="karyawan_id" class="form-control selectpicker" readonly
                                data-live-search="true">
                                <option selected disabled>--Pilih Karyawan--</option>
                                @foreach ($karyawan as $karyawan)
                                <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="karyawan_id"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Isi Disposisi</label>
                            <input name="isi_disposisi" class="form-control" rows="5" placeholder="Masukan Isi Disposisi" readonly>
                            <span class="text-danger">
                                <strong id="isi_disposisi"></strong>
                            </span>
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Tindakan</label>
                            <select class="form-control" name="tindakan_kadin" readonly>
                                <option value="">-- Pilih Tindakan --</option>
                                <option value="selesaikan">Selesaikan</option>
                                <option value="tolak">Tolak</option>
                            </select>
                            <span class="text-danger">
                                <strong id="tindakan_kadin"></strong>
                            </span>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            <label>Catatan</label>
                            <textarea name="catatan_kadin" class="form-control" rows="5" placeholder="Masukan Catatan" readonly></textarea>
                            <span class="text-danger">
                                <strong id="catatan_kadin"></strong>
                            </span>
                        </div>
                        <div class="col-md-3 col-12 mb-3">
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <label>Ubah Status Surat</label>
                            <select class="form-control" name="status" readonly>
                                <option value="">-- Ubah Status Surat --</option>
                                <option value="selesai">Selesai</option>
                                <option value="didisposisi">Belum Selesai</option>
                            </select>
                            <span class="text-danger">
                                <strong id="status"></strong>
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