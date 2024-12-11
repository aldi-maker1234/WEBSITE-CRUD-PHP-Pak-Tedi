<?php
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id_presensi'])) {
    $id_presensi = $_GET['id_presensi'];

    // Ambil data berdasarkan ID Presensi
    $stmt = $conn->prepare("SELECT * FROM presensi WHERE id_presensi = ?");
    $stmt->bind_param("i", $id_presensi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data Presensi tidak ditemukan.";
        echo "ID Presensi tidak ditemukan. <a href='menampilkan_data.php'>Kembali</a>";
        exit();
    }
} else {
    echo "ID Tidak Ditemukan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_presensi = $_POST['id_presensi'];
    $tanggal = $_POST['Tanggal'];
    $status = $_POST['Status'];
    $waktu_masuk = $_POST['waktu_masuk'];
    $waktu_keluar = $_POST['waktu_keluar'];
    $keterangan = $_POST['Keterangan'];

    // Validasi input
    if (empty($id_presensi) || empty($tanggal) || empty($status) || empty($waktu_masuk) || empty($waktu_keluar) || empty($keterangan)) {
        echo "Semua data harus diisi.";
        exit();
    }

    // Update data di database
    $stmt = $conn->prepare("UPDATE presensi SET Tanggal = ?, Status = ?, waktu_masuk = ?, waktu_keluar = ?, Keterangan = ? WHERE id_presensi = ?");
    $stmt->bind_param("sssssi", $tanggal, $status, $waktu_masuk, $waktu_keluar, $keterangan, $id_presensi);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui. <a href='menampilkan_data logout.php'>Kembali</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Presensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            text-align: left;
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Data Presensi</h2>
        <form method="post">
            <label for="id_presensi">ID presensi:</label>
            <input type="text" name="id_presensi" value="<?php echo htmlspecialchars($row['id_presensi']); ?>" required readonly>

            <label for="Tanggal">Tanggal:</label>
            <input type="date" name="Tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>

            <label for="Status">Status:</label>
            <select name="Status" required>
                <option value="Hadir" <?php echo (isset($row['Status']) && $row['Status'] == 'Hadir') ? 'selected' : ''; ?>>Hadir</option>
                <option value="Alpa" <?php echo (isset($row['Status']) && $row['Status'] == 'Alpa') ? 'selected' : ''; ?>>Alpa</option>
                <option value="Izin" <?php echo (isset($row['Status']) && $row['Status'] == 'Izin') ? 'selected' : ''; ?>>Izin</option>
                <option value="Sakit" <?php echo (isset($row['Status']) && $row['Status'] == 'Sakit') ? 'selected' : ''; ?>>Sakit</option>
            </select>

            <label for="waktu_masuk">Waktu Masuk:</label>
            <input type="time" step="1" name="waktu_masuk" step="1" value="<?php echo htmlspecialchars($row['waktu_masuk']); ?>" required>

            <label for="waktu_keluar">Waktu Keluar:</label>
            <input type="time" step="1" name="waktu_keluar" value="<?php echo htmlspecialchars($row['waktu_keluar']); ?>" required>

            <label for="Keterangan">Keterangan:</label>
            <input type="text" name="Keterangan" value="<?php echo htmlspecialchars($row['keterangan']); ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>