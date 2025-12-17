<?php
include '../koneksi.php';

$nim = $_GET['nim'];

$query = "DELETE FROM mahasiswa WHERE nim='$nim'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href='../index.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href='../index.php';
          </script>";
}
