<?php
session_start();
require 'koneksi.php';  // Memastikan koneksi database tersambung

// Escape untuk keamanan
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

// Menyeleksi data user dengan username yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);

    // Verifikasi password yang diinput dengan hash di database
    if (password_verify($password, $data['password'])) {
        // Simpan id, username, dan level pengguna di session
        $_SESSION['id_user'] = $data['id_user']; // Tambahkan id pengguna ke session
         $_SESSION['nama'] = $data['nama'];         
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $data['level'];

        // Redirect berdasarkan level pengguna
        if ($data['level'] == "admin") {
            header("Location: on-admin/beranda.php");
        } else if ($data['level'] == "operator") {
            header("Location: operator/halaman_operator.php");
        } else if ($data['level'] == "pengguna") {
            header("Location: on-member/halaman_pengguna.php");
        } else {
            echo "<script>alert('Login gagal! Level pengguna tidak dikenal.'); window.location.href='index.php';</script>";
        }
        exit(); // Hentikan eksekusi lebih lanjut setelah redirect
    } else {
        // Password salah
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location.href='index.php';</script>";
    }
} else {
    // Username tidak ditemukan
    echo "<script>alert('Login gagal! Username atau password salah.'); window.location.href='index.php';</script>";
}

mysqli_close($koneksi);  // Menutup koneksi
