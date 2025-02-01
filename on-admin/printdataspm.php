<?php
include '../koneksi.php'; // Koneksi database

// Query untuk menampilkan data sekolah
$sql = "SELECT * FROM daftar_sekolah";
$result = $koneksi->query($sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data SPM</title>
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

        .kop-surat h1 {
            font-size: 18px;
            margin: 0;
        }

        .kop-surat h2 {
            font-size: 16px;
            margin: 5px 0;
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
                <td width="15%" align="center">
                    <img src="../assets/images/brand-logos/dinas.png" alt="Logo Kiri">
                </td>
                <td width="70%" align="center">
                    <h1>PEMERINTAH KOTA BANJARMASIN</h1>
                    <h2>BPKBAD</h2>
                    <p>Jl. Pramuka Kec. Banjarmasin Timur, Kota Banjarmasin,</p>
                    <p>Kalimantan Selatan 70236</p>
                    <p>Telepon: (0511) 123456 fax (0511) 234567</p>
                    <p> Email: BPKBAD.Banjarmasin@yahoo.co.id</p>
                </td>
                <td width="15%" align="center">
                    <img src="../assets/images/brand-logos/kayuh_Baimbai.png" alt="Logo Kanan">
                </td>
            </tr>
        </table>
        <hr>
    </div>

    <!-- Data Sekolah -->
    <h3 style="text-align: center;">Laporan Data SPM</h3>
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Skpd</th>
                <th>Dari</th>
                <th>Tahun Anggaran</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id_spm'] . "</td>";
                    echo "<td>" . $row['skpd'] . "</td>";
                    echo "<td>" . $row['dari'] . "</td>";
                    echo "<td>" . $row['tahun_anggaran'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data SPM.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Menutup koneksi
    $koneksi->close();
    ?>
</body>

</html>