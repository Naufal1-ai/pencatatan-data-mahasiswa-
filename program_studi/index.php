<?php
session_start();
require '../koneksi.php';

$title = "Program Studi";
require __DIR__ . '/../layout/header.php';

// proteksi login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// ambil data
$data = mysqli_query($koneksi, "SELECT * FROM program_studi ORDER BY id DESC");
?>

<div class="container mt-4">

    <h3>Data Program Studi</h3>
    <a href="tambah.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Tambah Program Studi
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Prodi</th>
                <th>Jenjang</th>
                <th>Akreditasi</th>
                <th>Keterangan</th>
                <th width="130">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                    <td><?= $row['jenjang'] ?></td>
                    <td><?= htmlspecialchars($row['akreditasi']) ?></td>
                    <td><?= htmlspecialchars($row['keterangan']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <a href="delete.php?id=<?= $row['id'] ?>" 
                           onclick="return confirm('Yakin hapus data?')"
                           class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

</main>
</body>
</html>
