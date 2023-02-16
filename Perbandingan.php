    <?php 
    $Title = "Perbandingan";
    include "./includes/header.php";
    ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card p-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0"><?= $Title ?> Kriteria</h6>
                    </div>
                    <div class="col-6 text-end">
                      <button type="button" id="resetData" class="btn btn-sm bg-gradient-danger mb-0">
                        <i class="material-icons text-md">autorenew</i>&nbsp;&nbsp; Reset Kriteria
                      </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="tablePerbandinganKriteria" class="table table-bordered table-striped text-center text-xs">
                    <thead>
                        <tr>
                            <th></th>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>


<?php 
    include "./includes/footer.php"
?>

<script type="text/javascript" src="javascript/perbandingan-kriteria.js?v=<?= date('YmdHis') ?>"></script>
