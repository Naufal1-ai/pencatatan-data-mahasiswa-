<?php
require 'koneksi.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $pass1    = $_POST['password'];
    $pass2    = $_POST['confirm_password'];

    // validasi
    if ($pass1 !== $pass2) {
        $error = "Password dan ulangi password tidak sama";
    } else {

        // cek email
        $stmt = $koneksi->prepare("SELECT id FROM pengguna WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {

            $hash = password_hash($pass1, PASSWORD_DEFAULT);

            $update = $koneksi->prepare(
                "UPDATE pengguna SET password = ? WHERE email = ?"
            );
            $update->bind_param("ss", $hash, $email);
            $update->execute();

            $success = "Password berhasil diubah. Silakan login.";
        } else {
            $error = "Email tidak terdaftar";
        }
    }
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Lupa Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm" style="max-width:400px;width:100%">
        <div class="card-body p-4">

            <h4 class="text-center mb-3">Lupa Password</h4>

            <?php if ($error): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success text-center">
                    <?= htmlspecialchars($success) ?><br>
                    <a href="login.php">Kembali ke Login</a>
                </div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ulangi Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Reset Password</button>

            </form>

            <div class="text-center mt-3">
                <small>
                    Ingat password? <a href="login.php">Login</a>
                </small>
            </div>

        </div>
    </div>

</body>

</html>