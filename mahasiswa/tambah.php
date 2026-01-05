<?php
include '../koneksi.php';

// ambil data program studi
$prodi = mysqli_query($koneksi, "SELECT * FROM program_studi");

// PROSES SIMPAN DATA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $id_prodi = mysqli_real_escape_string($koneksi, $_POST['id_prodi']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // cek NIM
    $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIM sudah terdaftar');</script>";
    } else {
        $query = mysqli_query($koneksi, "
            INSERT INTO mahasiswa 
            (nim, nama_mhs, program_studi_id, tgl_lahir, alamat)
            VALUES 
            ('$nim', '$nama_mhs', '$id_prodi', '$tgl_lahir', '$alamat')
        ");

        if ($query) {
            echo "<script>
                alert('Data berhasil disimpan');
                window.location='index.php';
            </script>";
        } else {
            echo mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Tambah Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form method="post">

                    <div class="mb-3">
                        <label>NIM</label>
                        <input type="text" name="nim" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Mahasiswa</label>
                        <input type="text" name="nama_mhs" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Program Studi</label>
                        <select name="id_prodi" class="form-control" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <?php while ($p = mysqli_fetch_assoc($prodi)) : ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= $p['nama_prodi'] ?> (<?= $p['jenjang'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>

                </form>
            </div>
        </div>
    </div>
</body>

</html>