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

// Pastikan ID ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil foto lama
    $result = $conn->query("SELECT foto FROM siswa WHERE id = $id");

    if ($result) {
        $row = $result->fetch_assoc();
        if ($row && $row['foto']) {
            $path = "../uploads/" . $row['foto'];
            if (file_exists($path)) {
                unlink($path); // hapus foto dari folder
            }
        }

        // Hapus data dari tabel absensi yang terkait dengan siswa
        $conn->query("DELETE FROM absensi WHERE siswa_id = $id");

        // Hapus data siswa dari database
        if ($conn->query("DELETE FROM siswa WHERE id = $id") === TRUE) {
            $_SESSION['message'] = "Siswa berhasil dihapus."; // Set message session
            $_SESSION['message_type'] = "success"; // Set message type
        } else {
            $_SESSION['message'] = "Terjadi kesalahan saat menghapus siswa.";
            $_SESSION['message_type'] = "error"; // Set error message type
        }
    } else {
        $_SESSION['message'] = "Siswa tidak ditemukan.";
        $_SESSION['message_type'] = "error"; // Set error message type
    }
} else {
    $_SESSION['message'] = "ID tidak valid.";
    $_SESSION['message_type'] = "error"; // Set error message type
}

header("Location: tambah_siswa.php");
$conn->close();
?>
