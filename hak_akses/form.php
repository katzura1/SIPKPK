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
  $action = $link.'edit_hak_akses.php';
  $title = "EDIT HAK AKSES";

  $kode_karyawan = $_GET['id'];
  $sql = "SELECT kode_karyawan, nama_karyawan, level FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'";
  $result = mysqli_query($conn, $sql);
  //
  if (mysqli_num_rows($result) == 0){
    echo "<script>window.location.href='list.php';</script>";
  }

  $row = mysqli_fetch_assoc($result);
  $nama_karyawan = $row['nama_karyawan'];
  $level = $row['level'];

}else{
  echo "<script>window.location.href='list.php';</script>";
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
                  <h3 class="mb-0">Data Pengguna</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=$link?>hak_akses/list.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?=$action?>" method="POST">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Kode Karyawan</label>
                        <input type="text" name="kode_karyawan" class="form-control form-control-alternative"value="<?=$kode_karyawan?>" readonly required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Nama Karyawans</label>
                        <input type="text" name="nama_karyawan" class="form-control form-control-alternative" value="<?=$nama_karyawan?>" readonly required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Level</label>
                        <select name="hak_akses" class="form-control form-control-alternative" required>
                          <option value="1" <?=$level=='1L'?'selected':''?>>Karyawan</option>
                          <option value="2" <?=$level=='2'?'selected':''?>>Manajer</option>
                          <option value="3" <?=$level=='3'?'selected':''?>>HRD</option>
                          <option value="4" <?=$level=='4'?'selected':''?>>Pimpinan</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" name="btn-hak-akses">SIMPAN</button>
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