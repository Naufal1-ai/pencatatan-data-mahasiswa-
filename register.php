<?php
session_start();
require 'koneksi.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = trim($_POST['nama_lengkap']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak cocok";
    } else {

        // cek email sudah terdaftar
        $cek = $koneksi->prepare("SELECT id FROM pengguna WHERE email = ?");
        $cek->bind_param("s", $email);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $error = "Email sudah terdaftar";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $koneksi->prepare(
                "INSERT INTO pengguna (nama_lengkap, email, password) VALUES (?, ?, ?)"
            );
            $stmt->bind_param("sss", $nama, $email, $hash);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error = "Gagal membuat akun";
            }
        }
    }
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Buat Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm" style="max-width:400px;width:100%">
        <div class="card-body p-4">

            <h4 class="text-center mb-3">Buat Akun</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="confirm" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Daftar</button>
            </form>

            <div class="text-center mt-3">
                <small>Sudah punya akun? <a href="login.php">Login</a></small>
            </div>

        </div>
    </div>

</body>

</html>