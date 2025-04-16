<?php
session_start();
require 'koneksi.php';

// Pastikan siswa sudah login
if (!isset($_SESSION['siswa_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data dari form
$status_kehadiran = $_POST['status_kehadiran'];
$siswa_id = $_SESSION['siswa_id'];
$tanggal_hari_ini = date('Y-m-d');

// Cek apakah siswa sudah absen hari ini
$stmt = $pdo->prepare("SELECT * FROM absensi WHERE siswa_id = ? AND tanggal = ?");
$stmt->execute([$siswa_id, $tanggal_hari_ini]);
$absen = $stmt->fetch();

if ($absen) {
    // Jika sudah absen, beri peringatan
    echo "<script>
            alert('Anda sudah absen hari ini.');
            window.location.href = 'absen_hari_ini.php';
          </script>";
} else {
    // Jika belum absen, simpan data absen
    $stmt = $pdo->prepare("INSERT INTO absensi (siswa_id, tanggal, status_kehadiran) VALUES (?, ?, ?)");
    $stmt->execute([$siswa_id, $tanggal_hari_ini, $status_kehadiran]);

    // Redirect ke halaman absen dengan sukses
    echo "<script>
            alert('Absen berhasil!');
            window.location.href = 'absen_hari_ini.php';
          </script>";
}
?>
