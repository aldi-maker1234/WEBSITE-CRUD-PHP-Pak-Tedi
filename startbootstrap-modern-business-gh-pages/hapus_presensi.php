<?php
// Menghubungkan ke database
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah ada parameter 'id' yang dikirim
if (isset($_GET['id'])) {
    $id_presensi = $_GET['id'];

    // Query untuk menghapus data presensi berdasarkan id_presensi
    $query = "DELETE FROM presensi WHERE id_presensi = '$id_presensi'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        // Redirect ke halaman menampilkan data setelah penghapusan berhasil
        echo "<script>alert('Data presensi berhasil dihapus'); window.location.href = 'menampilkan_data logout.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
