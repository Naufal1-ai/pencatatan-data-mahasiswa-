<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <a class="navbar-brand" href="#">Sistem Akademik</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah.php">Tambah Data</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu Lain
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Laporan</a></li>
                            <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Cari Mahasiswa" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Cari</button>
                </form>
            </div>

        </div>
    </nav>

    <!-- Content -->
    <div class="container mt-5">
        <h2 class="mb-4">Data Mahasiswa</h2>
        <a href="mahasiswa/tambah.php" class="btn btn-primary mb-3">
            <i class="bi bi-plus-circle"></i> Tambah Data Baru
        </a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM mahasiswa ORDER BY nim";
                    $result = mysqli_query($koneksi, $query);
                    $no = 1;

                    if (mysqli_num_rows($result) > 0) {
                        while ($data = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['nim']; ?></td>
                                <td><?php echo $data['nama_mhs']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($data['tgl_lahir'])); ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td>
                                    <a href="mahasiswa/edit.php?nim=<?php echo $data['nim']; ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="mahasiswa/delete.php?nim=<?php echo $data['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data <?php echo $data['nama_mhs']; ?>?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data mahasiswa</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>