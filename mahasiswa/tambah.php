<?php
include '../koneksi.php';

// PROSES SIMPAN DATA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan bersihkan dari karakter berbahaya
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama_mhs = mysqli_real_escape_string($koneksi, $_POST['nama_mhs']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    // Cek apakah NIM sudah ada
    $cek_query = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $cek_result = mysqli_query($koneksi, $cek_query);

    if (mysqli_num_rows($cek_result) > 0) {
        echo "<script>
                alert('NIM sudah terdaftar! Gunakan NIM lain.');
              </script>";
    } else {
        $query = "INSERT INTO mahasiswa (nim, nama_mhs, tgl_lahir, alamat) 
                  VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Data berhasil disimpan!');
                    window.location.href='index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . mysqli_error($koneksi) . "');
                  </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Form Tambah Data Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" id="formMahasiswa">
                            <div class="mb-3">
                                <label class="form-label">NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control" required maxlength="11"
                                    placeholder="Contoh: 2411xxxxxx" pattern="[0-9]+"
                                    title="NIM harus berupa angka">
                                <small class="text-muted">Maksimal 11 digit angka</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label>
                                <input type="text" name="nama_mhs" class="form-control" required maxlength="30"
                                    placeholder="Contoh: Naufal Khalil Aldeza">
                                <small class="text-muted">Maksimal 30 karakter</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tgl_lahir" class="form-control" required
                                    max="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control" rows="4" required
                                    placeholder="Masukkan alamat lengkap"></textarea>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="cd../index.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Validasi form sebelum submit
        document.getElementById('formMahasiswa').addEventListener('submit', function(e) {
            var nim = document.getElementsByName('nim')[0].value;

            // Cek apakah NIM hanya berisi angka
            if (!/^\d+$/.test(nim)) {
                e.preventDefault();
                alert('NIM harus berupa angka!');
                return false;
            }

            // Konfirmasi sebelum submit
            if (!confirm('Apakah data yang dimasukkan sudah benar?')) {
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>

</html>