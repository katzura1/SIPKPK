<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
//cek level pengguna
if($_SESSION['apeka-level'] < 3){
  echo "<script> window.location.href='$link"."index.php';</script>";
}
require('..\template\sidebar.php');

if(isset($_GET['id'])){
  //mode edit data
  $action = $link.'edit_soal.php';
  $title = "EDIT SOAL";

  $kode_soal = $_GET['id'];
  $sql = "SELECT kode_soal, soal, kode_kategori FROM tb_soal WHERE kode_soal='$kode_soal'";
  $result = mysqli_query($conn, $sql);
  //jika kode soal tidak ditemuka redirect ke halaman list
  if (mysqli_num_rows($result) == 0){
    echo "<script>window.location.href='list.php';</script>";
  }
  //jika tidak
  $row = mysqli_fetch_assoc($result);
  $kode_kategori = $row['kode_kategori'];
  $soal = $row['soal'];

}else{
  //mode tambah data
  $action = $link.'tambah_soal.php';
  $title = "TAMBAH SOAL";

  $kode_soal = '';
  $kode_kategori = '';
  $soal = '';
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
                  <h3 class="mb-0">Data Kategori Soal</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="list.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?=$action?>" method="POST">
                <?php
                  if(isset($_GET['id'])):
                  ?>
                  <input type="hidden" name="kode_soal" value="<?=$kode_soal?>">
                  <?php
                  endif;
                ?>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Kategori Soal</label>
                        <select name="kode_kategori" class="form-control form-control-alternative">
                        <?php
                        $sql = "SELECT kode_kategori, nama_kategori FROM tb_kategori";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($result)):
                        ?>
                          <option value="<?=$row['kode_kategori']?>" <?=$row['kode_kategori']==$kode_kategori?'selected':''?>><?=$row['nama_kategori']?></option>
                        <?php
                        endwhile;
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Soal</label>
                        <input type="text" name="soal" class="form-control form-control-alternative" placeholder="Apakah karyawan selalu datang terlambat" value="<?=$soal?>" required>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" name="btn-soal">SIMPAN</button>
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