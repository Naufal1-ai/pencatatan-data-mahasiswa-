<?php
session_start();
require __DIR__ . '/../koneksi.php';

// proteksi login
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$title = "Program Studi";
require __DIR__ . '/../layout/header.php';

// tambah data
if (isset($_POST['simpan'])) {
    $nama_prodi = mysqli_real_escape_string($koneksi, $_POST['nama_prodi']);
    mysqli_query(
        $koneksi,
        "INSERT INTO program_studi (nama_prodi) VALUES ('$nama_prodi')"
    );
    header("Location: index.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM program_studi");
?>

<div class="container mt-4">
    <h3>Data Program Studi</h3>

    <form method="post" class="mb-3">
        <div class="input-group">
            <input type="text" name="nama_prodi" class="form-control" placeholder="Nama Program Studi" required>
            <button type="submit" name="simpan" class="btn btn-primary">Tambah</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Program Studi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_prodi']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>