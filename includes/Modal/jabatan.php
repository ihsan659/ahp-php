<div class="modal fade" id="ModalJabatan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalJabatanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalJabatanLabel">Data Jabatan</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nama</label>
                        <input type="text" id="Nama" class="form-control" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check form-switch d-flex ps-0 text-end">
                        <input class="form-check-input ms-auto ms-3" type="checkbox" onclick="selectBox(this)" id="Status">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label">Description</label>
                        <input type="text" id="Description" class="form-control" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center;">
            <button type="submit" id="btnSave" class="btn btn-info">Save changes</button>
            <button type="button" id="btnCancel" class="btn btn-primary">Close</button>
        </div>
    </div>
  </div>
</div>