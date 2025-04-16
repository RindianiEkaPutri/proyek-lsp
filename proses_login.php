<?php
session_start();
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Mengambil nilai role yang dipilih

    if ($role == 'guru') {
        // Cek data di tabel guru
        $stmt = $pdo->prepare("SELECT * FROM guru WHERE nama = ? AND nip = ?");
        $stmt->execute([$nama, $password]);
        $guru = $stmt->fetch();

        if ($guru) {
            $_SESSION['guru_id'] = $guru['id'];
            $_SESSION['nama'] = $guru['nama'];
            // Arahkan ke dashboard guru
            header("Location: dashboard_guru.php");
            exit();
        } else {
            echo "<script>
                    alert('Login gagal! Nama atau NIP salah.');
                    window.location.href = 'login.php';
                  </script>";
        }
    } elseif ($role == 'siswa') {
        // Cek data di tabel siswa
        $stmt = $pdo->prepare("SELECT * FROM siswa WHERE nama = ? AND nis = ?");
        $stmt->execute([$nama, $password]);
        $siswa = $stmt->fetch();

        if ($siswa) {
            $_SESSION['siswa_id'] = $siswa['id'];
            $_SESSION['nama'] = $siswa['nama'];
            // Arahkan ke dashboard siswa
            header("Location: dashboard_siswa.php");
            exit();
        } else {
            echo "<script>
                    alert('Login gagal! Nama atau NIS salah.');
                    window.location.href = 'login.php';
                  </script>";
        }
    }
}
?>

