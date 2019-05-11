<?php
require('koneksi.php');
if(isset($_SESSION['apeka-kode-karyawan'])){
	echo "<script>window.location.href='index.php';</script>";
}

if(isset($_POST['btn-login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT kode_karyawan, nama_karyawan, kode_divisi , level, password FROM tb_karyawan WHERE kode_karyawan='$username' OR email='$username'";
	$result = mysqli_query($conn, $sql);

	if(mysqli_num_rows($result)>0){
		$data = mysqli_fetch_assoc($result);
		if(password_verify($password, $data['password'])){
			$_SESSION['apeka-kode-karyawan'] = $data['kode_karyawan'];
			$_SESSION['apeka-nama-karyawan'] = $data['nama_karyawan'];
      $_SESSION['apeka-level'] = $data['level'];
      $_SESSION['apeka-kode-divisi'] = $data['kode_divisi'];
			echo "<script> alert('Login Berhasil!'); window.location.href='index.php'; </script>";
		}else{
			echo "<script>alert('login gagal password salah!');</script>";
		}
	}else{
		echo "<script>alert('login gagal email / kode karyawan salah!');</script>";
	}
}
require('template\head.php');
?>
<!-- Header -->
<div class="header bg-gradient-primary py-7 py-lg-5">
  <div class="container">
    <div class="header-body text-center mb-7">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-6">
          <h1 class="text-white">Welcome!</h1>
          <p class="text-lead text-light">Aplikasi Penilaian Kinerja Karyawan</p>
        </div>
      </div>
    </div>
  </div>
  <div class="separator separator-bottom separator-skew zindex-100">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</div>
<!-- Page content -->
<div class="container mt--8 pb-5">
  <div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
      <div class="card bg-secondary shadow border-0">
        <div class="card-body px-lg-5 py-lg-5">
          <div class="text-center text-muted mb-4">
            <small>Silahkan Login</small>
          </div>
          <form action="login.php" method="POST">
            <div class="form-group mb-3">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                </div>
                <input name="username" class="form-control" placeholder="Email / Kode Karyawan" type="text" required="">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                </div>
                <input class="form-control" name="password" placeholder="Password" type="password" required="">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" name="btn-login" class="btn btn-primary my-4">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
require('template\js.php');
require('template\foot.php');
?>