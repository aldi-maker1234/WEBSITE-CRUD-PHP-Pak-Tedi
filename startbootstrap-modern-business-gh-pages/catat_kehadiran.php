<?php
$conn = new mysqli("localhost", "root", "", "presensi_aldi");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data siswa untuk ditampilkan di form
$siswa_query = "SELECT * FROM siswa";
$result = $conn->query($siswa_query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = date("Y-m-d");
    $status = $_POST['status'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $waktu_keluar = $_POST['waktu_keluar'];
    $keterangan = $_POST['keterangan'];

    // Simpan ke tabel presensi
    $presensi_query = "INSERT INTO presensi (tanggal, id_siswa, status, waktu_masuk, waktu_keluar, keterangan) 
                       VALUES ('$tanggal', '$id_siswa', '$status', '$waktu_masuk', '$waktu_keluar', '$keterangan')";

    if ($conn->query($presensi_query) === TRUE) {
        echo "<p>Data presensi berhasil disimpan!</p>";
        echo '<a href="menampilkan_data logout.php">Kembali</a>';
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Kehadiran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Catat Kehadiran Siswa</h2>
    <form method="post">
        <label for="id_siswa">Nama Siswa</label>
        <select name="id_siswa" id="id_siswa" required>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?= $row['id_siswa']; ?>"><?= $row['Nama_siswa']; ?></option>
            <?php } ?>
        </select>

        <label for="status">Status Kehadiran</label>
        <select name="status" id="status" required>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpa">Alpa</option>
        </select>

        <label for="waktu_masuk">Waktu Masuk</label>
        <input type="time" name="waktu_masuk" id="waktu_masuk" required>

        <label for="waktu_keluar">Waktu Keluar</label>
        <input type="time" name="waktu_keluar" id="waktu_keluar">

        <label for="keterangan">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" placeholder="Opsional">

        <button type="submit">Simpan Kehadiran</button>
    </form>
</body>
</html>
