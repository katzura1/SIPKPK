<?php
require('koneksi.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='login.php';</script>";
}
require('template\head.php');
require('template\sidebar.php');
$title="Dashboard";
require('template\topbar.php');

function jumlah_karyawan($conn){
  $today = date('Y-m-d');
  $sql = "SELECT count(kode_karyawan) as 'jumlah' FROM tb_kontrak WHERE selesai_kerja > '$today' OR status='tetap'";
  $result = mysqli_query($conn, $sql);

  return mysqli_fetch_assoc($result)['jumlah'];
}

function jumlah_tetap($conn){
  $today = date('Y-m-d');
  $sql = "SELECT count(kode_karyawan) as 'jumlah' FROM tb_kontrak WHERE status='tetap'";
  $result = mysqli_query($conn, $sql);

  return mysqli_fetch_assoc($result)['jumlah'];
}

function jumlah_kontrak($conn){
  $today = date('Y-m-d');
  $sql = "SELECT count(kode_karyawan) as 'jumlah' FROM tb_kontrak WHERE selesai_kerja > '$today' AND status='kontrak'";
  $result = mysqli_query($conn, $sql);

  return mysqli_fetch_assoc($result)['jumlah'];
}
?>
<!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
      	<div class="header-body">
          <!-- Card stats -->
          <div class="row">
            <?php 
            if($_SESSION['apeka-level']!='3'):
            ?>
            <h1 class="display-4" style="color:white"> SELAMAT DATANG DI APLIKASI PENILAIAN KINERJA KARYAWAN</h1>
            <?php 
            else:
            ?>
            <div class="col-xl-4 col-lg-8">
              <div class="card card-stats mb-6 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Karyawan</h5>
                      <span class="h2 font-weight-bold mb-0"><?=jumlah_karyawan($conn)?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-6 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Karyawan Tetap</h5>
                      <span class="h2 font-weight-bold mb-0"><?=jumlah_tetap($conn)?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-user-circle"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6">
              <div class="card card-stats mb-6 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Karyawan Kontrak</h5>
                      <span class="h2 font-weight-bold mb-0"><?=jumlah_kontrak($conn)?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-12 col-lg-6" style="margin-top:10px;">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="mb-0">Reminder Kontrak</h3>
                  </div>
                  <div class="col text-right">
                    <a href="kontrak/reminder.php" class="btn btn-sm btn-primary">Detail</a>
                  </div>
                </div>
              </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="tb_divisi" class="table align-items-center table-flush table-stripped">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Status Kontrak</th>
                    <th scope="col">Mulai Kerja</th>
                    <th scope="col">Lama Kontrak</th>
                    <th scope="col">Selesai Kerja</th>
                  </tr>
                </thead>
                <tbody>
               	<?php
                $today = date('Y-m-d');
                $sql = "SELECT id, nama_karyawan, status, mulai_kerja, selesai_kerja, lama_kontrak FROM tb_kontrak JOIN tb_karyawan ON tb_kontrak.kode_karyawan=tb_karyawan.kode_karyawan WHERE selesai_kerja<='$today' AND status!='tetap'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                    // output data of each row
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)):
                    $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$row['nama_karyawan']?></td>
                    <td><?=$row['status']?></td>
                    <td><?=$row['mulai_kerja']?></td>
                    <td><?=$row['lama_kontrak'].' Tahun'?></td>
                    <td><?=$row['selesai_kerja']?></td>
                  </tr>
                <?php 
                    endwhile;
                endif;
                ?>
                </tbody>
              </table>
            </div>
            </div>

          </div>
          <?php 
            endif;
            ?>
        </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
    
<?php
require('template\js.php');
require('template\foot.php');
?>