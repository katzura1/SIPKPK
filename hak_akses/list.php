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
$title = "KELOLA HAK AKSES";
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
                  <h3 class="mb-0">Daftar Pengguna</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="tb_karyawan" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Karyawan</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Level</th>
                    <th scope="col">AKSI</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT kode_karyawan, nama_karyawan, nama_divisi, level FROM tb_karyawan JOIN tb_divisi ON tb_karyawan.kode_divisi=tb_divisi.kode_divisi";
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
                    <td><?=$row['level']?></td>
                    <td>
                      <a href="<?=$link?>hak_akses/form.php?id=<?=$row['kode_karyawan']?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> EDIT</a>
                    </td>
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
    $('#tb_karyawan').DataTable();
} );
</script>
<?php
require('..\template\foot.php');
?>