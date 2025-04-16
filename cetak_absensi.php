<?php
session_start();
if (!isset($_SESSION['guru_id'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "smk_indonesia");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data absensi
$query = "SELECT absensi.id, absensi.siswa_id, absensi.tanggal, absensi.status_kehadiran, siswa.nama 
          FROM absensi
          JOIN siswa ON absensi.siswa_id = siswa.id
          ORDER BY absensi.tanggal DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Data Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',     // biru navy
                        secondary: '#f1f5f9',   // abu terang
                        success: '#22c55e',     // hijau tombol
                        danger: '#ef4444',      // merah tombol
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
            <span class="text-sm text-gray-200">Cetak Data Absensi</span>
        </div>
        <ul class="flex gap-6">
            <li><a href="dashboard_guru.php" class="hover:underline transition">Dashboard</a></li>
            <li><a href="CRUD/tambah_siswa.php" class="hover:underline transition">Tambah Siswa</a></li>
            <li><a href="cetak_absensi.php" class="underline font-semibold">Cetak Absensi</a></li>
            <li><a href="lihat_absensi.php" class="hover:underline transition">Lihat Absensi</a></li>
        </ul>
        <a href="logout.php" class="bg-danger px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
    </nav>

    <!-- Konten Utama -->
    <main class="p-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-primary">Data Absensi Siswa</h2>
            <a href="cetak_absensi_pdf.php" target="_blank"
               class="bg-success text-white px-4 py-2 rounded hover:bg-green-700 transition">
               🧾 Cetak PDF
            </a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border border-gray-200 overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 text-sm text-left">
                <thead class="bg-secondary text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Siswa</th>
                        <th class="px-4 py-2 border">Tanggal</th>
                        <th class="px-4 py-2 border">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center"><?= $no++; ?></td>
                            <td class="px-4 py-2 border"><?= $row['nama']; ?></td>
                            <td class="px-4 py-2 border text-center"><?= $row['tanggal']; ?></td>
                            <td class="px-4 py-2 border text-center"><?= $row['status_kehadiran']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>

<?php
$conn->close();
?>
