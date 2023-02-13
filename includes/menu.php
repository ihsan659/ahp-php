<!-- <div class="min-height-300 bg-gradient-info position-absolute w-100"></div> -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/">
        <img src="./assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-dark">Dashboard</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item" id="NavDashboard">
          <a class="nav-link text-dark <?= $Title == 'Dashbodar' ? 'active bg-gradient-info' : '' ?>" href="/">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Modul</h6>
        </li>
        <li class="nav-item" id="NavPerbandingan">
          <a class="nav-link text-dark <?= $Title == 'Perbandingan' ? 'active bg-gradient-info' : '' ?>" href="./Perbandingan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">key</i>
            </div>
            <span class="nav-link-text ms-1">Perbandingan</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Tools</h6>
        </li>
        <li class="nav-item" id="NavKriteria">
          <a class="nav-link text-dark <?= $Title == 'Kriteria' ? 'active bg-gradient-info' : '' ?>" href="./kriteria.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">diamond</i>
            </div>
            <span class="nav-link-text ms-1">Kriteria</span>
          </a>
        </li>
        <li class="nav-item" id="NavAlternatif">
          <a class="nav-link text-dark <?= $Title == 'Alternatif' ? 'active bg-gradient-info' : '' ?>" href="./alternatif.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">travel_explore</i>
            </div>
            <span class="nav-link-text ms-1">Alternatif</span>
          </a>
        </li>
        <li class="nav-item" id="NavKeterampilan">
          <a class="nav-link text-dark <?= $Title == 'Keterampilan' ? 'active bg-gradient-info' : '' ?>" href="./Keterampilan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">lan</i>
            </div>
            <span class="nav-link-text ms-1">Keterampilan</span>
          </a>
        </li>
        <li class="nav-item" id="NavPangkat">
          <a class="nav-link text-dark <?= $Title == 'Pangkat' ? 'active bg-gradient-info' : '' ?>" href="./pangkat.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Pangkat</span>
          </a>
        </li>
        <li class="nav-item" id="NavJabatan">
          <a class="nav-link text-dark <?= $Title == 'Jabatan' ? 'active bg-gradient-info' : '' ?>" href="./jabatan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">weekend</i>
            </div>
            <span class="nav-link-text ms-1">Jabatan</span>
          </a>
        </li>
        <li class="nav-item" id="NavAnggota">
          <a class="nav-link text-dark <?= $Title == 'Anggota' ? 'active bg-gradient-info' : '' ?>" href="./anggota.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Anggota</span>
          </a>
        </li>
        <!-- <li class="nav-item" id="NavAnggota">
          <a class="nav-link text-dark <?= $Title == 'Anggota' ? 'active bg-gradient-info' : '' ?>" href="./anggota.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Anggota</span>
          </a>
        </li> -->
      </ul>
    </div>
    <!-- <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-info mt-4 w-100" href="logout.php" type="button">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">login</i>
              <span class="nav-link-text ms-1">logout</span>
            </div>
        </a>
      </div>
    </div> -->
  </aside>