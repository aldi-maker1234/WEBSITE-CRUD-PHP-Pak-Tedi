<?php
session_start();
$conn = new mysqli("localhost", "root", "", "presensi_aldi");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simulasi proses login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ganti dengan logika autentikasi yang sesuai
    if ($username == 'admin' && $password == 'admin') {
        $_SESSION['loggedin'] = true;
        echo '
        <script>
        alert("Login berhasil.");
        document.location.href = "menampilkan_data logout.php"; // Arahkan ke halaman login
        </script>
    ';
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #8360c3, #2ebf91);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #2ebf91;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .form-group label {
            color: #333;
        }
        .btn-primary {
            background: #2ebf91;
            border: none;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #1d8664;
        }
        .alert {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt-5">Login</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>