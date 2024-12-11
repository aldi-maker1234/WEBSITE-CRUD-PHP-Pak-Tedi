<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menampilkan Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/16.1.1/build/octicons.min.css" integrity="sha512-+lCJyFTuv42cTkBMEYl6hjfQ9Qn2U8OwNHNUL/21FuRBowIQe2d6Kb3bB35FgzC0tLlgKzHiEUMmtSaOx9Wj0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk1rWC1rAMrq3LYxuoYyAmvj6rbtG5srW3fbtTI" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
        /* Custom Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        table, th, td {
            text-align: center;
            padding: 10px 5px;
            margin: 20px;
            margin-left: 50px;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            font-family: Monospace;
        }
        th, td:hover {
           background-color: #c2c0bc;
        }
        th {
            color: black;
        }
        td > a {
            padding: 3px;
            margin: 7px;
            text-decoration: underline;
            color: blue;
            border: 2px blue;
        }
        a[href*="edit.php"] {
            background-color: green;
            color: white;
            padding: 7px;
            text-decoration: none;
        };
        a[href*="edit.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="edit_sesi.php"] {
            background-color: green;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="edit_sesi.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="edit_presensi.php"] {
            background-color: green;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="edit_presensi.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="hapus.php"] {
            background-color: red;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="hapus.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="hapus_sesi.php"] {
            background-color: red;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="hapus_sesi.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="hapus_presensi.php"] {
            background-color: red;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="hapus_presensi.php"]:hover {
            background-color: white;
            color: black;
        }
        a[href*="catat_kehadiran.php"] {
            background-color: blue;
            color: white;
            padding: 7px;
            text-decoration: none;
        }
        a[href*="catat_kehadiran.php"]:hover {
            background-color: white;
            color: black;
        }
        form {
            text-align: center;
            margin: 20px;
        }
        form input[type="text"] {
            width: 300px;
            padding: 12px 20px;
            font-size: 16px;
            color: #ffffff;
            background: linear-gradient(135deg, #2b2e4a, #4f518c);
            border: none;
            border-radius: 30px;
            outline: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        form input[type="text"]::placeholder {
            color: #b3b3b3;
        }
        form input[type="text"]:focus {
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.6), 0 0 25px rgba(0, 255, 255, 0.4);
            background: linear-gradient(165deg, #2a2d4d, #6263a8);
        }
        form button {
            padding: 10px 20px;
            margin-left: 10px;
            font-size: 16px;
            color: #ffffff;
            background: linear-gradient(135deg, #4a47a3, #1f1c2c);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        form button:hover {
            background: linear-gradient(135deg, #7261f1, #1b1934);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.6), 0 0 25px rgba(0, 255, 255, 0.4);
        }
        /* Style khusus saat print */
        @media print {
            button, nav {
                display: none; /* Sembunyikan elemen yang tidak diperlukan */
            }
            table {
                width: 100%; /* Buat tabel penuh saat print */
            }
        }
        button{
            padding: 10px 20px;
            margin-left: 600px;
            font-size: 16px;
            color: #ffffff;
            background: linear-gradient(135deg, #4a47a3, #1f1c2c);
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        button:hover{
            background: linear-gradient(135deg, #7261f1, #1b1934);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.6), 0 0 25px rgba(0, 255, 255, 0.4);
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container px-5">
            <a class="navbar-brand" href="biodata.html">Aldi Ajah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="biodata.html">Biodata</a></li>
                    <li class="nav-item"><a class="nav-link" href="Gallery.html">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Audio/Video</a></li>
                    <li class="nav-item"><a class="nav-link" href="Tabel.html">Tabel</a></li>
                    <li class="nav-item"><a class="nav-link" href="form.html">Form</a></li>
                    <li class="nav-item"><a class="nav-link" href="menampilkan_data.php">Database</a></li>
                </li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Form -->
    <form method="GET" action="menampilkan_data.php" style="text-align: center; margin: 20px;">
        <input type="text" name="search" placeholder="Cari siswa atau mapel..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <button type="submit">Cari</button>
    </form>
    <!-- Tombol Print -->
<button onclick="printPage()">Print Data</button>
<script>
    function printPage() {
        window.print();
    }
</script>

    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "presensi_aldi");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Query for siswa
    echo "<h2>Tabel Siswa</h2>";
    echo "<div style='text-align: center; margin-bottom: 10px;'>
        <a href='tambah.php?table=siswa' class='btn btn-primary'>Tambah Data Siswa</a>
      </div>";
    $query_siswa = "SELECT * FROM siswa WHERE Nama_siswa LIKE '%$search%' OR NISN LIKE '%$search%' OR Jurusan LIKE 
    '%$search%' OR id_tingkatan LIKE '%$search%' OR id_char LIKE '%$search%'";
    $result_siswa = $conn->query($query_siswa);

    if ($result_siswa->num_rows > 0) {
        echo "<table border='1'><tr><th>id_siswa</th><th>NISN</th><th>Nama_siswa</th><th>id_tingkatan</th><th>Jurusan</th><th>id_char</th><th>Aksi</th></tr>";
        while ($row = $result_siswa->fetch_assoc()) {
            echo "<tr><td>" . $row['id_siswa'] . "</td>
            <td>" . $row['NISN'] . "</td><td>" . $row['Nama_siswa'] . "</td><td>" . $row['id_tingkatan'] . "</td><td>" . $row['Jurusan'] . "</td><td>" . $row['id_char'] . "</td><td><a href='edit.php?nisn=" . $row['NISN'] . "'>
            Edit</a> | <a href='hapus.php?NISN=" . $row['NISN'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>
            Hapus</a> | <a href='catat_kehadiran.php?id_siswa=" . $row['id_siswa'] . "'>Catat Kehadiran</a>
</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>Tidak ada data siswa yang sesuai.</p>";
    }

    // Query for sesi
    echo "<h2>Tabel Sesi</h2>";
    echo "<div style='text-align: center; margin-bottom: 10px;'>
        <a href='tambah_sesi.php?table=sesi' class='btn btn-primary'>Tambah Data Sesi</a>
      </div>";
    $query_sesi = "SELECT * FROM sesi WHERE nama_mapel LIKE '%$search%'";
    $result_sesi = $conn->query($query_sesi);

    if ($result_sesi->num_rows > 0) {
        echo "<table border='1'><tr><th>id_mapel</th><th>nama_mapel</th><th>Tanggal</th><th>Mulai</th><th>Selesai</th><th>Aksi</th></tr>";
        while ($row = $result_sesi->fetch_assoc()) {
            echo "<tr><td>" . $row['id_mapel'] . "</td><td>" . $row['nama_mapel'] . "</td><td>" . $row['Tanggal'] . "</td><td>" . $row['Mulai'] . "</td><td>" . $row['Selesai'] . "</td><td><a href='edit_sesi.php?id_mapel=" . $row['id_mapel'] . "'>Edit</a> | <a href='hapus_sesi.php?id_mapel=" . $row['nama_mapel'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")'>Hapus</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>Tidak ada data sesi yang sesuai.</p>";
    }

        // Query for presensi_siswa
        echo "<h2>Tabel Presensi Siswa</h2>";
        echo "<div style='text-align: center; margin-bottom: 10px;'>
            <a href='tambah_presensi.php?table=presensi' class='btn btn-primary'>Tambah Data Presensi</a>
          </div>";
        $query_presensi = "SELECT * FROM presensi WHERE id_siswa IN (SELECT id_siswa FROM siswa WHERE Nama_siswa LIKE '%$search%' OR status LIKE '%$search%' )";
        $result_presensi = $conn->query($query_presensi);
    
        if ($result_presensi->num_rows > 0) {
            echo "<table border='1'>
                    <thead><tr><th>ID Presensi</th><th>Tanggal</th><th>Nama</th><th>ID siswa</th><th>Status</th><th>Waktu_masuk</th><th>Waktu_keluar</th><th>Keterangan</th><th>Aksi</th></tr></thead><tbody>";
            while ($row = $result_presensi->fetch_assoc()) {
                echo "<tr><td>" . $row['id_presensi'] . "</td><td>" . $row['tanggal'] . "</td><td>" . $row['Nama'] . "</td><td>" . $row['id_siswa'] . "</td><td>" . $row['status'] . "</td>
                <td>" . $row['waktu_masuk'] . "</td><td>" . $row['waktu_keluar'] . "</td><td>" . $row['keterangan'] . "</td>
                <td><a href='edit_presensi.php?id_presensi={$row['id_presensi']}'>Edit</a> | <a href='hapus_presensi.php?table=presensi&id=" . $row['id_presensi'] 
                . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data presensi ini?\")'>
                Hapus</a>
</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "Tidak ada data presensi yang ditemukan.";
        }
        
    $conn->close();
    ?>
</main>
</body>
</html>