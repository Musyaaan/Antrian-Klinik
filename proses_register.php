<?php
// proses_register.php
require_once 'config.php';

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = getConnection();
    
    // Ambil dan sanitasi input
    $nama_lengkap = mysqli_real_escape_string($conn, trim($_POST['nama_lengkap']));
    $nik = mysqli_real_escape_string($conn, trim($_POST['nik']));
    $nomor_hp = mysqli_real_escape_string($conn, trim($_POST['nomor_hp']));
    $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($nama_lengkap) || empty($nik) || empty($nomor_hp) || empty($alamat) || empty($username) || empty($password)) {
        header("Location: register.php?error=empty");
        exit();
    }

    // Validasi NIK (harus 16 digit)
    if (strlen($nik) != 16 || !ctype_digit($nik)) {
        header("Location: register.php?error=nik_invalid");
        exit();
    }

    // Validasi nomor HP (minimal 10 digit, maksimal 15 digit)
    if (strlen($nomor_hp) < 10 || strlen($nomor_hp) > 15 || !ctype_digit($nomor_hp)) {
        header("Location: register.php?error=hp_invalid");
        exit();
    }

    // Validasi username (minimal 4 karakter)
    if (strlen($username) < 4) {
        header("Location: register.php?error=username_short");
        exit();
    }

    // Validasi password (minimal 6 karakter)
    if (strlen($password) < 6) {
        header("Location: register.php?error=password_short");
        exit();
    }

    // Cek apakah NIK sudah terdaftar
    $sql_check_nik = "SELECT NIK FROM pasien WHERE NIK = ?";
    $stmt = mysqli_prepare($conn, $sql_check_nik);
    mysqli_stmt_bind_param($stmt, "s", $nik);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=nik_exists");
        exit();
    }

    // Cek apakah username sudah terdaftar
    $sql_check_username = "SELECT Username FROM pasien WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql_check_username);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=username_exists");
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data pasien baru
    $sql_insert = "INSERT INTO pasien (Nama_Pasien, NIK, Nomor_HP, Alamat, Username, Password) 
                   VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql_insert);
    mysqli_stmt_bind_param($stmt, "ssssss", $nama_lengkap, $nik, $nomor_hp, $alamat, $username, $hashed_password);
    
    if (mysqli_stmt_execute($stmt)) {
        // Registrasi berhasil
        $pasien_id = mysqli_insert_id($conn);
        
        // Optional: Insert juga ke tabel users untuk sistem unified
        $sql_insert_user = "INSERT INTO users (nama, no_hp, tanggal_lahir, alamat, password, role) 
                           VALUES (?, ?, NULL, ?, ?, 'pasien')";
        $stmt_user = mysqli_prepare($conn, $sql_insert_user);
        mysqli_stmt_bind_param($stmt_user, "ssss", $nama_lengkap, $nomor_hp, $alamat, $hashed_password);
        mysqli_stmt_execute($stmt_user);
        
        mysqli_close($conn);
        header("Location: register.php?success=registered");
        exit();
    } else {
        // Registrasi gagal
        mysqli_close($conn);
        header("Location: register.php?error=failed");
        exit();
    }
} else {
    // Jika bukan POST request, redirect ke halaman register
    header("Location: register.php");
    exit();
}
?>