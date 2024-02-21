<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "pos_alfi";
    public $conn;

    // Constructor
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    // Method untuk mendapatkan koneksi
    public function getConnection() {
        return $this->conn;
    }
}

// Membuat objek database
$database = new Database();
$conn = $database->getConnection();

// Anda sekarang bisa menggunakan objek $conn untuk melakukan query ke database
?>