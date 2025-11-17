<?php
session_start();
require_once 'config.php';

// Cek apakah user sudah login dan role-nya pasien
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'pasien') {
    header("Location: login.php");
    exit();
}

$conn = getConnection();
$user_id = $_SESSION['user_id'];
$nama = $_SESSION['nama'];

// Ambil data antrian pasien
$sql = "SELECT a.*, d.nama_dokter, p.nama_poli 
        FROM antrian a 
        LEFT JOIN dokter d ON a.id_dokter = d.id_dokter 
        LEFT JOIN poli p ON a.id_poli = p.id_poli 
        WHERE a.id_user = ? 
        ORDER BY a.tanggal_kunjungan DESC 
        LIMIT 5";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien - Antrian Klinik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h1 {
            font-size: 24px;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid white;
            padding: 8px 20px;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .welcome-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .welcome-card h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: #666;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu-item {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s;
            text-decoration: none;
            color: #333;
        }

        .menu-item:hover {
            transform: translateY(-5px);
        }

        .menu-item .icon {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .menu-item h3 {
            margin-bottom: 10px;
        }

        .antrian-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .antrian-card h3 {
            color: #333;
            margin-bottom: 20px;
        }

        .antrian-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .antrian-item:last-child {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        .status-diperiksa {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
        }

        .status-batal {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>🏥 Antrian Klinik</h1>
        <div class="user-info">
            <span>👤 <?php echo htmlspecialchars($nama); ?></span>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h2>Selamat Datang, <?php echo htmlspecialchars($nama); ?>!</h2>
            <p>Kelola antrian dan riwayat kunjungan Anda dengan mudah</p>
        </div>

        <div class="menu-grid">
            <a href="daftar_antrian.php" class="menu-item">
                <div class="icon">📋</div>
                <h3>Daftar Antrian</h3>
                <p>Buat antrian baru</p>
            </a>
            
            <a href="antrian_saya.php" class="menu-item">
                <div class="icon">🎫</div>
                <h3>Antrian Saya</h3>
                <p>Lihat antrian aktif</p>
            </a>
            
            <a href="riwayat.php" class="menu-item">
                <div class="icon">📜</div>
                <h3>Riwayat</h3>
                <p>Riwayat kunjungan</p>
            </a>
            
            <a href="profil.php" class="menu-item">
                <div class="icon">👤</div>
                <h3>Profil</h3>
                <p>Kelola profil Anda</p>
            </a>
        </div>

        <div class="antrian-card">
            <h3>Antrian Terakhir</h3>
            
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="antrian-item">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <strong>No. Antrian: <?php echo $row['nomor_antrian']; ?></strong><br>
                                <span style="color: #666;">
                                    <?php echo $row['nama_poli']; ?> - Dr. <?php echo $row['nama_dokter']; ?>
                                </span><br>
                                <span style="color: #999; font-size: 14px;">
                                    <?php echo date('d M Y', strtotime($row['tanggal_kunjungan'])); ?>
                                </span>
                            </div>
                            <div>
                                <span class="status-badge status-<?php echo $row['status']; ?>">
                                    <?php echo strtoupper($row['status']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="color: #999; text-align: center; padding: 20px;">
                    Belum ada antrian. Silakan daftar antrian baru.
                </p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>