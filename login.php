<?php
session_start();

// Jika sudah login
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit;
}

require 'koneksi.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $koneksi->prepare(
        "SELECT id, email, password, nama_lengkap 
         FROM pengguna 
         WHERE email = ? LIMIT 1"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // 🔑 Cek password
        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

            header("Location: index.php");
            exit;
        }
    }

    $error_message = "Email atau password salah";
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Mahasiswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm" style="width: 100%; max-width: 360px;">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <i class="bi bi-mortarboard-fill text-primary fs-1"></i>
                <h4 class="mt-2 mb-0">Login Mahasiswa</h4>
                <small class="text-muted">Sistem Informasi Akademik</small>
            </div>

            <?php if ($error_message): ?>
                <div class="alert alert-danger text-center py-2">
                    <?= htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="lupa_password.php" class="small">Lupa password?</a>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>

            <div class="text-center mt-3">
                <small>
                    Belum punya akun?
                    <a href="register.php">Buat akun</a>
                </small>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>