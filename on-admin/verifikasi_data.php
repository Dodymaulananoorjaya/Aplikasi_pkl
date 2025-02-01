<?php
include "../Koneksi.php";

$query = "SELECT id_spm_tu AS id, tanggal_spm, status_verifikasi FROM spm_tu 
          LEFT JOIN verifikasi ON spm_tu.id_spm_tu = verifikasi.id_spm_tu
          
          UNION 

          SELECT id_spm_gu AS id, tanggal_spm, status_verifikasi FROM spm_gu 
          LEFT JOIN verifikasi ON spm_gu.id_spm_gu = verifikasi.id_spm_gu
          
          UNION 

          SELECT id_spm_ls AS id, tanggal_spm, status_verifikasi FROM spm_ls 
          LEFT JOIN verifikasi ON spm_ls.id_spm_ls = verifikasi.id_spm_ls";


// Ambil data untuk dropdown SPM TU
$tuList = [];
$queryTu = "SELECT id_spm_tu, tanggal_spm FROM spm_tu";
$resultTu = $koneksi->query($queryTu);
while ($row = $resultTu->fetch_assoc()) {
    $tuList[] = $row;
}

// Ambil data untuk dropdown SPM GU
$guList = [];
$queryGu = "SELECT id_spm_gu, tanggal_spm FROM spm_gu";
$resultGu = $koneksi->query($queryGu);
while ($row = $resultGu->fetch_assoc()) {
    $guList[] = $row;
}

// Ambil data untuk dropdown SPM LS
$lsList = [];
$queryLs = "SELECT id_spm_ls, tanggal_spm FROM spm_ls";
$resultLs = $koneksi->query($queryLs);
while ($row = $resultLs->fetch_assoc()) {
    $lsList[] = $row;
}


$koneksi->close();
?>


<form method="POST" enctype="multipart/form-data" action="verifikasi_proses.php">
    <div class="row gy-4">
        <!-- Input Id Register -->
        <div class="col-md-8 col-xl-8 col-xxl-8 mb-2">
            <label for="id_spm_tu" class="form-label">Id SPM TU</label>
            <select id="id_spm_tu" class="form-control" name="id_spm_tu">
                <option value="">Pilih Id SPM TU</option>
                <?php if (!empty($tuList)): ?>
                    <?php foreach ($tuList as $tu): ?>
                        <option value="<?php echo htmlspecialchars($tu['id_spm_tu']); ?>">
                            <?php echo htmlspecialchars($tu['tanggal_spm']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Input Id SPM LS -->
        <div class="col-md-8 col-xl-8 col-xxl-8 mb-2">
            <label for="id_spm_ls" class="form-label">Id SPM LS</label>
            <select id="id_spm_ls" class="form-control" name="id_spm_ls">
                <option value="">Pilih Id SPM LS</option>
                <?php if (!empty($lsList)): ?>
                    <?php foreach ($lsList as $ls): ?>
                        <option value="<?php echo htmlspecialchars($ls['id_spm_ls']); ?>">
                            <?php echo htmlspecialchars($ls['tanggal_spm']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Input Id SPM GU -->
        <div class="col-md-8 col-xl-8 col-xxl-8 mb-2">
            <label for="id_spm_gu" class="form-label">Id SPM GU</label>
            <select id="id_spm_gu" class="form-control" name="id_spm_gu">
                <option value="">Pilih Id SPM GU</option>
                <?php if (!empty($guList)): ?>
                    <?php foreach ($guList as $gu): ?>
                        <option value="<?php echo htmlspecialchars($gu['id_spm_gu']); ?>">
                            <?php echo htmlspecialchars($gu['tanggal_spm']); ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>

        <!-- Pilihan Verifikasi -->
        <div class="col-12">
            <label for="input-status" class="form-label">Status Verifikasi</label>
            <select class="form-control" id="input-status" name="status_verifikasi" required>
                <option value="" disabled selected>Pilih Status</option>
                <option value="verifikasi">Setuju</option>
                <option value="ditolak">Ditolak</option>
                <option value="dihapus">Dihapus</option>
            </select>
        </div>

        <!-- Submit Input -->
        <div class="col-12">
            <input type="submit" class="form-control btn btn-primary" value="Submit">
        </div>
    </div>
</form>
