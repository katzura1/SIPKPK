<?php
require('koneksi.php');
require('template/head.php');

if(isset($_POST['btn-nilai'])){
	$kode_karyawan = $_POST['kode_karyawan'];
	$kode_penilai = $_POST['kode_penilai'];
	$kode_soal = $_POST['soal'];
	$poin = $_POST['poin'];
	$tahun = date('Y');
	$bulan = date('m');

	//insert ke tb_nilai untuk mengambil id nilai
	$sql = "INSERT INTO tb_nilai (tahun, bulan, kode_karyawan, kode_penilai) VALUES ('$tahun','$bulan','$kode_karyawan','$kode_penilai')";

	if(mysqli_query($conn, $sql)){
		$no_nilai = mysqli_insert_id($conn);
		//isi tabel detail nilai
		for($i=0; $i<sizeof($kode_soal);$i++){
			$sql = "INSERT INTO tb_detail_nilai (no_nilai, kode_soal, nilai) VALUES ('$no_nilai','$kode_soal[$i]', $poin[$i])";
			mysqli_query($conn, $sql);
		}

		//update total skor
		$sql = "SELECT tk.kode_kategori, poin, SUM(nilai) as skor_group FROM tb_detail_nilai tdn JOIN tb_soal ts ON tdn.kode_soal=ts.kode_soal JOIN tb_kategori tk ON ts.kode_kategori=tk.kode_kategori WHERE no_nilai='$no_nilai' GROUP BY tk.kode_kategori";

		$result = mysqli_query($conn, $sql);
		$total = 0.0;
		$jumlah_soal = sizeof($kode_soal);
		while($row = mysqli_fetch_assoc($result)){
			$poin = $row['poin'];
			$skor = $row['skor_group'];
			$sub_skor = ($poin*$skor)/100;
			$total+=$sub_skor;
		}
		$total_skor = $total*$jumlah_soal;

		$sql = "UPDATE tb_nilai SET total_skor='$total_skor' WHERE no_nilai='$no_nilai'";
		if(mysqli_query($conn, $sql)){
			//redirect
			echo "
			<script>
			alert('Data berhasil disimpan!');
			window.location.href='nilai/list_karyawan.php';
			</script>";
		}else{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}else{
	header('location:divisi\list.php');
}
require('template\js.php');
require('template\foot.php');
?>