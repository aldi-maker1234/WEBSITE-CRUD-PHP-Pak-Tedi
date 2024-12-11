<?php
$conn = new mysqli("localhost", "root", "", "presensi_aldi");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    // Ambil data berdasarkan NISN
    $result = $conn->query("SELECT * FROM siswa WHERE NISN = '$nisn'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data Siswa tidak ditemukan.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_siswa = $_POST['Nama_siswa'];
    $id_tingkatan = $_POST['id_tingkatan'];
    $jurusan = $_POST['Jurusan'];
    $id_char = $_POST['id_char'];

    // Update data di database
    $sql = "UPDATE siswa SET Nama_siswa = '$nama_siswa', id_tingkatan = '$id_tingkatan', Jurusan = '$jurusan', id_char = '$id_char' WHERE NISN = '$nisn'";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui. <a href='menampilkan_data logout.php'>Kembali</a>";
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
    <title>Edit Data Siswa</title>
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
        <h2>Edit Data Siswa</h2>
        <form method="post">
            <label for="Nama_siswa">Nama Siswa:</label>
            <input type="text" name="Nama_siswa" value="<?php echo htmlspecialchars($row['Nama_siswa']); ?>" required>

            <label for="id_tingkatan">ID Tingkatan:</label>
            <div>
                <label><input type="radio" name="id_tingkatan" value="X" <?php echo ($row['id_tingkatan'] == 'X') ? 'checked' : ''; ?>> X</label> 
                <label><input type="radio" name="id_tingkatan" value="XI" <?php echo ($row['id_tingkatan'] == 'XI') ? 'checked' : ''; ?>> XI</label>
                <label><input type="radio" name="id_tingkatan" value="XII" <?php echo ($row['id_tingkatan'] == 'XII') ? 'checked' : ''; ?>> XII</label>
            </div>

            <label for="Jurusan">Jurusan:</label>
            <select name="Jurusan" required>
                <option value="PPLG" <?php echo ($row['Jurusan'] == 'PPLG') ? 'selected' : ''; ?>>PPLG</option>
                <option value="TJKT" <?php echo ($row['Jurusan'] == 'TJKT') ? 'selected' : ''; ?>>TJKT</option>
                <option value="TKI" <?php echo ($row['Jurusan'] == 'TKI') ? 'selected' : ''; ?>>TKI</option>
                <option value="TEI" <?php echo ($row['Jurusan'] == 'TEI') ? 'selected' : ''; ?>>TEI</option>
                <option value="PM" <?php echo ($row['Jurusan'] == 'PM') ? 'selected' : ''; ?>>PM</option>
                <option value="ATPH" <?php echo ($row['Jurusan'] == 'ATPH') ? 'selected' : ''; ?>>ATPH</option>
                <option value="ORACLE" <?php echo ($row['Jurusan'] == 'ORACLE') ? 'selected' : ''; ?>>ORACLE</option>
                <option value="AXIOO" <?php echo ($row['Jurusan'] == 'AXIOO') ? 'selected' : ''; ?>>AXIOO</option>
            </select>

            <label for="id_char">ID Char:</label>
            <div>
                <label><input type="radio" name="id_char" value="A" <?php echo ($row['id_char'] == 'A') ? 'checked' : ''; ?>> A</label>
                <label><input type="radio" name="id_char" value="B" <?php echo ($row['id_char'] == 'B') ? 'checked' : ''; ?>> B</label>
                <label><input type="radio" name="id_char" value="C" <?php echo ($row['id_char'] == 'C') ? 'checked' : ''; ?>> C</label>
            </div>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
