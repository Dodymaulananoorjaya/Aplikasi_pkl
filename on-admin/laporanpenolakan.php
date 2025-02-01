<?php
include "../Koneksi.php";
// Query untuk mengambil data dari tabel
$sql = "SELECT 
    n.id_penolakan, 
    n.id_spm, 
    n.alasan, 
    p.skpd, 
    p.dari, 
    p.tahun_anggaran
FROM 
    penolakan n
JOIN 
    spm p ON n.id_spm = p.id_spm";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan PENOLAKAN | BPKBAD</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" type="image/x-icon">

    <!-- Choices JS -->
    <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Main Theme Js -->
    <script src="../assets/js/main.js"></script>

    <!-- Style Css -->
    <link href="../assets/css/styles.min.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="../assets/libs/node-waves/waves.min.css" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="../assets/libs/choices.js/public/assets/styles/choices.min.css">


    <link rel="stylesheet" href="../assets/libs/jsvectormap/css/jsvectormap.min.css">

    <link rel="stylesheet" href="../assets/libs/swiper/swiper-bundle.min.css">

    <style>
        .dt-buttons {
            margin-bottom: 15px;
            /* Jarak antara tombol dan tabel */
        }
    </style>
</head>

<body>

    <!-- Loader -->
    <div id="loader">
        <img src="../assets/images/media/media-79.svg" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header">

            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">

                <!-- Start::header-content-left -->
                <div class="header-content-left">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <div class="horizontal-logo">
                            <a href="index.html" class="header-logo">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="desktop-logo">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="toggle-logo">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="desktop-dark" style="height: 50px;">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="toggle-dark" style="height: 50px;">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="desktop-white">
                                <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" alt="logo" class="toggle-white">
                            </a>
                        </div>
                    </div>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link -->
                        <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->


                </div>
                <!-- End::header-content-left -->

                <!-- Start::header-content-right -->
                <div class="header-content-right">

                    <!-- Start::header-element -->
                    <div class="header-element">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="header-link-icon">
                                    <img src="../assets/images/faces/1.jpg" alt="img" width="32" height="32" class="rounded-circle">
                                </div>

                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                            <Li>
                                <div class="header-navheading border-bottom">
                                    <h6 class="main-notification-title">Dody MNJ</h6>
                                    <p class="main-notification-text mb-0">Web Designer</p>
                                </div>
                            </Li>
                            <li><a class="dropdown-item d-flex border-bottom" href="profile.html"><i class="fe fe-user fs-16 align-middle me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item d-flex" href="../logout.php"><i class="fe fe-power fs-16 align-middle me-2"></i>Log Out</a></li>
                        </ul>
                    </div>
                    <!-- End::header-element -->

                </div>
                <!-- End::header-content-right -->

            </div>
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="index.html" class="header-logo">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="desktop-white" alt="logo">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="toggle-white" alt="logo">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="desktop-logo" alt="logo">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="toggle-dark" alt="logo" style="width: 50px;">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="toggle-logo" alt="logo">
                    <img src="../assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="desktop-dark" alt="logo" style="height: 50px;">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">
                <?php include 'menu/menu.php'; ?>
            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">

                <!-- Start::page-header -->

                <div class="d-md-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                    <div>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Halaman Laporan PENOLAKAN</li>
                        </ol>
                    </div>
                </div>

                <!-- End::page-header -->

                <!-- Start::row-1 -->
                <div class="row row-sm">
                    <!-- Content Body -->
                    <!-- Start:: row-1 -->
                    <div class="row row-sm">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header justify-content-between">
                                    <div class="card-title">
                                        Rekapitulasi PENOMORAN
                                    </div>

                                    <!-- Tombol Cetak -->
                                    <div class="prism-toggle">
                                        <button class="btn btn-primary my-2 btn-icon-text d-inline-flex align-items-center" onclick="openAndPrint()">Cetak Laporan</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-nowrap table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>ID SPM</th>
                                                    <th>ALASAN</th>
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
                                                            <td><?= htmlspecialchars($row['alasan']); ?></td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="6">Data tidak tersedia</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End:: row-1 -->
                </div>
                <!-- End::row-1 -->

            </div>
        </div>
        <!-- End::app-content -->

        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted"> Copyright © <span id="year"></span> <a
                        href="javascript:void(0);" class="text-dark fw-semibold">BPKBAD</a>.
                    Designed with by <a href="javascript:void(0);">
                        <span class="fw-semibold text-primary text-decoration-underline">Dody MNJ</span>
                    </a> All
                    rights
                    reserved
                </span>
            </div>
        </footer>
        <!-- Footer End -->
    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="fe fe-arrow-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="../assets/libs/@popperjs/core/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Defaultmenu JS -->
    <script src="../assets/js/defaultmenu.min.js"></script>

    <!-- Node Waves JS-->
    <script src="../assets/libs/node-waves/waves.min.js"></script>

    <!-- Sticky JS -->
    <script src="../assets/js/sticky.js"></script>

    <!-- Simplebar JS -->
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/js/simplebar.js"></script>

    <!-- Color Picker JS -->
    <script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>


    <!-- JSVector Maps JS -->
    <script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

    <!-- JSVector Maps MapsJS -->
    <script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

    <!-- Apex Charts JS -->
    <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- Main-Dashboard -->
    <script src="../assets/js/index.js"></script>


    <!-- Custom-Switcher JS -->
    <script src="../assets/js/custom-switcher.min.js"></script>

    <!-- Custom JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- Cetak -->
    <script>
        function openAndPrint() {
            // Buka cetak.php di jendela baru
            const printWindow = window.open('penolakancetak.php', '_blank');

            // Event onload: Cetak halaman setelah selesai dimuat
            printWindow.onload = function() {
                printWindow.print();

                // Event onafterprint: Tutup jendela setelah cetak selesai
                printWindow.onafterprint = function() {
                    printWindow.close();
                    window.location.href = 'laporanpenolakan.php';
                };
            };

            // Event onbeforeunload: Jika pengguna membatalkan
            printWindow.onbeforeunload = function() {
                window.location.href = 'laporanpenolakan.php';
            };
        }
    </script>
</body>

</html>