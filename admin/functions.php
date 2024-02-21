<?php
function getPelangganData() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("SELECT * FROM pelanggan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

function tambahPelanggan($tokoId, $namaPelanggan, $alamat, $noHp) {
    global $pdo;

    try {
        $createdAt = date("Y-m-d");
        $stmt = $pdo->prepare("INSERT INTO pelanggan (toko_id, nama_pelanggan, alamat, no_hp, created_at) VALUES (:tokoId, :namaPelanggan, :alamat, :noHp, :createdAt)");
        $stmt->bindParam(":tokoId", $tokoId, PDO::PARAM_INT);
        $stmt->bindParam(":namaPelanggan", $namaPelanggan, PDO::PARAM_STR);
        $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
        $stmt->bindParam(":noHp", $noHp, PDO::PARAM_STR);
        $stmt->bindParam(":createdAt", $createdAt, PDO::PARAM_STR);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

function editPelanggan($pelangganId, $tokoId, $namaPelanggan, $alamat, $noHp) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("UPDATE pelanggan SET toko_id = :tokoId, nama_pelanggan = :namaPelanggan, alamat = :alamat, no_hp = :noHp WHERE pelanggan_id = :pelangganId");
        $stmt->bindParam(":tokoId", $tokoId, PDO::PARAM_INT);
        $stmt->bindParam(":namaPelanggan", $namaPelanggan, PDO::PARAM_STR);
        $stmt->bindParam(":alamat", $alamat, PDO::PARAM_STR);
        $stmt->bindParam(":noHp", $noHp, PDO::PARAM_STR);
        $stmt->bindParam(":pelangganId", $pelangganId, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

function hapusPelanggan($pelangganId) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("DELETE FROM pelanggan WHERE pelanggan_id = :pelangganId");
        $stmt->bindParam(":pelangganId", $pelangganId, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
