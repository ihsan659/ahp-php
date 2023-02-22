<div class="modal fade" id="ModalAnggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalAnggotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ModalAnggotaLabel">Data Anggota</h5>
            <!-- <button type="button" id="btnCancel" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button> -->
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">NRP Anggota</label>
                        <input class="form-control" id="Nrp" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Nama Anggota</label>
                        <input class="form-control" id="Nama" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Jabatan</label>
                        <div class="input-group">
                            <select class="form-control"  id="selectJabatan">
                                <option value="">Jabatan</option>
                            </select>
                            <label class="input-group-text" id="Refresh">
                                <i class="material-icons opacity-10">refresh</i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Pangkat</label>
                        <div class="input-group">
                            <select class="form-control"  id="selectPangkat">
                                <option value="">Pangkat</option>
                            </select>
                            <label class="input-group-text" id="Refresh">
                                <i class="material-icons opacity-10">refresh</i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Tanggal Menjabat</label>
                        <input class="form-control" id="Menjabat" type="date">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Password</label>
                        <input type="password" id="Password" class="form-control" required/>
                    </div>
                </div>
                <div class="col-md-4" style="display:none">
                    <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Gambar</label>
                        <input class="form-control" type="file" id="selectFile">
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
        <div class="modal-footer" style="justify-content:center;">
            <button type="submit" id="btnSave" class="btn btn-info">Save changes</button>
            <button type="button" id="btnCancel" class="btn btn-primary">Close</button>
        </div>
    </div>
  </div>
</div>