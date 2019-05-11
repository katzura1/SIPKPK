<?php
require('..\koneksi.php');
require('..\template\head.php');
if(!isset($_SESSION['apeka-kode-karyawan'])){
  echo "<script> window.location.href='$link"."login.php';</script>";
}
//cek level pengguna
if($_SESSION['apeka-level'] < 2){
  echo "<script> window.location.href='$link"."index.php';</script>";
}
require('..\template\sidebar.php');
$title = "PENILAIAN KARYAWAN";
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
                  <h3 class="mb-0">Penilaian Karyawan Bulan <?=date('m')?> Tahun <?=date('Y')?></h3>
                </div>
              </div>
            </div>
            <div class="col-xl-12 mb-5 mb-xl-0">
              <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fa fa-times mr-2"></i>Belum Dinilai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fa fa-check mr-2"></i>Telah Dinilai</a>
                    </li>
                </ul>
              </div>
              <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active table-responsive" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                          <table id="tb_belum" class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Karyawan</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tahun = date('Y');
                            $bulan = date('m');
                            $kode_divisi = $_SESSION['apeka-kode-divisi'];
                            $sql = "SELECT tb_kontrak.kode_karyawan, nama_karyawan, nama_divisi FROM tb_kontrak JOIN tb_karyawan ON tb_kontrak.kode_Karyawan=tb_karyawan.kode_karyawan JOIN tb_divisi ON tb_karyawan.kode_divisi=tb_divisi.kode_divisi WHERE NOT EXISTS (SELECT * FROM tb_nilai as tn WHERE tn.kode_karyawan=tb_karyawan.kode_karyawan AND tahun='$tahun' AND bulan='$bulan') AND tb_karyawan.kode_divisi='$kode_divisi'";

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
                                <td><a href="<?=$link?>nilai/form.php?id=<?=$row['kode_karyawan']?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> ISI NILAI</a></td>
                              </tr>
                            <?php 
                                endwhile;
                            endif;
                            ?>
                            </tbody>
                          </table>
                        </div>
                        <div class="tab-pane fade table-responsive" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                          <table id="tb_sudah" class="table align-items-center table-flush">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Karyawan</th>
                                <th scope="col">Nama Karyawan</th>
                                <th scope="col">Divisi</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tahun = date('Y');
                            $bulan = date('m');
                            $sql = "SELECT no_nilai, tb_nilai.kode_karyawan, nama_karyawan, nama_divisi FROM tb_nilai JOIN tb_karyawan ON tb_nilai.kode_karyawan=tb_karyawan.kode_karyawan JOIN tb_divisi ON tb_karyawan.kode_divisi=tb_divisi.kode_divisi WHERE tahun='$tahun' AND bulan='$bulan' AND tb_karyawan.kode_divisi='$kode_divisi'";
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
                                <td><a href="<?=$link?>nilai/form_edit.php?no_nilai=<?=$row['no_nilai']?>" class="btn btn-primary btn-sm"><i class="fa fa-pen"></i> UBAH NILAI</a></td>
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
    $('#tb_belum').DataTable();
    $('#tb_sudah').DataTable();
} );
</script>
<?php
require('..\template\foot.php');
?>