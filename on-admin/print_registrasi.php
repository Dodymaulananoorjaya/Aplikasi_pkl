<?php
include '../koneksi.php'; // Koneksi database
// Ambil ID dari parameter GET
$id_registrasi = isset($_GET['id_registrasi']) ? intval($_GET['id_registrasi']) : 0; // Pastikan ID valid dengan intval()

// Periksa apakah ID valid
if ($id_registrasi > 0) {
    // Query untuk menampilkan data registrasi berdasarkan id_$id_registrasi
    $sql = "SELECT 
                nomor_registrasi, 
                skpd, 
                no_pengantar, 
                cv, 
                tanggal_registrasi, 
                nomor_spm, 
                uraian, 
                keterangan, 
                transfer_ke 
            FROM registrasi 
            WHERE id_registrasi = ?"; // Pastikan kolom $id_registrasi sesuai dengan tabel Anda (misalnya id_$id_registrasi_registrasi)

    // Siapkan statement
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id_registrasi); // Binding parameter untuk mencegah SQL injection

    // Eksekusi statement
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            height: 80px;
        }

        .kop-surat h1,
        .kop-surat h2 {
            margin: 0;
        }

        .kop-surat p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <table width="100%">
            <tr>
                <!-- Logo Kiri -->
                <td width="15%" align="center">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin (1).png" alt="Logo Kiri" style="max-width: 200px;">
                </td>

                <!-- Informasi Tengah -->
                <td width="70%" align="center">
                    <h1>PEMERINTAH KOTA BANJARMASIN</h1>
                    <h2>BPKPAD</h2>
                    <p>Jl. Pramuka Kec. Banjarmasin Timur, Kota Banjarmasin,</p>
                    <p>Kalimantan Selatan 70236</p>
                    <p>Telepon: (0511) 123456 | Fax: (0511) 234567</p>
                    <p>Email: BPKBAD.Banjarmasin@yahoo.co.id</p>
                </td>

                <!-- Logo Kanan -->
                <td width="15%" align="center">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin2.png" alt="Logo Kanan" style="max-width: 200px;">
                </td>
            </tr>
        </table>
        <hr>
    </div>

    <!-- Data Registrasi -->
    <h3 style="text-align: center;">Laporan Data Registrasi</h3>
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NOMOR REGISTRASI</th>
                <th>SKPD</th>
                <th>NO PENGANTAR</th>
                <th>CV</th>
                <th>TANGGAL REGISTRASI</th>
                <th>NOMOR SPM</th>
                <th>URAIAN</th>
                <th>KETERANGAN</th>
                <th>TRANSFER KE</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nomor_registrasi']); ?></td>
                        <td><?= htmlspecialchars($row['skpd']); ?></td>
                        <td><?= htmlspecialchars($row['no_pengantar']); ?></td>
                        <td><?= htmlspecialchars($row['cv']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_registrasi']); ?></td>
                        <td><?= htmlspecialchars($row['nomor_spm']); ?></td>
                        <td><?= htmlspecialchars($row['uraian']); ?></td>
                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                        <td><?= htmlspecialchars($row['transfer_ke']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Tidak ada data registrasi.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php
    // Menutup koneksi database
    $koneksi->close();
    ?>
</body>

</html>