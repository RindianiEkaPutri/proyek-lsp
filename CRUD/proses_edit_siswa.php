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

$id = $_POST['id'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$kelas = $_POST['kelas'];

$fotoUpdate = '';
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $folder = "../uploads/";
    $namaFile = uniqid() . '-' . basename($_FILES['foto']['name']);
    $target = $folder . $namaFile;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
        $fotoUpdate = ", foto='$namaFile'";
    }
}

$query = "UPDATE siswa SET nis='$nis', nama='$nama', jenis_kelamin='$jenis_kelamin', kelas='$kelas' $fotoUpdate WHERE id=$id";

if ($conn->query($query) === TRUE) {
    header("Location: tambah_siswa.php");
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
