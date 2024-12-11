<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sesi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center mt-4">Tambah Data Sesi</h2>

    <?php
    $conn = new mysqli("localhost", "root", "", "presensi_aldi");
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Koneksi gagal: " . $conn->connect_error . "</div>");
    }

    // Form untuk tabel sesi
    echo '<h3>Tambah Data Sesi</h3>';
    echo '<form action="tambah_sesi.php" method="POST">
            <div class="form-group">
                <label>ID Mapel:</label>
                <input type="text" name="id_mapel" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Mapel:</label>
                <input type="text" name="nama_mapel" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="Tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Waktu Mulai:</label>
                <input type="time" step="1" name="Mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Waktu Selesai:</label>
                <input type="time" step="1" name="Selesai" class="form-control" required>
            </div>
            <button type="submit" name="submit_sesi" class="btn btn-primary">Tambah Sesi</button>
          </form>';

    // Proses tambah data sesi
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_sesi'])) {
        $id_mapel = $_POST['id_mapel']; // Menggunakan id_mapel
        $nama_mapel = $_POST['nama_mapel']; // Menggunakan nama_mapel
        $tanggal = $_POST['Tanggal'];
        $waktu_mulai = $_POST['Mulai'];
        $waktu_selesai = $_POST['Selesai'];

        // Menggunakan prepared statement untuk mencegah SQL Injection
        $stmt = $conn->prepare("INSERT INTO sesi (id_mapel, nama_mapel, Tanggal, Mulai, Selesai) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id_mapel, $nama_mapel, $tanggal, $waktu_mulai, $waktu_selesai);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Data sesi berhasil ditambahkan.</div>";
            echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</div>
</body>
</html>