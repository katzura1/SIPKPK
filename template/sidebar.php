<!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="<?=$link?>index.php">
        <img src="<?=$link?>assets/img/brand/logo.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- Top Bar User Mobile -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="<?=$link?>assets/img/theme/avatar-user.png">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Welcome!</h6>
            </div>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>My profile</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="<?=$link?>index.php">
                <img src="<?=$link?>assets/img/brand/logo.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Navigation -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>index.php">
              <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
          </li>
        </ul>
        <?php 
        if($_SESSION['apeka-level']=='3'):
        ?>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Master</h6>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>divisi/list.php">
              <i class="fa fa-briefcase text-orange"></i> Divisi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>karyawan/list.php">
              <i class="fa fa-users text-blue"></i> Karyawan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>hak_akses/list.php">
              <i class="fa fa-user text-blue"></i> Hak Akses
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>kategori/list.php">
              <i class="fa fa-file text-green"></i> Kategori Soal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>soal/list.php">
              <i class="fa fa-hashtag text-red"></i> Soal Penilaian
            </a>
          </li>
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Kontrak</h6>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>kontrak/list.php">
              <i class="fa fa-check text-orange"></i> Kelola Kontrak
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>kontrak/reminder.php">
              <i class="fa fa-check text-orange"></i> Reminder Kontrak
            </a>
          </li>
        </ul>
        <?php
        endif;
        
        if($_SESSION['apeka-level']=='2' || $_SESSION['apeka-level']=='3'):
        ?>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Penilaian Karyawan</h6>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>nilai/list_karyawan.php">
              <i class="fa fa-check text-orange"></i> Input Nilai
            </a>
          </li>
        </ul>
        <?php 
        endif;
        ?>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Laporan</h6>
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>laporan/kinerja_bulanan.php">
              <i class="fa fa-chart-line text-green"></i> Kinerja Bulanan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$link?>laporan/kinerja_personal.php">
              <i class="fa fa-book text-green"></i> Kinerja Individu
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>