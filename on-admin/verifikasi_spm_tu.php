<?php
include "../Koneksi.php";
// Query untuk mengambil data dari tabel
$sql = "SELECT * FROM spm_tu";
$result = $koneksi->query($sql);
?>

<table class="table mb-0 text-nowrap text-md-nowrap">
    <thead>
        <tr>
            <th>NO</th>
            <th>ID REGISTRASI</th>
            <th>JENIS SPM</th>
            <th>TANGGAL SPM</th>
            <th>NO REKENING BANK</th>
            <th>NAMA DI REKENING BANK</th>
            <th>NAMA BANK CABANG</th>
            <th>NPWP</th>
            <th>DASAR PEMBAYARAN</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['id_registrasi']); ?></td>
                    <td><?= htmlspecialchars($row['jenis_spm']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_spm']); ?></td>
                    <td><?= htmlspecialchars($row['no_rekening_bank']); ?></td>
                    <td><?= htmlspecialchars($row['nama_di_rekening_bank']); ?></td>
                    <td><?= htmlspecialchars($row['nama_bank_cabang']); ?></td>
                    <td><?= htmlspecialchars($row['npwp']); ?></td>
                    <td><?= htmlspecialchars($row['dasar_pembayaran']); ?></td>
                    <td>
                        <a href="edit_spm_tu.php?id_spm_tu=<?= urlencode($row['id_spm_tu']); ?>" class="edit-button me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="print_spm_tu.php?id_spm_tu=<?= $row['id_spm_tu']; ?>" class="print-button me-2">
                            <i class="fas fa-print"></i> Print
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" class="text-center">Data tidak tersedia</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
