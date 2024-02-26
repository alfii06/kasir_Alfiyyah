<?php
//admin : 123
//petugas : 12345
session_start();
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "pos_alfi";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// Proses login sederhana (sebagai contoh)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi login berdasarkan username dan password
    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);
        // Memeriksa kecocokan password menggunakan password_verify
        if (password_verify($password, $user_data['password'])) {
            // Login berhasil
            $_SESSION['role'] = $user_data['role'];
            $_SESSION['user_id'] = $user_data['user_id'];
            $_SESSION['username'] = $user_data['username'];

            // Mengarahkan pengguna ke halaman sesuai peran (role)
            if ($user_data['role'] === 'admin') {
                header("Location: dashboard/index.html");
                exit();
            } elseif ($user_data['role'] === 'petugas') {
                header("Location: petugas/index.html");
                exit();
            } else {
                // Jika peran tidak sesuai, menampilkan pesan kesalahan
                echo 'Peran pengguna tidak valid.';
            }
        } else {
            // Jika password tidak cocok, menampilkan pesan kesalahan
            $gagal = 'Login gagal. Periksa kembali username dan password Anda.';
        }
    } else {
        // Jika username tidak ditemukan, menampilkan pesan kesalahan
        $gagal = 'Login gagal. Periksa kembali username dan password Anda.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="dashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="post"> <!-- Menghapus action untuk menangani form pada halaman yang sama -->
        <?php if(isset($gagal)): ?>
            <div style="color: red; margin-bottom: 5px;" class="alert alert-danger">
                <?= $gagal ?>
            </div>
        <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
