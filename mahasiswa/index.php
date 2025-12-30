<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$title = "Data Mahasiswa";
require '../layout/header.php';
require '../koneksi.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Mahasiswa</h3>
        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Mahasiswa
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
            $no = 1;

            if (mysqli_num_rows($query) == 0) {
                echo "<tr><td colspan='5' class='text-center'>Data belum ada</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nim']) ?></td>
                        <td><?= htmlspecialchars($row['nama_mhs']) ?></td>
                        <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
                        <td>
                            <a href="edit.php?nim=<?= $row['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?nim=<?= $row['nim'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin hapus data?')">Hapus</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php require '../layout/footer.php'; ?>