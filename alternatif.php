<?php 
$Title = "Alternatif";
include "./includes/header.php";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Table <?= $Title ?></h6>
                    </div>
                    <div class="col-6 text-end">
                      <button type="button" id="btnNew" class="btn bg-gradient-info mb-0" data-bs-toggle="modal" data-bs-target="#ModalAlternatif">
                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;New
                      </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-sm">
                <table id="tableAlternatif" class="table align-items-center">
                  <thead>
                    <tr>
                        <th width="70%" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Keterangan</th>
                        <th width="10%" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>


<?php 
    include "./includes/modal/alternatif.php";
    include "./includes/footer.php"
?>

<script type="text/javascript" src="javascript/alternatif.js?v=<?= date('YmdHis') ?>"></script>
