<?php
require('koneksi.php');
require('template\head.php');
if(isset($_POST['btn-kategori'])){
	$kode_kategori = $_POST['kode_kategori'];
	$nama_kategori = $_POST['nama_kategori'];
	$poin = $_POST['poin'];
	$status = $_POST['status'];

	if($status=='aktif'){
		$sql = "SELECT SUM(poin) as total_poin FROM tb_kategori WHERE status='aktif' AND kode_kategori!='$kode_kategori'";
		$result = mysqli_fetch_assoc(mysqli_query($conn, $sql))['total_poin'];
		if($result+$poin>100){
			echo "<script>alert('Total poin melebihi 100!');window.location.href='kategori/form.php?id=$kode_kategori';</script>";
		}
		die(); // stop agar data tidak terupdate
	}

	$sql = "UPDATE tb_kategori SET nama_kategori='$nama_kategori', poin='$poin', status='$status' WHERE kode_kategori='$kode_kategori'";
	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil diubah!');
		window.location.href='kategori/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:kategori\list.php');
}
require('template\js.php');
require('template\foot.php');
?>