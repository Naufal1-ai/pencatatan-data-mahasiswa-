<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat) 
              VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil disimpan!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
