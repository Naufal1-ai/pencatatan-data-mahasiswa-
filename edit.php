<?php
include 'koneksi.php';

// Ambil NIM dari URL
$nim = $_GET['nim'];

// PROSES UPDATE DATA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama_mhs = $_POST['nama_mhs'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE mahasiswa SET 
              nama_mhs='$nama_mhs', 
              tgl_lahir='$tgl_lahir', 
              alamat='$alamat' 
              WHERE nim='$nim'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($koneksi) . "');
              </script>";
    }
}

// Ambil data untuk ditampilkan di form
$query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h4>Form Edit Data Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" name="nim" class="form-control" value="<?php echo $data['nim']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa</label>
                                <input type="text" name="nama_mhs" class="form-control" value="<?php echo $data['nama_mhs']; ?>" required maxlength="30">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $data['tgl_lahir']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="4" required><?php echo $data['alamat']; ?></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning">Update</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>