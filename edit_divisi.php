<?php
require('koneksi.php');
require('template\head.php');
if(isset($_POST['btn-divisi'])){
	$kode_divisi = $_POST['kode_divisi'];
	$nama_divisi = $_POST['nama_divisi'];

	$sql = "UPDATE tb_divisi SET nama_divisi='$nama_divisi' WHERE kode_divisi='$kode_divisi'";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil diubah!');
		window.location.href='divisi/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:divisi\list.php');
}
require('template\js.php');
require('template\foot.php');
?>