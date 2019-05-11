<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
require('..\template\sidebar.php');
$title = "KINERJA KARYAWAN PER BULAN";
require('..\template\topbar.php');

if(isset($_POST['btn-cari'])){
  $tahun = $_POST['tahun'];
}else{
  $tahun = '';
}
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
  	<div class="header-body">
  	 <div class="row">
  	 	<div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Laporan Kinerja Karyawan</h3>
                </div>
                <div class="col text-right">
                  <a href="../index.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <form method="POST">
              <div class="row" style="padding: 15px">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tahun</label>
                    <select name="tahun" class="form-control form-control-focused">
                    <?php
                    $sql = "SELECT DISTINCT tahun FROM tb_nilai";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                    ?>
                    <option value="<?=$row['tahun']?>" <?=$row['tahun']==$tahun?'selectted':''?>><?=$row['tahun']?></option>
                    <?php
                    endwhile;
                    ?>
                  </select>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label style="display: block; color: white;">Tahun</label>
                    <button name="btn-cari" class="btn btn-primary" formaction="<?=$link."laporan\kinerja_personal.php"?>">CARI</button>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label style="display: block; color: white;">Tahun</label>
                    <button name="btn-cari" class="btn btn-primary" formaction="<?=$link."laporan\cetak_personal.php"?>" formtarget="_blank">CETAK</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="tb_divisi" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Bulan</th>
                    <th scope="col">Total Skor</th>
                  </tr>
                </thead>
                <tbody>
               	<?php
                $kode_karyawan = $_SESSION['apeka-kode-karyawan'];
                $sql = "SELECT tahun, bulan, total_skor FROM tb_nilai WHERE tahun='$tahun' AND kode_karyawan='$kode_karyawan' ORDER BY total_skor DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                    // output data of each row
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)):
                    $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$row['tahun']?></td>
                    <td><?=$row['bulan']?></td>
                    <td><?=$row['total_skor']?></td>
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
  	 </div>
    </div>
  </div>
</div>

<?php
require('..\template\js.php');
?>
<!--script manual-->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tb_divisi').DataTable();
} );
</script>
<?php
require('..\template\foot.php');
?>