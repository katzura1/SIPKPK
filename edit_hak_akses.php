<?php
require('koneksi.php');
require('template\head.php');
if(isset($_POST['btn-hak-akses'])){
	$kode_karyawan = $_POST['kode_karyawan'];
	$level = $_POST['hak_akses'];

	$sql = "UPDATE tb_karyawan SET level='$level' WHERE  kode_karyawan='$kode_karyawan'";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil diubah!');
		window.location.href='hak_akses/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	echo "
		<script>
		window.location.href='hak_akses/list.php';
		</script>";
}
require('template\js.php');
require('template\foot.php');
?>