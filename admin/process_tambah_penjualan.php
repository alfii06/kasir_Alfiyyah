<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "pos_alfi";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

// Fungsi untuk menambah pelanggan
function tambahPelanggan($nama_pelanggan, $alamat, $no_hp) {
    global $conn;
    $sql = "INSERT INTO pelanggan (nama_pelanggan, alamat, no_hp) VALUES ('$nama_pelanggan', '$alamat', '$no_hp')";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk membaca semua pelanggan
function bacaSemuaPelanggan() {
    global $conn;
    $sql = "SELECT * FROM pelanggan";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["pelanggan_id"]. " - Nama: " . $row["nama_pelanggan"]. " - Alamat: " . $row["alamat"]. " - No. HP: " . $row["no_hp"]. "<br>";
        }
    } else {
        echo "0 results";
    }
}

// Fungsi untuk mengupdate pelanggan
function updatePelanggan($pelanggan_id, $nama_pelanggan, $alamat, $no_hp) {
    global $conn;
    $sql = "UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', alamat='$alamat', no_hp='$no_hp' WHERE pelanggan_id=$pelanggan_id";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil diupdate";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fungsi untuk menghapus pelanggan
function hapusPelanggan($pelanggan_id) {
    global $conn;
    $sql = "DELETE FROM pelanggan WHERE pelanggan_id=$pelanggan_id";

    if ($conn->query($sql) === TRUE) {
        echo "Data pelanggan berhasil dihapus";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Contoh penggunaan fungsi-fungsi di atas:

// Tambah pelanggan
tambahPelanggan("Nama Pelanggan Baru", "Alamat Baru", "081234567890");

// Baca semua pelanggan
echo "Daftar Pelanggan:<br>";
bacaSemuaPelanggan();

// Update pelanggan dengan ID 1
updatePelanggan(1, "Nama Pelanggan Baru", "Alamat Baru", "081234567891");

// Hapus pelanggan dengan ID 2
hapusPelanggan(2);

// Tutup koneksi ke database
$conn->close();
?>