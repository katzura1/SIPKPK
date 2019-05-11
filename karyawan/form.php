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

function get_latest_kode($conn){
  $sql = "SELECT kode_karyawan FROM tb_karyawan ORDER BY kode_karyawan DESC LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $kode = (int) mysqli_fetch_assoc($result)['kode_karyawan']+1;
    if($kode>9){
      return "0000".$kode;
    }else if($kode>99){
      return "000".$kode;
    }else if($kode>999){
      return "00".$kode;
    }else if($kode>9999){
      return "0".$kode;
    }else if($kode>99999){
      return $kode;
    }else{
      return "00000".$kode;
    }
  }else{
    return "000001";
  }
}

if(isset($_GET['id'])){
  //mode edit data
  $kode_karyawan = $_GET['id'];
  $action = $link.'edit_karyawan.php';
  $title = "EDIT KARYAWAN";
  $sql = "SELECT nama_karyawan, email, kode_divisi, jenis_kelamin, tanggal_lahir, password FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 0){
    echo "
    <script>window.location.href='list.php';</script>
    ";
  }
  $row = mysqli_fetch_assoc($result);
  
  $nama_karyawan = $row['nama_karyawan'];
  $email = $row['email'];
  $kode_divisi = $row['kode_divisi'];
  $jenis_kelamin = $row['jenis_kelamin'];
  $tanggal_lahir = $row['tanggal_lahir'];

}else{
  //mode tambah data
  $action = $link.'tambah_karyawan.php';
  $title = "TAMBAH KARYAWAN";
  $kode_karyawan = get_latest_kode($conn);
  $nama_karyawan = '';
  $email = '';
  $kode_divisi = '';
  $jenis_kelamin = '';
  $tanggal_lahir = '';
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
                  <h3 class="mb-0">Data Karyawan</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=$link?>karyawan/list.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?=$action?>" method="POST">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-kode">Kode Karyawan</label>
                        <input type="text" name="kode_karyawan" id="input-kode" class="form-control form-control-alternative" placeholder="00001" required readonly value="<?=$kode_karyawan?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" value="<?=$email?>" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Full name</label>
                        <input type="text" name="nama_karyawan" id="input-first-name" class="form-control form-control-alternative" placeholder="Susilo Bambang Yudiyono" value="<?=$nama_karyawan?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Divisi</label>
                        <select name="kode_divisi" class="form-control form-control-alternative" required>
                          <option value="" disabled selected>PILIH</option>
                        <?php
                        $sql = "SELECT * FROM tb_divisi";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0):
                          while($row = mysqli_fetch_assoc($result)):
                        ?>
                          <option value="<?=$row['kode_divisi']?>" <?=$kode_divisi==$row['kode_divisi']?'selected':''?>>
                            <?=$row['nama_divisi']?>
                          </option>
                        <?php
                          endwhile;
                        endif;
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control form-control-alternative" required>
                          <option value="L" <?=$jenis_kelamin=='L'?'selected':''?>>Laki-Laki</option>
                          <option value="P" <?=$jenis_kelamin=='P'?'selected':''?>>Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Tanggal Lahir</label>
                        <input class="form-control datepicker" name="tanggal_lahir" placeholder="Select date" type="text" value="<?=date('m/d/Y',strtotime($tanggal_lahir))?>">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Password</label>
                        <input class="form-control form-control-alternative" type="password" name="password" placeholder="password" required>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-primary" name="btn-karyawan">SIMPAN</button>
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