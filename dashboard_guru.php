<?php
session_start();
if (!isset($_SESSION['guru_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a', // biru navy
                        secondary: '#f1f5f9', // abu terang
                        success: '#22c55e', // hijau untuk tombol
                        danger: '#ef4444', // merah untuk logout
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
            <li><a href="dashboard_guru.php" class="hover:underline transition"> Dashboard</a></li>
            <li><a href="CRUD/tambah_siswa.php" class="hover:underline transition"> Tambah Siswa</a></li>
            <li><a href="cetak_absensi.php" class="hover:underline transition"> Cetak Absensi</a></li>
            <li><a href="lihat_absensi.php" class="hover:underline transition"> Lihat Absensi</a></li>
        </ul>
        <a href="logout.php" class="bg-danger text-white px-4 py-2 rounded hover:bg-red-700 transition"> Logout</a>
    </nav>

    <!-- Konten Utama -->
    <main class="p-10">
        <div class="bg-white p-8 rounded shadow-md border border-gray-200">
            <h2 class="text-3xl font-bold text-primary mb-4">Halo, <?php echo $_SESSION['nama']; ?> 👋</h2>
            <p class="text-gray-600 text-lg">Selamat datang di dashboard guru. Gunakan menu di atas untuk mengelola data siswa dan absensi.</p>
        </div>
    </main>

</body>
</html>
