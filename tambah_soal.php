<?php
require('koneksi.php');
require('template/head.php');
if(isset($_POST['btn-soal'])){
	$kode_kategori = $_POST['kode_kategori'];
	$soal = $_POST['soal'];

	$sql = "INSERT INTO tb_soal (kode_kategori, soal) VALUES ('$kode_kategori', '$soal')";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil disimpan!');
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