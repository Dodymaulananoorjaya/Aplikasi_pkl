<?php
include '../koneksi.php';

// ID yang ingin dicari
$id_sp2d = isset($_GET['id_sp2d']) ? (int)$_GET['id_sp2d'] : null;



// Query untuk menampilkan data berdasarkan ID
$sql = "SELECT 
    s.tanggal_spm,
    s.dari,
    s.tahun_anggaran,
    s.nomor_sp2d,
    p.skpd,
    p.cv,
    p.nomor_spm,
    p.keterangan,
    p.nominal,
    m.kode_rekening_beban,
    m.uraian_beban,
    m.nilai_beban,
    m.uraian_potongan,
    m.jumlah_potongan,
    t.tanggal_spm,
    t.no_rekening_bank,
    t.nama_di_rekening_bank,
    t.nama_bank_cabang,
    t.npwp
FROM 
    sp2d s
JOIN 
    registrasi p ON s.id_registrasi = p.id_registrasi
JOIN
    isi_spm m ON s.id_registrasi = m.id_registrasi
JOIN
    spm_tu t ON s.id_registrasi = t.id_registrasi  
WHERE 
    s.id_sp2d = ?";

// Mempersiapkan statement untuk keamanan (menghindari SQL Injection)
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_sp2d);
$stmt->execute();
$result = $stmt->get_result();


// Cek data dan siapkan array untuk data laporan
$info_umum = [];

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
                'nomor_spm' => $row['nomor_spm'],
                'tanggal_spm' => $row['tanggal_spm'],
                'nomor_sp2d' => $row['nomor_sp2d'],
                'tahun_anggaran' => $row['tahun_anggaran'],
                'cv' => $row['cv'],
                'npwp' => $row['npwp'],
                'no_rekening_bank' => $row['no_rekening_bank'],
                'nama_di_rekening_bank' => $row['nama_di_rekening_bank'],
                'nama_bank_cabang' => $row['nama_bank_cabang'],
                'keterangan' => $row['keterangan'],
                'nominal' => $row['nominal'],
                'kode_rekening_beban' => $row['kode_rekening_beban'],
                'uraian_beban' => $row['uraian_beban'],
                'nilai_beban' => $row['nilai_beban'],
                'uraian_potongan' => $row['uraian_potongan'],
                'jumlah_potongan' => $row['jumlah_potongan']
            ];
        }
    }
} else {
    die("Data tidak ditemukan.");
}

$potongan = [
    ['uraian_potongan' => 'Potongan 1', 'jumlah_potongan' => 150000],
    ['uraian_potongan' => 'Potongan 2', 'jumlah_potongan' => 250000],
    ['uraian_potongan' => 'Potongan 3', 'jumlah_potongan' => 100000],
];

// Inisialisasi total potongan
$total_potongan = 0;

