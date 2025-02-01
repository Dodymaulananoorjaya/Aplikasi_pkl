<?php
include "../Koneksi.php";

// Query untuk mengambil data yang ditolak
$query = "SELECT * FROM verifikasi WHERE status_verifikasi = 'ditolak'";
$result = $koneksi->query($query);

// Cek apakah query berhasil
if (!$result) {
    die("Error: " . $koneksi->error);
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(59, 57, 57);
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: black;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f44336;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>  
                <th>ID SPM TU</th>
                <th>ID SPM LS</th>
                <th>ID SPM GU</th>
                <th>Status Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>  
                        <td><?= htmlspecialchars($row['id_spm_tu'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['id_spm_ls'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['id_spm_gu'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['status_verifikasi']) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
