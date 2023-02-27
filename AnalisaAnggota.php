<?php 
$Title = "Analisa Anggota";
include "./includes/header.php";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content">
                    <h6 class="text-white mb-2">Total Nilai Anggota</h6>
                </div>
            </div>
            <div class="card p-3">
                <div class="table-responsive">
                <table id="tableAnggota" class="table align-items-center ">
                    <thead>
                    </thead>
                    <tbody id="tableNilai"></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div id="container-Kriteria"> 
    </div>
    <!-- <div class="row mt-3">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card p-3">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content">
                        <h6 class="mb-2">Nilai Responbility</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card p-3">
                <div class="table-responsive">
                <table id="tableMatrix" class="table align-items-center "></table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card p-3">
                <div class="table-responsive">
                <table class="table align-items-center ">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <div class="text-center">
                                    <p class="text-sm font-weight-bold mb-0">Nilai Eigen</p>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="text-sm font-weight-bold mb-0">Jumlah</p>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="text-sm font-weight-bold mb-0">Rata-rata</p>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tilaiEigen"></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-4 mb-lg-0 mb-4">
            <div class="card p-3">
                <div class="table-responsive">
                <table id="tableNilaiResponbility" class="table align-items-center">
                    <tbody>
                        <tr>
                            <td>Lamda Max</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nilai CI</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Nilai CR</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div> -->

</div>


<?php 
include "./includes/footer.php"
?>

<script type="text/javascript" src="javascript/data.js?v=<?= date('YmdHis') ?>"></script>
<script type="text/javascript" src="javascript/analisaanggota.js?v=<?= date('YmdHis') ?>"></script>