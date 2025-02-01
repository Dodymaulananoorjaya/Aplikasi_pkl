<?php
include '../koneksi.php';       // Koneksi ke database

// Periksa apakah id_sppt telah diterima untuk dihapus
if (isset($_GET['id_sp2d']) && is_numeric($_GET['id_sp2d'])) {
    $id_sp2d = intval($_GET['id_sp2d']); // Memastikan ID adalah integer

    // Siapkan query untuk menghapus data
    $stmt = $koneksi->prepare("DELETE FROM sp2d WHERE id_sp2d = ?");
    $stmt->bind_param("i", $id_sp2d);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='sp2d.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data: " . $stmt->error . "'); window.location.href='sp2d.php';</script>";
    }

    $stmt->close(); // Tutup statement
} else {
    echo "<script>alert('ID tidak ditemukan atau tidak valid.'); window.location.href='sp2d.php';</script>";
}

$koneksi->close();
