<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
require('..\template\sidebar.php');

  //mode edit data
  $kode_karyawan = $_SESSION['apeka-kode-karyawan'];
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
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-kode">Kode Karyawan</label>
                        <input type="text" name="kode_karyawan" id="input-kode" class="form-control form-control-alternative" placeholder="00001" readonly value="<?=$kode_karyawan?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com" value="<?=$email?>" readonly>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Full name</label>
                        <input type="text" name="nama_karyawan" id="input-first-name" class="form-control form-control-alternative" placeholder="Susilo Bambang Yudiyono" value="<?=$nama_karyawan?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-address">Divisi</label>
                        <select name="kode_divisi" class="form-control form-control-alternative" readonly>
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
                        <select name="jenis_kelamin" class="form-control form-control-alternative" readonly>
                          <option value="L" <?=$jenis_kelamin=='L'?'selected':''?>>Laki-Laki</option>
                          <option value="P" <?=$jenis_kelamin=='P'?'selected':''?>>Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label" for="input-first-name">Tanggal Lahir</label>
                        <input class="form-control datepicker" name="tanggal_lahir" placeholder="Select date" type="text" value="<?=date('m/d/Y',strtotime($tanggal_lahir))?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                <div class="pl-lg-4">
                <form action="<?=$link?>edit_password.php" method="POST">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Old Password</label>
                        <input type="password" name="old_pw"class="form-control form-control-alternative" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group focused">
                        <label class="form-control-label">New Password</label>
                        <input type="password" name="new_pw" class="form-control form-control-alternative" required>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <button class="btn btn-primary" name="btn-password">SIMPAN</button>
                    </div>
                  </div>
                </form>
                </div>
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