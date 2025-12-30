<?php
// Cek apakah session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    // Tentukan path ke login.php berdasarkan lokasi file saat ini
    $current_path = dirname($_SERVER['SCRIPT_NAME']);
    if (strpos($current_path, '/mahasiswa') !== false || strpos($current_path, '/prodi') !== false) {
        $login_path = '../login.php';
    } else {
        $login_path = 'login.php';
    }
    header('Location: ' . $login_path);
    exit();
}

// Set default title jika tidak ada
if (!isset($title)) {
    $title = "Sistem Pencatatan Data Mahasiswa";
}

// Tentukan base path untuk navigasi
$current_path = dirname($_SERVER['SCRIPT_NAME']);
if (strpos($current_path, '/mahasiswa') !== false || strpos($current_path, '/prodi') !== false) {
    $base_path = '..';
} else {
    $base_path = '.';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $base_path; ?>/index.php">
                <i class="bi bi-mortarboard-fill"></i> SIAKAD
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_path; ?>/index.php">
                            <i class="bi bi-house"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_path; ?>/mahasiswa/index.php">
                            <i class="bi bi-people"></i> Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_path; ?>/program_studi/index.php">
                            <i class="bi bi-book"></i> Program Studi
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <i class="bi bi-person-circle me-2"></i>
                    <span class="me-3"><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></span>
                    <a href="<?php echo $base_path; ?>/logout.php" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Start -->
    <main class="flex-fill">