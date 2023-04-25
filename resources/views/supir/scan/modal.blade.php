<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form">
          <div class="form-group">
            <label for="exampleFormControlInput1">Nama Karyawan</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="karyawan" readonly>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Total Gas</label>
            <input type="number" class="form-control" id="total_product" placeholder="Scan Barcode Terlebih Dahulu"
              name="total_product" readonly>
              <span class="text-danger">
                <strong id="error_total_product"></strong>
              </span>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Relasi</label>
            <select class="form-control selectpicker" id="relasi" name="relasi">
              <option selected disabled>-- Pilih Relasi --</option>
              @foreach($relasi as $r)
              <option value="{{ $r->id }}">{{ $r->nama_relasi }}</option>
              @endforeach
            </select>
            <span class="text-danger">
              <strong id="error_relasi"></strong>
            </span>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Status</label>
            <select class="form-control selectpicker" id="status" name="status">
              <option selected disabled>-- Pilih Status --</option>
              <option value="masuk">Masuk</option>
              <option value="keluar">Keluar</option>
            </select>
            <span class="text-danger">
              <strong id="error_status"></strong>
            </span>
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