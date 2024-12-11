<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Presensi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Presensi</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="Nama">Nama:</label>
                <input type="text" class="form-control" id="Nama" name="Nama" placeholder="Masukan Nama di sini" required>
            </div>
            <div class="form-group">
                <label for="id_siswa">ID Siswa:</label>
                <input type="text" class="form-control" id="id_siswa" name="id_siswa" placeholder="Masukkan ID siswa" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status">
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpa">Alpa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="waktu_masuk">Waktu Masuk:</label>
                <input type="time" class="form-control" id="waktu_masuk" name="waktu_masuk" required>
            </div>
            <div class="form-group">
                <label for="waktu_keluar">Waktu Keluar:</label>
                <input type="time" class="form-control" id="waktu_keluar" name="waktu_keluar" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
            <a href="menampilkan_data.php" class="btn btn-secondary">Batal</a>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Koneksi ke database
            $conn = new mysqli("localhost", "root", "", "presensi_aldi");

            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Ambil data dari form
            $tanggal = $_POST['tanggal'];
            $nama = $_POST['Nama'];
            $id_siswa = $_POST['id_siswa'];
            $status = $_POST['status'];
            $waktu_masuk = $_POST['waktu_masuk'];
            $waktu_keluar = $_POST['waktu_keluar'];
            $keterangan = $_POST['keterangan'];

                        // Menggunakan prepared statement untuk mencegah SQL Injection
                        $stmt = $conn->prepare("INSERT INTO presensi (tanggal, id_siswa, nama, status, waktu_masuk, waktu_keluar, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)");
                        if ($stmt === false) {
                            die("<div class='alert alert-danger mt-3'>Error preparing statement: " . $conn->error . "</div>");
                        }
            
                        $stmt->bind_param("sisssss", $tanggal, $id_siswa, $nama, $status, $waktu_masuk, $waktu_keluar, $keterangan);
            
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success mt-3'>Data berhasil ditambahkan!</div>";
                            echo "<p><a href='menampilkan_data logout.php'>Kembali ke halaman data</a></p>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
                            error_log("Database error: " . $stmt->error);
                        }
            
                        // Tutup statement dan koneksi
                        $stmt->close();
                        $conn->close();
                    }      
                    ?>      
    </div>
</body>
</html>
