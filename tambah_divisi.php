<?php
require('koneksi.php');
require('template/head.php');
if(isset($_POST['btn-divisi'])){
	$nama_divisi = $_POST['nama_divisi'];

	$sql = "INSERT INTO tb_divisi (nama_divisi) VALUES ('$nama_divisi')";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil disimpan!');
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