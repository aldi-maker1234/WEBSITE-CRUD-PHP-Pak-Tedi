<?php
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$row = null; // Inisialisasi variabel $row

if (isset($_GET['id_mapel'])) {
    $id_mapel = $_GET['id_mapel'];

    // Ambil data berdasarkan id_sesi
    $stmt = $conn->prepare("SELECT * FROM sesi WHERE id_mapel = ?");
    $stmt->bind_param("i", $id_mapel); // Menggunakan integer untuk id_sesi
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data Sesi tidak ditemukan.";
        exit();
    }
    $stmt->close(); // Menutup prepared statement
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_mapel = $_POST['id_mapel'];
    $nama_mapel = $_POST['nama_mapel'];
    $tanggal = $_POST['tanggal'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    // Update data di database
    $stmt = $conn->prepare("UPDATE sesi SET nama_mapel = ?, tanggal = ?, mulai = ?, selesai = ? WHERE id_mapel = ?");
    $stmt->bind_param("ssssi", $nama_mapel, $tanggal, $mulai, $selesai, $id_mapel); // Menggunakan prepared statements

    if ($stmt->execute()) {
        echo "
            <script>
                alert('data berhasil di ubah')
                document.location.href = 'menampilkan_data logout.php'
            </script>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close(); // Menutup prepared statement
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sesi</title>
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
        input[type="time"] {
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
        <h2>Edit Data Sesi</h2>
        <form method="post">
            <input type="hidden" name="id_mapel" value="<?php echo isset($row) ? htmlspecialchars($row['id_mapel']) : ''; ?>">
            <label for="nama_mapel">Nama Mapel:</label>
            <input type="text" name="nama_mapel" value="<?php echo isset($row) ? htmlspecialchars($row['nama_mapel']) : ''; ?>" required>

            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" value="<?php echo isset($row) ? htmlspecialchars($row['Tanggal']) : ''; ?>" required>

            <label for="mulai">Mulai:</label>
            <input type="time" step="1" name="mulai" value="<?php echo isset($row) ? htmlspecialchars($row['Mulai']) : ''; ?>" required>

            <label for="selesai">Selesai:</label>
            <input type="time" step="1" name="selesai" value="<?= $row["Selesai"] ?>" required>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>