<?php
// config.php - File konfigurasi database

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'antrian_klinik');

// Fungsi koneksi database
function getConnection() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($conn, "utf8mb4");
    return $conn;
}

// Fungsi untuk cek session login
function checkLogin() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
}

// Fungsi untuk cek role tertentu
function checkRole($allowed_roles = []) {
    checkLogin();
    
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        header("Location: unauthorized.php");
        exit();
    }
}

// Fungsi logout
function logout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>