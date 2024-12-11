<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus data sesi berdasarkan id_mapel
if (isset($_GET['id_mapel']) && !empty($_GET['id_mapel'])) {
    $id_mapel = $_GET['id_mapel'];

    // Validasi jika id_mapel bukan angka atau karakter khusus lainnya yang tidak diinginkan
    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $id_mapel)) {
        echo "<p>ID Mapel tidak valid.</p>";
        echo "<p><a href='menampilkan_data.php'>Kembali ke halaman data</a></p>";
        exit();
    }

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus dari tabel sesi
        $stmt = $conn->prepare("DELETE FROM sesi WHERE nama_mapel = ?");
        if ($stmt === false) {
            throw new Exception("Kesalahan dalam persiapan query: " . $conn->error);
        }

        // Bind parameter dan eksekusi
        $stmt->bind_param("s", $id_mapel);
        $result = $stmt->execute();
        $stmt->close();

        if ($result) {
            // Berhasil menghapus, tampilkan pesan sukses dan link kembali
            echo "<p>Data sesi berhasil dihapus.</p>";
            echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
        } else {
            // Gagal menghapus, tampilkan error dan link kembali
            echo "<p>Gagal menghapus data: " . $stmt->error . "</p>";
            echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
        }

        // Commit transaksi
        $conn->commit();
    } catch (Exception $e) {
        // Rollback jika ada kesalahan
        $conn->rollback();
        echo "<p>Terjadi kesalahan: " . $e->getMessage() . "</p>";
        echo "<p><a href='menampilkan_data.php'>Kembali ke halaman data</a></p>";
    }
} else {
    echo "<p>Parameter ID Mapel tidak ditemukan atau kosong.</p>";
    echo "<p><a href='menampilkan_data.php'>Kembali ke halaman data</a></p>";
}

$conn->close();
?>