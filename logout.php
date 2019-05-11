<?php
require('koneksi.php');
session_destroy();
echo "<script>window.location.href='login.php';</script>";
?>