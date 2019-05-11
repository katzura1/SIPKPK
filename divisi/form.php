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
  $action = $link.'edit_divisi.php';
  $title = "EDIT DIVISI";

  $kode_divisi = $_GET['id'];
  $sql = "SELECT kode_divisi, nama_divisi FROM tb_divisi WHERE kode_divisi='$kode_divisi'";
  $result = mysqli_query($conn, $sql);
  //
  if (mysqli_num_rows($result) == 0){
    echo "<script>window.location.href='list.php';</script>";
  }

  $row = mysqli_fetch_assoc($result);
  $nama_divisi = $row['nama_divisi'];

}else{
  //mode tambah data
  $action = $link.'tambah_divisi.php';
  $title = "TAMBAH DIVISI";

  $kode_divisi = '';
  $nama_divisi = '';
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
                  <h3 class="mb-0">Data Divisi</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=$link?>karyawan/list.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?=$action?>" method="POST">
                <?php
                  if(isset($_GET['id'])):
                  ?>
                  <input type="hidden" name="kode_divisi" value="<?=$kode_divisi?>">
                  <?php
                  endif;
                ?>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="nama-divisi">Nama Divisi</label>
                        <input type="text" name="nama_divisi" id="nama-divisi" class="form-control form-control-alternative" placeholder="Produksi" value="<?=$nama_divisi?>" required>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" name="btn-divisi">SIMPAN</button>
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