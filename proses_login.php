<?php
session_start();

// Koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'antrian_klinik';

$conn = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        header("Location: login.php?error=empty");
        exit();
    }

    // Cek login untuk PASIEN
    $sql_pasien = "SELECT * FROM pasien WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql_pasien);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result_pasien = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_pasien) == 1) {
        $row = mysqli_fetch_assoc($result_pasien);
        
        // Verifikasi password
        if (password_verify($password, $row['Password'])) {
            // Password benar, buat session
            $_SESSION['user_id'] = $row['ID_Pasien'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['nama'] = $row['Nama_Pasien'];
            $_SESSION['role'] = 'pasien';
            
            // Redirect ke dashboard pasien
            header("Location: dashboard_pasien.php");
            exit();
        }
    }

    // Cek login untuk ADMIN
    $sql_admin = "SELECT * FROM admin WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql_admin);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result_admin = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_admin) == 1) {
        $row = mysqli_fetch_assoc($result_admin);
        
        // Verifikasi password
        if (password_verify($password, $row['Password'])) {
            // Password benar, buat session
            $_SESSION['user_id'] = $row['ID_Admin'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['nama'] = $row['Nama_Admin'];
            $_SESSION['role'] = 'admin';
            
            // Redirect ke dashboard admin
            header("Location: dashboard_admin.php");
            exit();
        }
    }

    // Cek login untuk USERS (termasuk dokter)
    $sql_users = "SELECT * FROM users WHERE nama = ? OR no_hp = ?";
    $stmt = mysqli_prepare($conn, $sql_users);
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result_users = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_users) == 1) {
        $row = mysqli_fetch_assoc($result_users);
        
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Password benar, buat session
            $_SESSION['user_id'] = $row['id_user'];
            $_SESSION['username'] = $row['nama'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];
            
            // Redirect berdasarkan role
            if ($row['role'] == 'dokter') {
                header("Location: dashboard_dokter.php");
            } else if ($row['role'] == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_pasien.php");
            }
            exit();
        }
    }

    // Jika sampai sini, berarti login gagal
    header("Location: login.php?error=invalid");
    exit();
}

mysqli_close($conn);
?>