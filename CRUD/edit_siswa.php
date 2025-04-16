<?php
session_start();
if (!isset($_SESSION['guru_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "smk_indonesia");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];
$query = "SELECT * FROM siswa WHERE id = $id";
$result = $conn->query($query);
$siswa = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">Edit Siswa</h2>
        <form action="proses_edit_siswa.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" value="<?= $siswa['id'] ?>">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" name="nis" value="<?= $siswa['nis'] ?>" required class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="<?= $siswa['nama'] ?>" required class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" required class="w-full border rounded px-4 py-2">
                    <option <?= $siswa['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option <?= $siswa['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                <input type="text" name="kelas" value="<?= $siswa['kelas'] ?>" required class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
                <?php if (!empty($siswa['foto'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($siswa['foto']) ?>" alt="Foto Siswa" class="h-32 mb-2 rounded shadow">
                <?php else: ?>
                    <p class="text-sm text-gray-500 italic">Tidak ada foto tersedia</p>
                <?php endif; ?>

                <label class="block text-sm font-medium text-gray-700 mt-2">Ganti Foto (biarkan kosong jika tidak ingin mengganti)</label>
                <input type="file" name="foto" accept="image/*" class="w-full border rounded px-4 py-2">
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
