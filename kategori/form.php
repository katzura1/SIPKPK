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
  $action = $link.'edit_kategori.php';
  $title = "EDIT KATEGORI POIN PENILAIAN";

  $kode_kategori = $_GET['id'];
  $sql = "SELECT kode_kategori, nama_kategori, poin, status FROM tb_kategori WHERE kode_kategori='$kode_kategori'";
  $result = mysqli_query($conn, $sql);
  //
  if (mysqli_num_rows($result) == 0){
    echo "<script>window.location.href='list.php';</script>";
  }

  $row = mysqli_fetch_assoc($result);
  $nama_kategori = $row['nama_kategori'];
  $poin = $row['poin'];
  $status = $row['status'];

}else{
  //mode tambah data
  $action = $link.'tambah_kategori.php';
  $title = "TAMBAH KATEGORI POIN PENILAIAN";

  $kode_kategori = '';
  $nama_kategori = '';
  $poin = '';
  $status = '';

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
                  <h3 class="mb-0">Data Kategori Poin Penilaian</h3>
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
                  <input type="hidden" name="kode_kategori" value="<?=$kode_kategori?>">
                  <?php
                  endif;
                ?>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Nama kategori</label>
                        <input type="text" name="nama_kategori" class="form-control form-control-alternative" placeholder="disiplin" value="<?=$nama_kategori?>" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Poin</label>
                        <input type="number" min="0" name="poin" class="form-control form-control-alternative" placeholder="0" value="<?=$poin?>" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Status</label>
                        <select name="status" class="form-control form-control-alternative">
                          <option value="aktif" <?=$status=='aktif'?'selected':''?>>Aktif</option>
                          <option value="tidak aktif" <?=$status=='tidak aktif'?'selected':''?>>Tidak Aktif</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" name="btn-kategori">SIMPAN</button>
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