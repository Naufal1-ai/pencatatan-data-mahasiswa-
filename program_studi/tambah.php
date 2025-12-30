<?php
$title = "Tambah Program Studi";
require '../layout/header.php';
require '../koneksi.php';

if (isset($_POST['simpan'])) {

    $sql = "INSERT INTO program_studi 
            (nama_prodi, jenjang, akreditasi, keterangan)
            VALUES (:nama, :jenjang, :akreditasi, :keterangan)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nama' => $_POST['nama_prodi'],
        'jenjang' => $_POST['jenjang'],
        'akreditasi' => $_POST['akreditasi'],
        'keterangan' => $_POST['keterangan']
    ]);

    header("Location: index.php");
    exit;
}
?>
