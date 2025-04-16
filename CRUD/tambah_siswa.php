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

// Ambil data siswa dari database
$query = "SELECT * FROM siswa";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1e3a8a',
                        secondary: '#f1f5f9',
                        success: '#22c55e',
                        danger: '#ef4444',
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
            <span class="text-sm text-gray-200">Tambah Siswa</span>
        </div>
        <ul class="flex gap-6">
            <li><a href="../dashboard_guru.php" class="hover:underline transition">Dashboard</a></li>
            <li><a href="tambah_siswa.php" class="underline font-semibold">Tambah Siswa</a></li>
            <li><a href="../cetak_absensi.php" class="hover:underline transition">Cetak Absensi</a></li>
            <li><a href="../lihat_absensi.php" class="hover:underline transition">Lihat Absensi</a></li>
        </ul>
        <a href="../logout.php" class="bg-danger px-4 py-2 rounded hover:bg-red-700 transition">Logout</a>
    </nav>

    <!-- Konten -->
    <main class="p-10">
        <div class="bg-white p-6 rounded-xl shadow border border-gray-200 max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-primary mb-6">Tambah Siswa</h2>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="mb-4 p-4 <?php echo $_SESSION['message_type'] === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> rounded">
                    <?php echo $_SESSION['message']; ?>
                    <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                </div>
            <?php endif; ?>

            <form action="proses_tambah_siswa.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                    <input type="text" id="nis" name="nis" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-primary focus:outline-none">
                </div>
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" id="nama" name="nama" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-primary focus:outline-none">
                </div>
                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-primary focus:outline-none">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/*" class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-primary focus:outline-none">
                </div>
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <input type="text" id="kelas" name="kelas" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-primary focus:outline-none">
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-success text-white py-2 rounded-lg hover:bg-green-600 transition">Simpan</button>
                </div>
            </form>
        </div>

        <!-- Tabel Siswa -->
        <div class="bg-white p-6 mt-10 rounded-xl shadow border border-gray-200 max-w-6xl mx-auto">
            <h2 class="text-xl font-bold text-primary mb-4">Daftar Siswa</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-secondary text-gray-700">
                        <tr>
                            <th class="px-4 py-2 border-b">NIS</th>
                            <th class="px-4 py-2 border-b">Nama</th>
                            <th class="px-4 py-2 border-b">Jenis Kelamin</th>
                            <th class="px-4 py-2 border-b">Kelas</th>
                            <th class="px-4 py-2 border-b">Foto</th>
                            <th class="px-4 py-2 border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="border-b">
                                <td class="px-4 py-2"><?php echo $row['nis']; ?></td>
                                <td class="px-4 py-2"><?php echo $row['nama']; ?></td>
                                <td class="px-4 py-2"><?php echo $row['jenis_kelamin']; ?></td>
                                <td class="px-4 py-2"><?php echo $row['kelas']; ?></td>
                                <td class="px-4 py-2">
                                    <?php if ($row['foto']) : ?>
                                        <img src="../uploads/<?php echo $row['foto']; ?>" alt="Foto" class="w-16 h-16 object-cover rounded">
                                    <?php else: ?>
                                        Tidak Ada
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <a href="edit_siswa.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="hapus_siswa.php?id=<?php echo $row['id']; ?>" class="text-danger hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>

<?php $conn->close(); ?>
