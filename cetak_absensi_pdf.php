<?php
require('fpdf186/fpdf.php');  // Pastikan kamu telah menginstal FPDF atau memasukkan file fpdf.php

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "smk_indonesia");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data absensi dan nama siswa
$query = "SELECT a.id, a.siswa_id, a.tanggal, a.status_kehadiran, s.nama 
          FROM absensi a 
          JOIN siswa s ON a.siswa_id = s.id
          ORDER BY a.tanggal DESC";
$result = $conn->query($query);

// Inisialisasi objek FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Header tabel
$pdf->Cell(20, 10, 'ID', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama Siswa', 1, 0, 'C');
$pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C');
$pdf->Cell(50, 10, 'Status Kehadiran', 1, 1, 'C');

// Data absensi
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['id'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['nama'], 1, 0, 'L');  // Nama siswa
    $pdf->Cell(40, 10, $row['tanggal'], 1, 0, 'C');
    $pdf->Cell(50, 10, $row['status_kehadiran'], 1, 1, 'C');
}

// Output PDF
$pdf->Output();
$conn->close();
?>
