<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
//cek level pengguna
if($_SESSION['apeka-level'] < 2){
  echo "<script> window.location.href='$link"."index.php';</script>";
}
require('..\template\sidebar.php');
$title = "KINERJA KARYAWAN PER BULAN";
require('..\template\topbar.php');

if(isset($_POST['btn-cari'])){
  $bulan = $_POST['bulan'];
  if($bulan<10){
    $bulan = substr($bulan, 0);
  }
  $tahun = $_POST['tahun'];
}else{
  $bulan = '';
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
                   <label>Bulan</label>
                   <select name="bulan" class="form-control form-control-focused">
                   <?php 
                   for($i=1;$i<13;$i++):
                   ?>
                    <option value="<?=$i?>" <?=$i==$bulan?'selected':''?>><?=$i?></option>
                   <?php
                   endfor;
                   ?>
                  </select>
                  </div>
                </div>
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
                    <button name="btn-cari" class="btn btn-primary" formaction="<?=$link."laporan\kinerja_bulanan.php"?>>">CARI</button>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label style="display: block; color: white;">Tahun</label>
                    <button name="btn-cari" class="btn btn-primary" formaction="<?=$link."laporan\cetak_bulanan.php"?>" formtarget="_blank">CETAK</button>
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
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Total Skor</th>
                  </tr>
                </thead>
                <tbody>
               	<?php
                $kode_divisi = $_SESSION['apeka-kode-divisi'];
                $sql = "SELECT total_skor, nama_karyawan, nama_divisi FROM tb_nilai JOIN tb_karyawan ON tb_nilai.kode_karyawan=tb_karyawan.kode_karyawan JOIN tb_divisi ON tb_divisi.kode_divisi=tb_karyawan.kode_divisi WHERE bulan like '%$bulan' AND tahun='$tahun' AND tb_karyawan.kode_divisi='$kode_divisi' ORDER BY total_skor DESC";
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
                    <td><?=$row['nama_divisi']?></td>
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