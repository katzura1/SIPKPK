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
$title = "REMINDER KONTRAK";
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
                  <h3 class="mb-0">Daftar Kontrak Karyawan Melewati Batas</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="tb_divisi" class="table align-items-center table-flush table-stripped">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Karyawan</th>
                    <th scope="col">Status Kontrak</th>
                    <th scope="col">Mulai Kerja</th>
                    <th scope="col">Lama Kontrak</th>
                    <th scope="col">Selesai Kerja</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
               	<?php
                $today = date('Y-m-d');
                $sql = "SELECT id, nama_karyawan, status, mulai_kerja, selesai_kerja, lama_kontrak FROM tb_kontrak JOIN tb_karyawan ON tb_kontrak.kode_karyawan=tb_karyawan.kode_karyawan WHERE selesai_kerja<='$today' AND status!='tetap'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0):
                    // output data of each row
                    $i = 0;
                    while($row = mysqli_fetch_assoc($result)):
                    $i++;
                ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$row['nama_karyawan']?></td>
                    <td><?=$row['status']?></td>
                    <td><?=$row['mulai_kerja']?></td>
                    <td><?=$row['lama_kontrak'].' Tahun'?></td>
                    <td><?=$row['selesai_kerja']?></td>
                    <td><a href="<?=$link?>kontrak/form.php?id=<?=$row['id']?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> LANJUT</a></td>
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