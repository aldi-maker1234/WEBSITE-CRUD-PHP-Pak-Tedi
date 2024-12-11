<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus data siswa berdasarkan NISN
if (isset($_GET['NISN']) && !empty($_GET['NISN'])) {
    $nisn = $_GET['NISN'];

    // Validasi jika NISN bukan angka atau karakter khusus lainnya yang tidak diinginkan
    if (!preg_match("/^[0-9]+$/", $nisn)) {
        echo "<p>NISN tidak valid.</p>";
        echo "<p><a href='menampilkan_data.php'>Kembali ke halaman data</a></p>";
        exit();
    }

    // Pastikan NISN valid dan gunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("DELETE FROM siswa WHERE NISN = ?");
    if ($stmt === false) {
        die("Kesalahan dalam persiapan query: " . $conn->error);
    }

    // Bind parameter dan eksekusi
    $stmt->bind_param("s", $nisn); // "s" berarti string
    $result = $stmt->execute();
    
    if ($result) {
        // Berhasil menghapus, tampilkan pesan sukses dan link kembali
        echo "<p>Data siswa berhasil dihapus.</p>";
        echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
    } else {
        // Gagal menghapus, tampilkan error dan link kembali
        echo "<p>Gagal menghapus data: " . $stmt->error . "</p>";
        echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
    }

    // Menutup prepared statement
    $stmt->close();
} else {
    echo "<p>Parameter NISN tidak ditemukan atau kosong.</p>";
    echo "<p><a href='menampilkan_data.php'>Kembali ke halaman data</a></p>";
}

$conn->close();
?>
