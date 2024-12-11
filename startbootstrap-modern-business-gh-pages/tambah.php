<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="text-center mt-4">Tambah Data</h2>

    <?php
    $conn = new mysqli("localhost", "root", "", "presensi_aldi");
    if ($conn->connect_error) {
        die("<div class='alert alert-danger'>Koneksi gagal: " . $conn->connect_error . "</div>");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_siswa'])) {
        $nisn = $_POST['NISN'];
        $nama_siswa = $_POST['Nama_siswa'];
        $id_tingkatan = $_POST['id_tingkatan'];
        $jurusan = $_POST['Jurusan'];
        $id_char = $_POST['id_char'];

        $stmt = $conn->prepare("INSERT INTO siswa (NISN, Nama_siswa, id_tingkatan, Jurusan, id_char) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nisn, $nama_siswa, $id_tingkatan, $jurusan, $id_char);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Data siswa berhasil ditambahkan.</div>";
            echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    }

    ?>

    <form action="" method="POST">
        <div class="form-group">
            <label>NISN:</label>
            <input type="text" name="NISN" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Siswa:</label>
            <input type="text" name="Nama_siswa" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tingkatan:</label>
            <select name="id_tingkatan" class="form-control" required>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <select name="Jurusan" class="form-control" required>
                <option value="PPLG">PPLG</option>
                <option value="TJKT">TJKT</option>
                <option value="TEI">TEI</option>
                <option value="TKI">TKI</option>
                <option value="ORACLE">ORACLE</option>
                <option value="AXIOO">AXIOO</option>
                <option value="PM">PM</option>
                <option value="ATPH">ATPH</option>
            </select>
        </div>
        <div class="form-group">
            <label>Character ID:</label>
            <select name="id_char" class="form-control" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
            </select>
        </div>
        <button type="submit" name="submit_siswa" class="btn btn-primary">Tambah Siswa</button>
    </form>
</div>
</body>
</html>
