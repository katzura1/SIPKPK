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
$title = "KARYAWAN";
require('..\template\topbar.php');

if(isset($_GET['id'])){
  //mode edit data
  $kode_karyawan = $_GET['id'];
  $sql = "SELECT nama_karyawan, email, nama_divisi, jenis_kelamin, tanggal_lahir, password FROM tb_karyawan JOIN tb_divisi ON tb_karyawan.kode_divisi=tb_divisi.kode_divisi WHERE kode_karyawan='$kode_karyawan'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 0){
    echo "
    <script>window.location.href='list.php';</script>
    ";
  }
  $row = mysqli_fetch_assoc($result);
  
  $nama_karyawan = $row['nama_karyawan'];
  $email = $row['email'];
  $nama_divisi = $row['nama_divisi'];
  $jenis_kelamin = $row['jenis_kelamin'];
  $tanggal_lahir = $row['tanggal_lahir'];

}else{
  echo "
    <script>window.location.href='list.php';</script>
  ";
}
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
  	<div class="header-body">
  	 <div class="row">
  	 	<div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Data Karyawan</h3>
                </div>
                <div class="col text-right">
                  <a href="list.php" class="btn btn-sm btn-primary">
                    Back
                  </a>
                </div>
              </div>
            </div>
          <div class="card-body">
            <div class="pl-lg-4">
              <div class="row">
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Kode Karyawan</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=$kode_karyawan?></label>
                </div>

                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Nama Karyawan</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=$nama_karyawan?></label>
                </div>

                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Email</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=$email?></label>
                </div>

                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Jenis Kelamin</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=$jenis_kelamin=='L'?'Laki-laki':'Perempuan';?></label>
                </div>

                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Divisi</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=$nama_divisi?></label>
                </div>

                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">Tanggal Lahir</label>
                </div>
                <div class="col-lg-6">
                  <label class="form-control-label" for="input-kode">: <?=date('d/m/Y',strtotime($tanggal_lahir))?></label>
                </div>
              </div>
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
?>
<!--script manual-->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tb_karyawan').DataTable();
} );
</script>
<?php
require('..\template\foot.php');
?>