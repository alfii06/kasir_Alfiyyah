<?php

$userToEdit = [ // Inisialisasi default jika tidak ada parameter user_id
    'user_id' => '',
    'username' => '',
    'email' => '',
    'nama_lengkap' => '',
    'alamat' => '',
    'role' => '',
    'created_at' => ''
];

// Ambil parameter user_id dari URL
if (isset($_GET['id'])) {
    // Contoh pengambilan data user dari database berdasarkan user_id
    // Gantilah bagian ini dengan kueri atau metode pengambilan data sesuai dengan struktur database Anda
    $user_id = $_GET['id'];
    // Misalnya, Anda menggunakan PDO untuk koneksi ke database
    $pdo = new PDO("mysql:host=localhost;dbname=pos_alfi", "root", "");
    $stmt = $pdo->prepare("SELECT * FROM user WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $userToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Jika data user sudah ada dalam formulir POST, gunakan data tersebut
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userToEdit = [
        'user_id' => $_POST['userId'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'nama_lengkap' => $_POST['namaLengkap'],
        'alamat' => $_POST['alamat'],
        'role' => $_POST['role'],
        'created_at' => $_POST['createdAt'],
    ];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data User</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        #formContainer {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #simpanBtn {
            background-color: #4CAF50;
            color: white;
            border: none;
        }

        #batalBtn {
            background-color: #ccc;
            color: black;
            border: none;
        }

        #role{
            width: 100%;
            height: 30px;
        }
    </style>
</head>
<body>

<div id="formContainer">
    <h2>Edit Data User</h2>

    <form id="formEditUser" method="post" action="process_edit_user.php">
        <!-- Remove the User ID input field -->
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" value="<?= $userToEdit['user_id'] ?>" readonly>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?= $userToEdit['username'] ?>" required>
        
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value="<?= $userToEdit['password'] ?>" required>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?= $userToEdit['email'] ?>" required>

        <label for="namaLengkap">Nama Lengkap:</label>
        <input type="text" id="namaLengkap" name="namaLengkap" value="<?= $userToEdit['nama_lengkap'] ?>" required>

        <label for="alamat">Alamat:</label>
        <input type="text" id="alamat" name="alamat" value="<?= $userToEdit['alamat'] ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user" <?= ($userToEdit['role'] == 'user') ? 'selected' : '' ?>>Admin</option>
            <option value="petugas" <?= ($userToEdit['role'] == 'petugas') ? 'selected' : '' ?>>Petugas</option>
        </select>

        <label for="createdAt">Created At:</label>
        <input type="text" id="createdAt" name="createdAt" value="<?= $userToEdit['created_at'] ?>" readonly>

        <a href="../admin/data_user.php"><button id="simpanBtn" type="submit">Simpan Perubahan</button></a>
        <button id="batalBtn" type="button" onclick="history.back()">Batal</button>
    </form>
</div>

</body>
</html>
