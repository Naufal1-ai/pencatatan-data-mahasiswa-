<?php
require '../koneksi.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM program_studi WHERE id='$id'");

header("Location: index.php");
exit;
