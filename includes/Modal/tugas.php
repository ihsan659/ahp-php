<div class="modal fade bd-example-modal-lg" id="ModalTugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalTugasLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalTugasLabel">Data Tugas</h5>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Tanggal</label>
                        <input class="form-control" type="date" id="Date" value="">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">File</label>
                        <input type="file" id="fileattach" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label class="form-label">Jenis</label>
                        <select class="form-control" id="Criteria">
                            <option value=''>Select</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group my-2">
                        <label class="form-label">Keterampilan</label>
                        <select class="form-control" id="Keterampilan">
                            <option value=''>Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" id="Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group my-2">
                        <label class="form-label">Nilai</label>
                        <input type="number" id="Bobot" class="form-control" min="0" max="100" />
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