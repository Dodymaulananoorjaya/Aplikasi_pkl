<?php
include '../koneksi.php';       // Koneksi ke database

// Periksa apakah id_sppt telah diterima untuk dihapus
if (isset($_GET['id_spm']) && is_numeric($_GET['id_spm'])) {
    $id_spm = intval($_GET['id_spm']); // Memastikan ID adalah integer

    // Siapkan query untuk menghapus data
    $stmt = $koneksi->prepare("DELETE FROM penolakan WHERE id_spm = ?");
    $stmt->bind_param("i", $id_spm);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='hapus_penolakan.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data: " . $stmt->error . "'); window.location.href='penolakan.php';</script>";
    }

    $stmt->close(); // Tutup statement
} else {
    echo "<script>alert('ID tidak ditemukan atau tidak valid.'); window.location.href='penolakan.php';</script>";
}

$koneksi->close();
