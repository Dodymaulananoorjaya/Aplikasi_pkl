<?php
// Koneksi ke database
$host = "localhost"; // Sesuaikan dengan konfigurasi database Anda
$user = "root"; // Sesuaikan dengan user database Anda
$password = ""; // Sesuaikan dengan password database Anda
$database = "monitoring"; // Ganti dengan nama database yang sesuai

$koneksi = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil nomor_spm dari tabel registrasi
$sql = "SELECT nomor_spm FROM registrasi"; // Ambil nomor_spm terbaru
$result = $koneksi->query($sql);

// Inisialisasi variabel nomor_spm
$nomor_spm = "Belum tersedia";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nomor_spm = $row['nomor_spm'];
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat SPTJM SPM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            @page { size: A4; margin: 1cm; }
            body { font-family: 'Times New Roman', serif; }
        }
        .kop-surat { text-align: center; margin-bottom: 15px; position: relative; }
        .kop-surat h1, .kop-surat h2 { margin: 0; font-family: 'Times New Roman', serif; }
        .kop-surat img { position: absolute; top: 5px; left: 15px; width: 100px; height: auto; }
        .line { border-top: 2px solid black; margin-top: 3px; }
        .footer { margin-top: 50px; text-align: right; font-family: 'Times New Roman', serif; }
    </style>
</head>
<body>
    <div class="container mt-2">
        <div class="kop-surat">
            <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo-instansi">
            <h2>PEMERINTAH KOTA BANJARMASIN</h2>
            <h1><strong>BADAN PENGELOLA KEUANGAN, PENDAPATAN DAN ASET DAERAH</strong></h1>
            <p style="font-size: 14px;">Jl. Pramuka Tirta Dharma Komplek PDAM Bandarmasih, Banjarmasin No. 17 Rt.9, Kalimantan Selatan</p>
            <div class="line"></div>
        </div>

        <h5 class="text-center"><u><strong>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK SPM-LS</strong></u></h5>
        <p class="text-center">Nomor: <strong><?= htmlspecialchars($nomor_spm); ?></strong></p>

        <div class="content">
            <p>Sehubungan dengan Surat Perintah Membayar Langsung (SPM-LS) nomor <?= htmlspecialchars($nomor_spm); ?>, dengan ini saya menyatakan bahwa:</p>
            <p>1. Jumlah Langsung (LS) tersebut di atas akan dipergunakan untuk keperluan belanja kegiatan yang akan kami laksanakan sesuai DPA-SKPD.</p>
            <p>2. Bukti-bukti belanja tersebut disimpan di Kecamatan Banjarmasin Barat sesuai dengan ketentuan yang berlaku untuk keperluan pemeriksaan Internal/Eksternal sebagai Bukti Pertanggungjawaban Keuangan.</p>
            <p>Dengan ini, saya menyatakan bertanggung jawab penuh atas segala pengeluaran yang dibayar lunas sesuai dengan ketentuan peraturan perundangan yang berlaku.</p>
            <p>Demikian surat pernyataan ini dibuat untuk melengkapi persyaratan pengajuan SPM-LS SKPD kami.</p>
        </div>

        <br>
        <div class="footer">
            <p>Banjarmasin, <span id="tanggal"></span></p>
            <p><strong>(Nama Penanggung Jawab)</strong></p>
            <p>NIP: xxxxxxxxxxxxxxxx</p>
        </div>

        <button class="btn btn-primary mt-3 no-print" onclick="window.print()">Cetak Surat</button>
    </div>

    <script>
        // Script untuk menampilkan tanggal otomatis
        const today = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('tanggal').textContent = today.toLocaleDateString('id-ID', options);
    </script>
</body>
</html>
