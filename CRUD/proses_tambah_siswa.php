<?php
session_start();
if (!isset($_SESSION['guru_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];

    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $folder = "../uploads/";
        $namaFile = uniqid() . '-' . basename($_FILES['foto']['name']);
        $target = $folder . $namaFile;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = $namaFile;
        }
    }

    $conn = new mysqli("localhost", "root", "", "smk_indonesia");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $query = "INSERT INTO siswa (nis, nama, jenis_kelamin, kelas, foto) VALUES ('$nis', '$nama', '$jenis_kelamin', '$kelas', '$foto')";

    if ($conn->query($query) === TRUE) {
        header("Location: tambah_siswa.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
