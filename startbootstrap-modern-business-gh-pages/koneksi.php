<?php
$conn = new mysqli("localhost", "root", "", "presensi_aldi");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM siswa ORDER BY created_at DESC";
$result = $conn->query($sql);
?>