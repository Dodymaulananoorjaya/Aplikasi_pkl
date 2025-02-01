<?php
include "../Koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_spm_tu = !empty($_POST['id_spm_tu']) ? $_POST['id_spm_tu'] : null;
    $id_spm_gu = !empty($_POST['id_spm_gu']) ? $_POST['id_spm_gu'] : null;
    $id_spm_ls = !empty($_POST['id_spm_ls']) ? $_POST['id_spm_ls'] : null;
    $status_verifikasi = $_POST['status_verifikasi'];

    if ($status_verifikasi && ($id_spm_tu || $id_spm_gu || $id_spm_ls)) {
        $stmt = $koneksi->prepare("INSERT INTO verifikasi (id_spm_tu, id_spm_gu, id_spm_ls, status_verifikasi) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $id_spm_tu, $id_spm_gu, $id_spm_ls, $status_verifikasi);

        if ($stmt->execute()) {
            echo "Data berhasil diverifikasi.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Harap pilih setidaknya satu ID SPM dan status verifikasi.";
    }
}

$koneksi->close();
?>
