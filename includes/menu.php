<!-- <div class="min-height-300 bg-gradient-info position-absolute w-100"></div> -->
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps bg-white" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/">
        <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-dark">Dashboard</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item" id="NavDashboard">
          <a class="nav-link  <?= $Title == 'Dashbodar' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="/">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Modul</h6>
        </li>
        <li class="nav-item" id="NavTugas">
          <a class="nav-link <?= $Title == 'Tugas' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./Tugas.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">integration_instructions</i>
            </div>
            <span class="nav-link-text ms-1">Tugas</span>
          </a>
        </li>
        <li class="nav-item" id="NavPerbandingan">
          <a class="nav-link <?= $Title == 'Perbandingan' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./Perbandingan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">key</i>
            </div>
            <span class="nav-link-text ms-1">Analisa Kriteria</span>
          </a>
        </li>
        <li class="nav-item" id="NavAnalisaAnggota">
          <a class="nav-link <?= $Title == 'Analisa Anggota' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./AnalisaAnggota.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">insights</i>
            </div>
            <span class="nav-link-text ms-1">Analisa Anggota</span>
          </a>
        </li>
        
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-8">Tools</h6>
        </li>
        <li class="nav-item" id="NavKriteria">
          <a class="nav-link <?= $Title == 'Kriteria' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./kriteria.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">diamond</i>
            </div>
            <span class="nav-link-text ms-1">Kriteria</span>
          </a>
        </li>
        <li class="nav-item" id="NavAlternatif">
          <a class="nav-link <?= $Title == 'Alternatif' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./alternatif.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">travel_explore</i>
            </div>
            <span class="nav-link-text ms-1">Alternatif</span>
          </a>
        </li>
        <li class="nav-item" id="NavKeterampilan">
          <a class="nav-link <?= $Title == 'Keterampilan' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./Keterampilan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">lan</i>
            </div>
            <span class="nav-link-text ms-1">Keterampilan</span>
          </a>
        </li>
        <li class="nav-item" id="NavPangkat">
          <a class="nav-link <?= $Title == 'Pangkat' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./pangkat.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">assignment</i>
            </div>
            <span class="nav-link-text ms-1">Pangkat</span>
          </a>
        </li>
        <li class="nav-item" id="NavJabatan">
          <a class="nav-link <?= $Title == 'Jabatan' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./jabatan.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">weekend</i>
            </div>
            <span class="nav-link-text ms-1">Jabatan</span>
          </a>
        </li>
        <li class="nav-item" id="NavAnggota">
          <a class="nav-link <?= $Title == 'Anggota' ? 'active bg-gradient-info text-light' : 'text-dark' ?>" href="./anggota.php">
            <div class="text-dark text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Anggota</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>