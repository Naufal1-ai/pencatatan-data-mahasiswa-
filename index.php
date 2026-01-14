<?php
$title = "Beranda - Sistem Pencatatan Data Mahasiswa";
include 'layout/header.php';
?>

<?php if (isset($_SESSION['success_message'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            <?= htmlspecialchars($_SESSION['success_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<div class="container py-4">
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-primary">Sistem Pencatatan Data Mahasiswa</h1>
    </div>

    <div class="mb-4">
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>!
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6 mb-4">
            <div class="h-100 p-5 text-white bg-dark rounded-3 shadow-sm">
                <h2 class="fw-bold"><i class="bi bi-people-fill"></i> Data Mahasiswa</h2>
                <p>Kelola seluruh data mahasiswa, mulai dari informasi pribadi hingga data akademik. Anda dapat
                    menambah, mengubah, dan menghapus data mahasiswa dengan mudah.</p>
                <a href="mahasiswa/index.php" class="btn btn-outline-light">
                    <i class="bi bi-arrow-right-circle"></i> Kelola Mahasiswa
                </a>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="h-100 p-5 bg-white border rounded-3 shadow-sm">
                <h2 class="fw-bold"><i class="bi bi-book-fill"></i> Data Program Studi</h2>
                <p>Informasi lengkap mengenai program studi yang tersedia. Kelola data fakultas dan jurusan sebagai
                    referensi data mahasiswa.</p>
                <a href="program_studi/index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-right-circle"></i> Kelola Prodi
                </a>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>