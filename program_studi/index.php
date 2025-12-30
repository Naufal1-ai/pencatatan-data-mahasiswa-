<?php
$title = "Data Program Studi - Sistem Pencatatan Data Mahasiswa";
include '../layout/header.php';

// Include koneksi database
require '../koneksi.php';

// Query untuk mengambil data program studi
try {
    $sql = "SELECT * FROM program_studi ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $program_studi = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $program_studi = [];
    $error_message = "Error: " . $e->getMessage();
}
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-book-fill"></i> Data Program Studi</h2>
        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Program Studi
        </a>
    </div>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Program Studi</th>
                            <th>Jenjang</th>
                            <th>Akreditasi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($program_studi) > 0): ?>
                            <?php $no = 1;
                            foreach ($program_studi as $ps): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($ps['nama_prodi'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($ps['jenjang'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($ps['akreditasi'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($ps['keterangan'] ?? '-'); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $ps['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="hapus.php?id=<?php echo $ps['id']; ?>" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data program studi</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../layout/footer.php'; ?>