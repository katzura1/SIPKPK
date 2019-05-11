<?php
require('koneksi.php');
require('template\head.php');
if(isset($_POST['btn-password'])){
	$kode_karyawan = $_SESSION['apeka-kode-karyawan'];
	$new_pw = $_POST['new_pw'];
	$old_pw = $_POST['old_pw'];

	$sql = "SELECT * FROM tb_karyawan WHERE kode_karyawan='$kode_karyawan'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0){
		$password = mysqli_fetch_assoc($result)['password'];

		if(password_verify($old_pw, $password)){
			$new_pw = password_hash($new_pw, PASSWORD_DEFAULT);
			$sql = "UPDATE tb_karyawan SET password='$new_pw' WHERE kode_karyawan='$kode_karyawan'";
			if(mysqli_query($conn, $sql)){
				echo "
				<script>
				alert('Password berhasil diubah!');
				window.location.href='karyawan/profile.php';
				</script>";
			}else{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}else{
			echo "
			<script>
			alert('Password Lama SalaH!');
			window.location.href='karyawan/profile.php';
			</script>";
		}
	}else{
		echo "
		<script>
		window.location.href='karyawan/profile.php';
		</script>";
	}
}else{
	echo "
		<script>
		window.location.href='karyawan/profile.php';
		</script>";
}
require('template\js.php');
require('template\foot.php');
?>