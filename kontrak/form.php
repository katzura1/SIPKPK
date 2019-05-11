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

if(isset($_GET['id'])){
  //mode edit data
  $id_kontrak = $_GET['id'];
  $action = $link.'edit_kontrak.php';
  $title = "EDIT KONTRAK";
  $sql = "SELECT * FROM tb_kontrak JOIN tb_karyawan ON tb_kontrak.kode_karyawan=tb_karyawan.kode_karyawan WHERE id='$id_kontrak'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) == 0){
    echo "
    <script>window.location.href='list.php';</script>
    ";
  }
  $row = mysqli_fetch_assoc($result);
  
  $kode_karyawan = $row['kode_karyawan'];
  $nama_karyawan = $row['nama_karyawan'];
  $status = $row['status'];
  echo $status;
  $mulai_kerja = $row['mulai_kerja'];

}else{
  //mode tambah data
  $action = $link.'tambah_kontrak.php';
  $title = "TAMBAH KONTRAK";
  $id_kontrak = '';
  $kode_karyawan = '';
  $nama_karyawan = '';
  $status = '';
  $mulai_kerja = date('d/m/Y');
}
require('..\template\topbar.php');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
    <div class="header-body">
     <div class="row">
      <div class="col-xl-12 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">FORM KONTRAK KARYAWAN</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=$link?>kontrak/list.php" class="btn btn-sm btn-primary">Back</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="<?=$action?>" method="POST">
                <h6 class="heading-small text-muted mb-4">Data Kontrak</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-8">
                      <div class="form-group focused">
                        <label class="form-control-label">Pilih Karyawan</label>
                        <select id="select-karyawan" class="form-control form-control-focus">
                          <option disabled selected>--PILIH--</option>
                        <?php
                        $sql = "SELECT kode_karyawan, nama_karyawan FROM tb_karyawan WHERE NOT EXISTS (SELECT * FROM tb_kontrak WHERE tb_kontrak.kode_karyawan=tb_karyawan.kode_karyawan) OR kode_karyawan='$kode_karyawan'";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0):
                          while($row = mysqli_fetch_assoc($result)):
                        ?>
                          <option value="<?=$row['kode_karyawan']?>">
                            <?=$row['nama_karyawan'].' - '.$row['kode_karyawan']?>
                          </option>
                        <?php
                          endwhile;
                        endif;
                        ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label">Kode Karyawan</label>
                        <input type="text" name="kode_karyawan" id="kode_karyawan" class="form-control" required style="caret-color: transparent; background-color: #e9ecef ;!important;" value="<?=$kode_karyawan?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group focused">
                        <label class="form-control-label">Status</label>
                        <select name="status" class="form-control" required>
                          <option value="kontrak" <?=$status=='kontrak'?'selected':''?>>Kontrak</option>
                          <option value="tetap" <?=$status=='tetap'?'selected':''?>>Tetap</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-8">
                      <div class="form-group focused">
                        <label class="form-control-label">Tanggal Masuk</label>
                        <input class="form-control datepicker" name="mulai_kerja" type="text" value="<?=date('d/m/Y', strtotime($mulai_kerja))?>">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group focused">
                        <label class="form-control-label">Lama Kerja</label>
                        <input class="form-control" type="text" name="lama_kerja" value="1 Tahun" readonly>
                      </div>
                    </div>
                    <input type="hidden" name="id_kontrak" value="<?=$id_kontrak?>">
                  </div>
                  <button class="btn btn-primary" name="btn-kontrak">SIMPAN</button>
                </div>
              </form>
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
<script type="text/javascript">
$(document).ready(function() {
    //turn on select2 display on select karyawan
    $('#select-karyawan').select2();
    //store value on kode karyawan when select option change
    $('#select-karyawan').on('change', function(){
      $('#kode_karyawan').val(this.value);
    });
    //mencegah kode karyawan diubah secara manual
    $("#kode_karyawan").on('keydown paste', function(e){
        e.preventDefault();
    });
});
</script>
<?php
require('..\template\foot.php');
?>