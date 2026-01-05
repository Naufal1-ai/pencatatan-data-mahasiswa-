<?php
session_start();
require '../koneksi.php';

$title = "Edit Program Studi";
require __DIR__ . '/../layout/header.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM program_studi WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    mysqli_query($koneksi, "
        UPDATE program_studi SET
        nama_prodi='{$_POST['nama_prodi']}',
        jenjang='{$_POST['jenjang']}',
        akreditasi='{$_POST['akreditasi']}',
        keterangan='{$_POST['keterangan']}'
        WHERE id='$id'
    ");
    header("Location: index.php");
}
?>

<div class="container mt-4">
    <h3>Edit Program Studi</h3>

    <form method="post">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label>Nama Program Studi</label>
            <input type="text" name="nama_prodi" value="<?= $row['nama_prodi'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jenjang</label>
            <select name="jenjang" class="form-control">
                <?php foreach (['D1', 'D2', 'D3', 'D4', 'S1', 'S2'] as $j): ?>
                    <option <?= $row['jenjang'] == $j ? 'selected' : '' ?>><?= $j ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Akreditasi</label>
            <input type="text" name="akreditasi" maxlength="12"
                value="<?= $row['akreditasi'] ?>" class="form-control">
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= $row['keterangan'] ?></textarea>
        </div>

        <button name="update" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</main>
</body>

</html>