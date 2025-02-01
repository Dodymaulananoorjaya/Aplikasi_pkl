<?php
include "../Koneksi.php";
// Query untuk mengambil data dari tabel
$sql = "SELECT * FROM registrasi";
$result = $koneksi->query($sql);
?>


<table class="table mb-0 text-nowrap text-md-nowrap">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NOMOR REGISTRASI</th>
                                                <th>SKPD</th>
                                                <th>NO PENGANTAR</th>
                                                <th>CV</th>
                                                <th>NOMINAL</th>
                                                <th>TANGGAL REGISTRASI</th>
                                                <th>NOMOR SPM</th>
                                                <th>URAIAN</th>
                                                <th>KETERANGAN</th>
                                                <th>TRANSFER KE</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($result && $result->num_rows > 0): ?>
                                                <?php $no = 1; // Nomor urut 
                                                ?>
                                                <?php while ($row = $result->fetch_assoc()): ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= htmlspecialchars($row['nomor_registrasi']); ?></td>
                                                        <td><?= htmlspecialchars($row['skpd']); ?></td>
                                                        <td><?= htmlspecialchars($row['no_pengantar']); ?></td>
                                                        <td><?= htmlspecialchars($row['cv']); ?></td>
                                                        <td><?= htmlspecialchars($row['nominal']); ?></td>
                                                        <td><?= htmlspecialchars($row['tanggal_registrasi']); ?></td>
                                                        <td><?= htmlspecialchars($row['nomor_spm']); ?></td>
                                                        <td><?= htmlspecialchars($row['uraian']); ?></td>
                                                        <td><?= htmlspecialchars($row['keterangan']); ?></td>
                                                        <td><?= htmlspecialchars($row['transfer_ke']); ?></td>
                                                        <td>
                                                            <a href="edit_registrasi.php?id_registrasi=<?= $row['id_registrasi']; ?>" class="edit-button me-2">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="print_registrasi.php?id_registrasi=<?= $row['id_registrasi']; ?>" class="print-button me-2">
                                                                <i class="fas fa-edit"></i> Print
                                                            </a>

                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="11">Data tidak tersedia</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>