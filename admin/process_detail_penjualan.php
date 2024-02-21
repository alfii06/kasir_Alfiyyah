<?php
include 'koneksi.php';

// Memeriksa apakah request POST terkirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $penjualan_id = isset($_POST["penjualan_id"]) ? $_POST["penjualan_id"] : '';
    $produk_id = $_POST["produk"];
    $qty = $_POST["qty"];
    $harga_beli = $_POST["harga_beli"];
    $harga_jual = $_POST["harga_jual"];

    // Lakukan validasi data jika diperlukan

    // Misalnya, Anda dapat memeriksa apakah semua data yang diperlukan telah diisi
    if (empty($penjualan_id) || empty($produk_id) || empty($qty) || empty($harga_jual) || empty($harga_beli)) {
        echo "Harap lengkapi semua field!";
        exit; // Menghentikan proses lebih lanjut jika ada field yang kosong
    }

    // Selanjutnya, Anda dapat menyimpan data ini ke dalam database atau melakukan operasi lain sesuai kebutuhan aplikasi Anda.

    // Contoh: Menyimpan detail penjualan ke dalam tabel penjualan_detail
    $sql_insert_penjualan_detail = "INSERT INTO penjualan_detail (penjualan_id, produk_id, qty, harga_beli, harga_jual) VALUES ('$penjualan_id', '$produk_id', '$qty', '$harga_beli', '$harga_jual')";
    //var_dump ($conn);
    // Menjalankan query
    if ($conn->query($sql_insert_penjualan_detail) === TRUE) {
        // Pengalihan halaman jika penyimpanan berhasil
        header('Location: tabel_jual_detail.php');
        // Memanggil fungsi clearForm() untuk mengosongkan form
        echo "<script>clearForm();</script>";
        exit; // Menghentikan eksekusi skrip setelah redirect
    }
} else {
    // Jika request bukan POST, mungkin ada kesalahan atau pengaksesan yang tidak sah
    echo "Permintaan tidak valid.";
}

// Menutup koneksi database
$conn->close();
?>
