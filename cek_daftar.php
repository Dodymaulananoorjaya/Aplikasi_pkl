<?php
require 'koneksi.php';

// Proses registrasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Pengecekan panjang username
    if (strlen($username) < 4) {
        echo "<script>alert('Username harus minimal 4 karakter.'); window.history.back();</script>";
        exit();
    }

    // Mengecek ulang apakah username sudah ada di database
    $sql_check = "SELECT * FROM user WHERE username = ?";
    $stmt_check = $koneksi->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Jika username sudah ada, tampilkan pesan dan hentikan proses registrasi
        echo "<script>alert('Username sudah digunakan, silakan pilih username lain.'); window.history.back();</script>";
        $stmt_check->close();
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $level = 'pengguna';

    $sql = "INSERT INTO user (nama, email, username, password, level) VALUES ('$nama', '$email', '$username', '$hashed_password', '$level')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Akun baru berhasil dibuat.'); window.location='index.php';</script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    $stmt_check->close();
    mysqli_close($koneksi);
}