// Hitung total potongan
foreach ($potongan as $item) {
    $total_potongan += $item['jumlah_potongan'];
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
            display: flex;
            margin-left: 700px;
            text-align: right;
            margin-top: -80px;
        }

        .signature {
            text-align: center;
            margin-top: 50px;
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <table>
                <tr>
                    <td style="text-align: center;" rowspan="3" colspan="3">PEMERINTAH KOTA BANJARMASIN</td>
                    <td colspan="2" class="header">SURAT PERINTAH PENCAIRAN DANA (SP2D)</td>

                </tr>
                <tr>


                    <td style="text-align: center;" colspan="2">Nomor</td>
                </tr>
                <tr>
                    <td style="text-align: center;" colspan="2"><?php echo $info_umum['nomor_sp2d'] ?></td>
                </tr>
                <tr>
                    <td rowspan="3" colspan="3">nomor spm : <?php echo $info_umum['nomor_spm'] ?> <br><br>tanggal spm : <?php echo $info_umum['tanggal_spm'] ?><br><br>skpd : <?php echo $info_umum['skpd']; ?></td>
                    <td rowspan="3" colspan="3">Dari : KUASA BENDAHARA UMUM
                        DAERAH <br><br>
                        Tahun Anggaran : <?php echo $info_umum['tahun_anggaran'] ?>
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="5">Bank Pengirim:<?php echo $info_umum['nama_bank_cabang'] ?>
                        <br><br>
                        Hendaklah mencairkan / memindahbukukan dari baki Rekening Nomor 2003814125
                        Uang sebesar Rp5.200.000,00 (terbilang: Lima juta dua ratus ribu rupiah)
                    </td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td colspan="5">Kepada : <?php echo $info_umum['cv'] ?> <br><br>
                        NPWP : <?php echo $info_umum['npwp'] ?> <br><br>
                        No. Rekening Bank : <?php echo $info_umum['no_rekening_bank'] ?> <br><br>
                        Nama di Rekening Bank : <?php echo $info_umum['nama_di_rekening_bank'] ?> <br><br>
                        Bank Penerima - Cabang : <?php echo $info_umum['nama_bank_cabang'] ?> - Banjarmasin <br><br>
                        Keperluan Untuk : <?php echo $info_umum['keterangan'] ?> <br><br>
                        Pagu Anggaran : <?php echo $info_umum['nominal'] ?> <br><br>

                </tr>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">KODE REKENING</th>
                    <th style="text-align: center;" colspan="2">URAIAN</th>
                    <th style="text-align: center;">NILAI</th>
                </tr>
                <tr>
                    <td>1</td> <!-- Nomor urut -->
                    <td><?php echo htmlspecialchars($info_umum['kode_rekening_beban']); ?></td>
                    <td colspan="2"><?php echo htmlspecialchars($info_umum['uraian_beban']); ?></td>
                    <td>Rp <?php echo number_format($info_umum['nilai_beban'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th style="text-align: right;" colspan="4">JUMLAH</th>
                    <th style="text-align: right;"><?php echo $info_umum['nominal'] ?></th>
                </tr>
                <tr>
                    <th colspan="5">Potongan-Potongan :</th>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <th style="text-align: center;">No.</th>
                    <th style="text-align: center;" colspan="3">Uraian</th>
                    <th style="text-align: center;">Jumlah</th>
                </tr>
                <tr>
                    <td>1</td> <!-- Nomor urut -->
                    <td colspan="3"><?php echo htmlspecialchars($info_umum['uraian_potongan']); ?></td>
                    <td>Rp <?php echo number_format($info_umum['jumlah_potongan'], 2, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th style="text-align: right;" colspan="4">JUMLAH</th>
                    <th class="text-right">Rp <?php echo number_format($total_potongan, 2, ',', '.'); ?></th>
                </tr>
                <tr>
                    <th colspan="4">SP2D yang Dibayarkan:</th>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="4">Jumlah Potongan:</th>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="4">Jumlah Netto:</th>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="4">Jumlah yang Dibayarkan:</th>
                    <td></td>
                </tr>
                <tr>
                    <th colspan="5">Uang Sejumlah: Seratus tiga puluh lima juta sembilan ratus sembilan puluh empat ribu enam ratus tiga puluh empat rupiah</th>
                </tr>
            </table>

</body>


<p style="margin-left: 455px;"><?php echo $tanggal_lengkap; ?></p>
<div class="footer">
    <div class="signature">
        <p style="margin-bottom: 100px;">Kepala Perbendaharaan <br>BPKPAD,</p>
        <p><b><u><?php echo $nama_kepala; ?></u></b></p>
        <?php echo $nip; ?></p>
    </div>
</div>
<div style="text-align: left; margin-top: 100px;">
    Lembar 1 : Bank Yang Ditunjuk <br><br>
    Lembar 2 : Pengguna Anggaran/Kuasa Pengguna Anggaran <br><br>
    Lembar 3 : Arsip Kuasa BUD <br><br>
    Lembar 4 : Pihak Penerima
</div>
</div>
</body>

</html>