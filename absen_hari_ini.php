<?php
session_start();
if (!isset($_SESSION['siswa_id'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

$siswa_id = $_SESSION['siswa_id'];
$tanggal_hari_ini = date('Y-m-d');

$stmt = $pdo->prepare("SELECT * FROM absensi WHERE siswa_id = ? AND tanggal = ?");
$stmt->execute([$siswa_id, $tanggal_hari_ini]);
$absen = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absen Hari Ini</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', // biru navy
                        secondary: '#f1f5f9', // abu terang
                        success: '#22c55e', // hijau
                        danger: '#ef4444', // merah
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-secondary min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-primary text-white shadow-md px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <h1 class="text-2xl font-bold">SMK Indonesia</h1>
            <span class="text-sm text-gray-200">Dashboard Siswa</span>
        </div>
        <ul class="flex gap-6">
            <li><a href="dashboard_siswa.php" class="hover:underline transition">Dashboard</a></li>
            <li><a href="absen_hari_ini.php" class="hover:underline transition">Absen Hari Ini</a></li>
        </ul>
        <a href="logout.php" class="bg-danger text-white px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
    </nav>

    <!-- Konten Utama -->
    <main class="p-10">
        <div class="bg-white p-8 rounded shadow-md border border-gray-200 max-w-xl mx-auto">
            <h2 class="text-2xl font-bold text-primary mb-6">Absen Hari Ini</h2>

            <?php if ($absen): ?>
                <div class="bg-green-100 text-green-800 p-4 rounded border border-green-200">
                    <p>Anda sudah absen hari ini dengan status: <strong><?php echo $absen['status_kehadiran']; ?></strong>.</p>
                </div>
            <?php else: ?>
                <form action="proses_absen.php" method="POST" class="space-y-6">
                    <div>
                        <label for="status_kehadiran" class="block text-sm font-medium text-gray-700 mb-1">Status Kehadiran</label>
                        <select name="status_kehadiran" id="status_kehadiran" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            <option value="Hadir">Hadir</option>
                            <option value="Sakit">Sakit</option>
                            <option value="Izin">Izin</option>
                            <option value="Alpa">Alpa</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-success hover:bg-green-600 text-white py-2 px-4 rounded-lg transition duration-200">
                        Absen Sekarang
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>
