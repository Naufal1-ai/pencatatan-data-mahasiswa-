<?php
$title = "Edit Program Studi";
require '../layout/header.php';
require '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM program_studi WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $akreditasi = $_POST['akreditasi'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE program_studi SET
        nama_prodi='$nama',
        jenjang='$jenjang',
        akreditasi='$akreditasi',
        keterangan='$keterangan'
        WHERE id='$id'");

    header("Location: index.php");
    exit;
}
?>

<div class="container mt-4">
    <h3>Edit Program Studi</h3>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Program Studi</label>
            <input type="text" name="nama_prodi" class="form-control"
                value="<?= htmlspecialchars($data['nama_prodi']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Jenjang</label>
            <select name="jenjang" class="form-select">
                <?php
                $jenjang = ['D2', 'D3', 'D4', 'S1', 'S2'];
                foreach ($jenjang as $j) {
                    $selected = ($data['jenjang'] == $j) ? 'selected' : '';
                    echo "<option $selected>$j</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Akreditasi</label>
            <input type="text" name="akreditasi" class="form-control"
                value="<?= htmlspecialchars($data['akreditasi']) ?>">
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= htmlspecialchars($data['keterangan']) ?></textarea>
        </div>

        <button name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php require '../layout/footer.php'; ?>