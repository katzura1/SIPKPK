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
    $tahun = $_POST['tahun'];
}else{
    $tahun = '';
}
?>
<div style="padding:20px;">
<h2 style="text-align:center;">LAPORAN KINERJA BULANAN INDIVIDU</h2>

<table class="table" stlye="padding:30px;">
<tr>
    <th scope="col">No</th>
    <th scope="col">Tahun</th>
    <th scope="col">Bulan</th>
    <th scope="col">Total Skor</th>
</tr>
<?php
$kode_karyawan = $_SESSION['apeka-kode-karyawan'];
$sql = "SELECT tahun, bulan, total_skor FROM tb_nilai WHERE tahun='$tahun' AND kode_karyawan='$kode_karyawan' ORDER BY total_skor DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0):
    // output data of each row
    $i = 0;
    while($row = mysqli_fetch_assoc($result)):
    $i++;
?>
    <tr>
    <td><?=$i;?></td>
    <td><?=$row['tahun']?></td>
    <td><?=$row['bulan']?></td>
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