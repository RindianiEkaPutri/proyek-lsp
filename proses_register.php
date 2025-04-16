<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    try {
        $stmt = $pdo->prepare("INSERT INTO guru (nip, nama, jenis_kelamin) VALUES (?, ?, ?)");
        $stmt->execute([$nip, $nama, $jenis_kelamin]);

        // Redirect ke halaman login setelah berhasil registrasi
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        echo "Gagal menyimpan data: " . $e->getMessage();
    }
} else {
    echo "Metode tidak diizinkan.";
}
?>
