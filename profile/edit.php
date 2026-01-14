<?php
$title = "Edit Profile";
require '../layout/header.php';
require '../koneksi.php';

$user_id = $_SESSION['user_id'];
$success = "";
$error = "";

// Ambil data user
$stmt = $koneksi->prepare(
    "SELECT email, nama_lengkap, password FROM pengguna WHERE id = ? LIMIT 1"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_lengkap = trim($_POST['nama_lengkap']);
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi = $_POST['konfirmasi_password'];

    // Cek password lama
    if (!password_verify($password_lama, $user['password'])) {
        $error = "Password lama salah";
    } else {

        // Jika password baru diisi
        if (!empty($password_baru)) {

            if ($password_baru !== $konfirmasi) {
                $error = "Konfirmasi password tidak sama";
            } else {
                $hash = password_hash($password_baru, PASSWORD_DEFAULT);

                $stmt = $koneksi->prepare(
                    "UPDATE pengguna SET nama_lengkap = ?, password = ? WHERE id = ?"
                );
                $stmt->bind_param("ssi", $nama_lengkap, $hash, $user_id);
                $stmt->execute();
            }
        } else {
            // Hanya update nama
            $stmt = $koneksi->prepare(
                "UPDATE pengguna SET nama_lengkap = ? WHERE id = ?"
            );
            $stmt->bind_param("si", $nama_lengkap, $user_id);
            $stmt->execute();
        }

        $_SESSION['nama_lengkap'] = $nama_lengkap;
        // Flash message
        $_SESSION['success_message'] = "Profile berhasil diperbarui";

        // Redirect ke dashboard
        header("Location: ../index.php");
        exit;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">

                <h4 class="mb-3">Edit Profile</h4>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control"
                            value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control"
                            value="<?= htmlspecialchars($user['nama_lengkap']) ?>" required>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label>Password Lama</label>
                        <input type="password" name="password_lama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password Baru (opsional)</label>
                        <input type="password" name="password_baru" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" name="konfirmasi_password" class="form-control">
                    </div>

                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>

                </form>

            </div>
        </div>

    </div>
</div>

<?php require '../layout/footer.php'; ?>