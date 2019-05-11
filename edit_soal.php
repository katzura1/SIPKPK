<?php
require('koneksi.php');
require('template/head.php');
if(isset($_POST['btn-soal'])){
	$kode_soal = $_POST['kode_soal'];
	$kode_kategori = $_POST['kode_kategori'];
	$soal = $_POST['soal'];

	$sql = "UPDATE tb_soal SET kode_kategori='$kode_kategori', soal='$soal' WHERE kode_soal='$kode_soal'";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil diubah!');
		window.location.href='soal/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:soal\list.php');
}
require('..\template\js.php');
require('template\foot.php');
?>