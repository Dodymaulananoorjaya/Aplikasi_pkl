<?php
include "../Koneksi.php";
// Query untuk mengambil data dari tabel
$sql = "SELECT 
    n.id_penomoran, 
    n.id_spm, 
    n.tahun_surat,
    n.total_anggaran, 
    p.skpd, 
    p.dari, 
    p.tahun_anggaran
FROM 
    penomoran n
JOIN 
    spm p ON n.id_spm = p.id_spm";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SPM</title>
    <!-- Favicon -->
    <link rel="icon" href="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" type="image/x-icon">
    <style>
        /* CSS Global */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            padding: 20px;
            color: #000;
        }

        /* Kop Surat */
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 100%;
            height: auto;
            margin-bottom: 4px;
        }

        /* Tabel */
        .table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }


        /* Aturan untuk Print */
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 0;
                padding: 40px;
            }

            .table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }

            .kop-surat img {
                width: 100%;
                height: auto;
                margin-bottom: 4px;
            }
        }
    </style>
</head>

<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="../assets/images/Kop Surat.png" alt="Kop Surat">
        <h2>Rekapitulasi Perjalanan Dinas</h2>
    </div>

    <!-- Tabel Laporan -->
    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>ID SPM</th>
                <th>Tahun Surat</th>
                <th>Total Anggaran</th>


            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php $no = 1; // Nomor urut 
                ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['id_spm']); ?></td>
                        <td><?= htmlspecialchars($row['tahun_surat']); ?></td>
                        <td><?= htmlspecialchars($row['total_anggaran']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Data tidak tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>