<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
//cek level
if($_SESSION['apeka-level'] < 2){
  echo "<script> window.location.href='$link"."index.php';</script>";
}
require('..\template\sidebar.php');

if(isset($_GET['id'])){
  //mode edit data
  $action = $link.'isi_nilai.php';
  $title = "FORM PENILAIAN KARYAWAN";
  //ambil data karyawan
  $kode_karyawan = $_GET['id'];
  $sql = "SELECT nama_karyawan FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);

  $nama_karyawan = $data['nama_karyawan'];

}else{
  echo "<script>window.location.href='list_karyawan.php';</script>";
}
require('..\template\topbar.php');

?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
     <div class="row">
      <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Form Penilaian (<?=$kode_karyawan.' - '.$nama_karyawan?>)</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="list_karyawan.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="col-lg-12">
                <div class="ct-page-title">
                  <p><b>Standar Penilaian</b><br>
                    1 = Buruk (<49&#37;)<br> 
                    2 = Kurang (50&#37;-69&#37;)<br>
                    3 = Cukup (70&#37;-79&#37;)<br>
                    4 = Baik (80&#37;-90&#37;)<br>
                    5 = Sangat Baik (>99&#37;)<br>
                  </p>
                </div>
              </div>
              <form action="<?=$action?>" method="POST">
                <input type="hidden" name="kode_karyawan" value="<?=$kode_karyawan?>">
                <input type="hidden" name="kode_penilai" value="<?=$_SESSION['apeka-kode-karyawan']?>">
                <div class="pl-lg-4">
                  <div class="row">
                    <?php
                    $sql = "SELECT kode_kategori, nama_kategori, poin FROM tb_kategori ORDER BY kode_kategori DESC";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)):
                      $kode_kategori = $row['kode_kategori'];

                    ?>
                    <div class="col-lg-12">
                      <div class="ct-page-title">
                        <h4 class="ct-title" id="content"><?=$row['nama_kategori'].' ('.$row['poin'].' poin)'?></h4>
                      </div>
                    </div>
                    <?php
                      $sql1 = "SELECT kode_soal, soal FROM tb_soal WHERE kode_kategori='$kode_kategori'";

                      $result1 = mysqli_query($conn, $sql1);
                      $i=0;
                      while($row1 = mysqli_fetch_assoc($result1)):
                        $i++;
                        $kode_soal = $row1['kode_soal'];
                    ?>
                    <div class="col-lg-9">
                      <div class="form-group focused">
                        <label class="form-control-label"><?=$i.'. '.$row1['soal']?></label>
                        <input type="hidden" name="soal[]" value="<?=$kode_soal?>" required>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group focused">
                        <input type="number" min="1" max="5" name="poin[]" class="form-control form-control-alternative" placeholder="0" value="1" required>
                      </div>
                    </div>
                    <?php
                      endwhile;
                    endwhile;
                    ?>
                  </div>
                  <button class="btn btn-primary" name="btn-nilai">SIMPAN</button>
                </div>
              </form>
            </div>
          </div>
        </div>
     </div>
    </div>
  </div>
</div>

<?php
require('..\template\js.php');
require('..\template\foot.php');
?>