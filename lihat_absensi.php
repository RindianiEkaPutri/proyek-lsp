<?php
session_start();
if (!isset($_SESSION['guru_id'])) {
    header("Location: login.php");
    exit();
}

require 'koneksi.php';

// Ambil data absensi
$stmt = $pdo->prepare("SELECT absensi.*, siswa.nama AS siswa_nama FROM absensi JOIN siswa ON absensi.siswa_id = siswa.id ORDER BY absensi.tanggal DESC");
$stmt->execute();
$absensi = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lihat Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',     // biru navy
                        secondary: '#f1f5f9',   // abu terang
                        success: '#22c55e',     // hijau untuk tombol
                        danger: '#ef4444',      // merah untuk logout
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
            <span class="text-sm text-gray-200">Dashboard Guru</span>
        </div>
        <ul class="flex gap-6">
            <li><a href="dashboard_guru.php" class="hover:underline transition">Dashboard</a></li>
            <li><a href="CRUD/tambah_siswa.php" class="hover:underline transition">Tambah Siswa</a></li>
            <li><a href="cetak_absensi.php" class="hover:underline transition">Cetak Absensi</a></li>
            <li><a href="lihat_absensi.php" class="underline font-semibold">Lihat Absensi</a></li>
        </ul>
        <a href="logout.php" class="bg-danger text-white px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
    </nav>

    <!-- Konten Utama -->
    <main class="p-10">
        <h2 class="text-2xl font-bold text-primary mb-6">Data Kehadiran Siswa</h2>

        <div class="bg-white rounded shadow-md border border-gray-200 overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-secondary text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left border">No</th>
                        <th class="px-4 py-2 text-left border">Nama Siswa</th>
                        <th class="px-4 py-2 text-left border">Tanggal</th>
                        <th class="px-4 py-2 text-left border">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($absensi as $index => $data): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center"><?= $index + 1; ?></td>
                            <td class="px-4 py-2 border"><?= $data['siswa_nama']; ?></td>
                            <td class="px-4 py-2 border text-center"><?= $data['tanggal']; ?></td>
                            <td class="px-4 py-2 border text-center"><?= $data['status_kehadiran']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
