<?php
include '../koneksi.php';

// ID yang ingin dicari
$id_spm_gu = isset($_GET['id_spm_gu']) ? (int)$_GET['id_spm_gu'] : null;

if (!$id_spm_gu) {
    die("ID SPM GU tidak valid.");
}

// Query untuk menampilkan data berdasarkan ID
$sql = "SELECT 
    s.no_rekening_bank,
    s.nama_di_rekening_bank,
    s.nama_bank_cabang,
    s.npwp,
    s.dasar_pembayaran,
    p.skpd,
    p.cv,
    p.nomor_spm,
    p.keterangan,
    p.nominal,
    m.kode_rekening_beban,
    m.uraian_beban,
    m.nilai_beban,
    m.uraian_potongan,
    m.jumlah_potongan
FROM 
    spm_gu s
JOIN 
    registrasi p ON s.id_registrasi = p.id_registrasi
JOIN
    isi_spm m ON s.id_registrasi = m.id_registrasi
WHERE 
    s.id_spm_gu = ?";

// Mempersiapkan statement untuk keamanan (menghindari SQL Injection)
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_spm_gu);
$stmt->execute();
$result = $stmt->get_result();

// Cek data dan siapkan array untuk data laporan
$info_umum = [];
$data_pembebanan = [];
$data_potongan = [];
$total_beban = 0;
$total_potongan = 0;

// Fungsi terbilang
function terbilang($angka)
{
    $angka = abs((int)$angka);
    $huruf = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
    $temp = "";
    if ($angka < 12) {
        $temp = " " . $huruf[$angka];
    } elseif ($angka < 20) {
        $temp = terbilang($angka - 10) . " Belas";
    } elseif ($angka < 100) {
        $temp = terbilang((int)($angka / 10)) . " Puluh" . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $temp = " Seratus" . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $temp = terbilang((int)($angka / 100)) . " Ratus" . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $temp = " Seribu" . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $temp = terbilang((int)($angka / 1000)) . " Ribu" . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $temp = terbilang((int)($angka / 1000000)) . " Juta" . terbilang($angka % 1000000);
    }
    return trim($temp);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Simpan informasi umum hanya sekali
        if (empty($info_umum)) {
            $info_umum = [
                'skpd' => $row['skpd'],
                'cv' => $row['cv'],
                'no_rekening_bank' => $row['no_rekening_bank'],
                'nama_di_rekening_bank' => $row['nama_di_rekening_bank'],
                'nama_bank_cabang' => $row['nama_bank_cabang'],
                'npwp' => $row['npwp'],
                'dasar_pembayaran' => $row['dasar_pembayaran'],
                'keterangan' => $row['keterangan']
            ];
        }

        // Simpan data pembebanan
        $data_pembebanan[] = [
            'kode_rekening_beban' => $row['kode_rekening_beban'],
            'uraian_beban' => $row['uraian_beban'],
            'nilai_beban' => $row['nilai_beban'],
            'nominal' => $row['nominal']

        ];

        // Simpan data potongan
        $data_potongan[] = [
            'uraian_potongan' => $row['uraian_potongan'],
            'jumlah_potongan' => $row['jumlah_potongan']
        ];
        $total_potongan += $row['jumlah_potongan'];
    }
} else {
    die("Data tidak ditemukan.");
}

// Tentukan kota dan tanggal
$kota = "Banjarmasin";
$tanggal = date('d');
$bulan_english = date('F');
$tahun = date('Y');

// Konversi nama bulan
$bulan_indonesia = [
    "January" => "Januari",
    "February" => "Februari",
    "March" => "Maret",
    "April" => "April",
    "May" => "Mei",
    "June" => "Juni",
    "July" => "Juli",
    "August" => "Agustus",
    "September" => "September",
    "October" => "Oktober",
    "November" => "November",
    "December" => "Desember"
];

$bulan = $bulan_indonesia[$bulan_english];
$tanggal_lengkap = $kota . ", " . $tanggal . " " . $bulan . " " . $tahun;

// Ambil data kepala dengan id_kepala terbaru
$stmt = $koneksi->prepare("SELECT nama_kepala, nip FROM kepala ORDER BY id_kepala DESC LIMIT 1");
$stmt->execute();
$result_kepala = $stmt->get_result();

if ($result_kepala->num_rows > 0) {
    $row_kepala = $result_kepala->fetch_assoc();
    $nama_kepala = htmlspecialchars($row_kepala['nama_kepala']);
    $nip = htmlspecialchars($row_kepala['nip']);
} else {
    $nama_kepala = "Data tidak ditemukan";
    $nip = "-";
}

