<?php
require('..\koneksi.php');
$link = "http://localhost/penilaian_kinerja/";
$title = "TITLE";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Aplikasi Penilaian Kinerja karyawan</title>
  <!-- Favicon -->
  <link href="<?=$link?>assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="<?=$link?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="<?=$link?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="<?=$link?>assets/css/argon.min.css?v=1.0.0" rel="stylesheet">
  <!--DataTables-->
  <link type="text/css" href="<?=$link?>assets/css/datatables.min.css" rel="stylesheet">
  <!--Select2-->
  <link type="text/css" href="<?=$link?>assets/css/select2.min.css" rel="stylesheet">
 </head>
 <body onload="window.print()" onpageshow="setTimeout(function() {window.close()},0)">

<?php
if(isset($_POST['btn-cari'])){
$bulan = $_POST['bulan'];
if($bulan<10){
    $bulan = substr($bulan, 0);
}
    $tahun = $_POST['tahun'];
}else{
    $bulan = '';
    $tahun = '';
}
?>
<div style="padding:20px;">
<h2 style="text-align:center;">LAPORAN KINERJA BULANAN</h2>

<table class="table" stlye="padding:30px;">
<tr>
    <th>No</th>
    <th>Kode Karyawan</th>
    <th>Nama Karyawan</th>
    <th>Divisi</th>
    <th>Total Skor</th>
</tr>
<?php
    $kode_divisi = $_SESSION['apeka-kode-divisi'];
    $sql = "SELECT total_skor, tb_karyawan.kode_karyawan, nama_karyawan, nama_divisi FROM tb_nilai JOIN tb_karyawan ON tb_nilai.kode_karyawan=tb_karyawan.kode_karyawan JOIN tb_divisi ON tb_divisi.kode_divisi=tb_karyawan.kode_divisi WHERE bulan like '%$bulan' AND tahun='$tahun' AND tb_karyawan.kode_divisi='$kode_divisi' ORDER BY total_skor DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0):
        // output data of each row
        $i = 0;
        while($row = mysqli_fetch_assoc($result)):
        $i++;
    ?>
        <tr>
        <td><?=$i;?></td>
        <td><?=$row['kode_karyawan']?></td>
        <td><?=$row['nama_karyawan']?></td>
        <td><?=$row['nama_divisi']?></td>
        <td><?=$row['total_skor']?></td>
        </tr>
    <?php 
        endwhile;
    endif;
    ?>
</table>
</div>

<?php
require('..\template\js.php');
require('..\template\foot.php');
?>