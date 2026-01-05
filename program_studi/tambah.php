<?php
session_start();
require '../koneksi.php';

$title = "Tambah Program Studi";
require __DIR__ . '/../layout/header.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $akreditasi = $_POST['akreditasi'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "
        INSERT INTO program_studi 
        (nama_prodi, jenjang, akreditasi, keterangan)
        VALUES 
        ('$nama_prodi', '$jenjang', '$akreditasi', '$keterangan')
    ");

    header("Location: index.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Tambah Program Studi</h3>

    <form method="post">
        <div class="mb-3">
            <label>Nama Program Studi</label>
            <input type="text" name="nama_prodi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenjang</label>
            <select name="jenjang" class="form-control" required>
                <option value="">- Pilih -</option>
                <option>D1</option>
                <option>D2</option>
                <option>D3</option>
                <option>D4</option>
                <option>S1</option>
                <option>S2</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Akreditasi</label>
            <input type="text" name="akreditasi" class="form-control" maxlength="12" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</main>
</body>

</html>