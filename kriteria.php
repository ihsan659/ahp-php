<?php 
$Title = "Kriteria";
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
                      <button type="button" id="generateCR" class="btn bg-gradient-success mb-0">
                        <i class="material-icons text-sm">sync_alt</i>&nbsp;&nbsp;Generate Kriteria
                      </button>
                      <button type="button" id="btnNew" class="btn bg-gradient-info mb-0" data-bs-toggle="modal" data-bs-target="#ModalKriteria">
                        <i class="material-icons text-sm">add</i>&nbsp;&nbsp;New
                      </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
              <div class="table-responsive text-sm">
                <table id="tableKriteria" class="table align-items-center">
                  <thead>
                    <tr>
                        <th width="20%" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Code</th>
                        <th width="50%" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                        <th width="20%" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Bobot</th>
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
    include "./includes/modal/kriteria.php";
    include "./includes/footer.php"
?>

<script type="text/javascript" src="javascript/kriteria.js?v=<?= date('YmdHis') ?>"></script>
