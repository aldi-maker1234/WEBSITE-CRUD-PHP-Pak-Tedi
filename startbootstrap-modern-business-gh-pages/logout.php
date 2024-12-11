<?php
session_start();
session_destroy(); // Menghancurkan session
header('Location: menampilkan_data.php'); // Arahkan kembali ke halaman login
exit;
?>