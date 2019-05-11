<?php
require('koneksi.php');
require('template\head.php');
if(isset($_POST['btn-karyawan'])){
	$kode_karyawan = $_POST['kode_karyawan'];
	$nama_karyawan = $_POST['nama_karyawan'];
	$email = $_POST['email'];
	$kode_divisi = $_POST['kode_divisi'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tanggal_lahir = date('Y-m-d',strtotime($_POST['tanggal_lahir']));
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$sql = "UPDATE tb_karyawan SET nama_karyawan='$nama_karyawan', email='$email', kode_divisi='$kode_divisi', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', password='$password' WHERE  kode_karyawan='$kode_karyawan'";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil diubah!');
		window.location.href='karyawan/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:karyawan\list.php');
}
require('template\js.php');
require('template\foot.php');
?>