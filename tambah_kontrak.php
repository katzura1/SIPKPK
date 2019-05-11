<?php
require('koneksi.php');
require('template/head.php');
if(isset($_POST['btn-kontrak'])){
	$kode_karyawan = $_POST['kode_karyawan'];
	$status = $_POST['status'];
	$tanggal_masuk  = date('Y-m-d',strtotime($_POST['mulai_kerja']));
	if($status=='tetap'){
		$tanggal_selesai = '0000-00-00';
		$lama_kerja = '';
	}else{
		$tanggal_selesai = date('Y-m-d',strtotime($_POST['mulai_kerja']. '+12 month'));
		$lama_kerja = '1';
	}
	
	$sql = "INSERT INTO tb_kontrak (kode_karyawan, status, mulai_kerja, selesai_kerja, lama_kontrak) VALUES ('$kode_karyawan','$status','$tanggal_masuk','$tanggal_selesai','$lama_kerja')";

	if(mysqli_query($conn, $sql)){
		echo "
		<script>
		alert('Data berhasil disimpan!');
		window.location.href='kontrak/list.php';
		</script>";
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:kontrak\list.php');
}
require('template\js.php');
require('template\foot.php');
?>