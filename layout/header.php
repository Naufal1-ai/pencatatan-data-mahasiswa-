<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $current_path = dirname($_SERVER['SCRIPT_NAME']);

    if (
        strpos($current_path, '/mahasiswa') !== false ||
        strpos($current_path, '/program_studi') !== false
    ) {
        $login_path = '../login.php';
    } else {
        $login_path = 'login.php';
    }

    header('Location: ' . $login_path);
    exit();
}

// Default title
if (!isset($title)) {
    $title = "Sistem Pencatatan Data Mahasiswa";
}

// Base path navbar
$current_path = dirname($_SERVER['SCRIPT_NAME']);

if (
    strpos($current_path, '/mahasiswa') !== false ||
    strpos($current_path, '/program_studi') !== false
) {
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
    <title><?= htmlspecialchars($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= $base_path ?>/index.php">
                <i class="bi bi-mortarboard-fill"></i> SIAKAD
            </a>

            <div class="collapse navbar-collapse show">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>/index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>/mahasiswa/index.php">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base_path ?>/program_studi/index.php">Program Studi</a>
                    </li>
                </ul>

                <span class="text-white me-3">
                    <?= htmlspecialchars($_SESSION['nama_lengkap']) ?>
                </span>
                <a href="<?= $base_path ?>/profile/edit.php" class="btn btn-outline-light btn-sm me-2">
                    Edit Profile
                </a>

                <a href="<?= $base_path ?>/logout.php" class="btn btn-outline-light btn-sm">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <main class="flex-fill container mt-4">