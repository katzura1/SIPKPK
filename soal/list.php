<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
//cek level pengguna
if($_SESSION['apeka-level'] < 3){
  echo "<script> window.location.href='$link"."index.php';</script>";
}
require('..\template\sidebar.php');
$title = "KELOLA DIVISI";
require('..\template\topbar.php');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
  	<div class="header-body">
  	 <div class="row">
  	 	<div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Daftar Kategori Soal</h3>
                </div>
                <div class="col text-right">
                  <a href="form.php" class="btn btn-sm btn-primary">Tambah Data</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="tb_divisi" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Soal</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
               	<?php
                $sql = "SELECT kode_soal, nama_kategori, soal FROM tb_soal JOIN tb_kategori ON tb_soal.kode_kategori=tb_kategori.kode_kategori ORDER BY tb_kategori.kode_kategori DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                    // output data of each row
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)):
                    $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$row['nama_kategori']?></td>
                    <td><?=$row['soal']?></td>
                    <td><a href="<?=$link?>soal/form.php?id=<?=$row['kode_soal']?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> EDIT</a></td>
                  </tr>
                <?php 
                    endwhile;
                endif;
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
  	 </div>
    </div>
  </div>
</div>

<?php
require('..\template\js.php');
?>
<!--script manual-->
<script type="text/javascript">
  $(document).ready(function() {
    $('#tb_divisi').DataTable();
} );
</script>
<?php
require('..\template\foot.php');
?>