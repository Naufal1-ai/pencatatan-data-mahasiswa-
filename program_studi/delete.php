<?php
session_start();
require '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM program_studi WHERE id='$id'");

header("Location: index.php");
exit;