$stmt->close();
$koneksi->close();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Membayar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 80%;
            margin: auto;
            border: 1px solid #000;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
            /* Kontrol overflow jika diperlukan */
        }


        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .right-align {
            text-align: right;
        }

        .column-jumlah {
            width: 100px;
            /* Ubah sesuai kebutuhan */
            text-align: right;
            /* Untuk merapikan angka ke kanan */
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .signature {
            text-align: center;
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>PEMERINTAH KOTA BANJARMASIN</h2>
            <h3>SURAT PERINTAH MEMBAYAR LANGSUNG (LS)</h3>
            <p>Tahun Anggaran: 2025</p>
            <p>Nomor SPM: 63.71/03.0/000003/LS/1.01.0.00.0.00.01.0000/M/1/2025</p>
        </div>

        <p><strong>KUASA BENDAHARA UMUM DAERAH</strong><br>
            PEMERINTAH KOTA BANJARMASIN</p>

        <p>Supaya menerbitkan SP2D kepada:</p>
        <table>
            <tr>
                <td>Nama SKPD</td>
                <td><?php echo htmlspecialchars($info_umum['skpd']); ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><?php echo htmlspecialchars($info_umum['cv']); ?></td>
            </tr>
            <tr>
                <td>No. Rekening Bank</td>
                <td><?php echo htmlspecialchars($info_umum['no_rekening_bank']); ?></td>
            </tr>
            <tr>
                <td>Nama di Rekening Bank</td>
                <td><?php echo htmlspecialchars($info_umum['nama_di_rekening_bank']); ?></td>
            </tr>
            <tr>
                <td>Nama Bank - Cabang</td>
                <td><?php echo htmlspecialchars($info_umum['nama_bank_cabang']); ?></td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td><?php echo htmlspecialchars($info_umum['npwp']); ?></td>
            </tr>
            <tr>
                <td>Dasar Pembayaran</td>
                <td><?php echo htmlspecialchars($info_umum['dasar_pembayaran']); ?></td>
            </tr>
        </table>

        <p>Untuk Keperluan:</p>
        <p><?php echo htmlspecialchars($info_umum['keterangan']); ?></p>

        <p>Pembebanan Pada:</p>
        <table>
            <tr>
                <th>KODE REKENING</th>
                <th>URAIAN</th>
                <th class="column-jumlah">NILAI</th>
            </tr>

            <?php

            if (!empty($data_pembebanan)): ?>
                <?php foreach ($data_pembebanan as $beban):
                    $nilai = (float) $beban['nilai_beban']; // Pastikan nilai diubah ke float
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($beban['kode_rekening_beban']); ?></td>
                        <td><?php echo htmlspecialchars($beban['uraian_beban']); ?></td>
                        <td class="column-jumlah">Rp.<?php echo number_format($nilai, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Tidak ada data pembebanan.</td>
                </tr>
            <?php endif; ?>

            <!-- Menampilkan total pembebanan -->
            <tr>
                <td colspan="2" style="text-align: center;"><strong>Total Pembebanan</strong></td>
                <td class="right-align"><strong>Rp.<?php echo number_format($beban['nominal'], 0, ',', '.'); ?></strong></td>
            </tr>
        </table>

        <p>Uang Sejumlah: <strong>(<?php echo terbilang($beban['nominal']); ?> Rupiah)</strong></p>



        <p>Potongan-Potongan:</p>
        <table>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th class="column-jumlah">Jumlah</th>
            </tr>

            <?php
            // Inisialisasi nomor dan total potongan
            $no = 1;
            $totalPotongan = 0;

            // Mengasumsikan $data_potongan adalah array yang berisi data potongan
            // Loop untuk menampilkan semua data potongan dan menghitung total
            foreach ($data_potongan as $data) {
                // Menambahkan jumlah potongan ke total
                $totalPotongan += $data['jumlah_potongan'];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?php echo htmlspecialchars($data['uraian_potongan']); ?></td>
                    <td class="column-jumlah">Rp.<?php echo number_format($data['jumlah_potongan'], 0, ',', '.'); ?></td>
                </tr>
            <?php } ?>

            <!-- Menampilkan total potongan hanya untuk tampilan -->
            <tr>
                <td colspan="2" style="text-align: center;"><strong>Jumlah</strong></td>
                <td class="right-align"><strong>Rp.<?php echo number_format($totalPotongan, 0, ',', '.'); ?></strong></td>
            </tr>
        </table>



        <p>SPM Yang Dibayarkan:</p>
        <table>
            <tr>
                <td colspan="2" class="left-align">Jumlah Yang Diminta (Bruto)</td>
                <td class="column-jumlah"><strong>Rp.<?php echo number_format($beban['nominal'] + $totalPotongan, 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td colspan="2" class="left-align">Jumlah Potongan</td>
                <td class="column-jumlah"><strong>Rp.<?php echo number_format($totalPotongan, 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td colspan="2" class="left-align">Jumlah Netto</td>
                <td class="column-jumlah"><strong>Rp.<?php echo number_format($beban['nominal'], 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><strong>Jumlah</strong></td>
                <td class="column-jumlah"><strong>Rp.<?php echo number_format($beban['nominal'] + $totalPotongan, 0, ',', '.'); ?></strong></td>
            </tr>
        </table>



        <div class="footer">
            <p><?php echo $tanggal_lengkap; ?></p>
            <div class="signature">
                <p style="margin-bottom: 100px;">Kepala Perbendaharaan <br>BPKPAD,</p>
                <p><b><u><?php echo $nama_kepala; ?></u></b></p>
                <?php echo $nip; ?></p>
            </div>
        </div>
    </div>
</body>

</html>