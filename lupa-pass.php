<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="dark" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=no'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lupa Password | BPKPAD Kota Banjarmasin</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" type="image/x-icon">

    <!-- Authentication-main Js -->
    <script src="assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style Css -->
    <link href="assets/css/styles.min.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <script>
        if (localStorage.spruhalandingdarktheme) {
            document.querySelector("html").setAttribute("data-theme-mode", "dark")
        }
        if (localStorage.spruhalandingrtl) {
            document.querySelector("html").setAttribute("dir", "rtl")
            document.querySelector("#style")?.setAttribute("href", "assets/libs/bootstrap/css/bootstrap.rtl.min.css");
        }
    </script>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* Menghindari scroll */
        }
    </style>

</head>

<body class="error-1">

    <div class="page main-signin-wrapper">

        <!-- Start::row-1 -->
        <div class="row signpages text-center">
            <div class="col-md-12">
                <div class="card mb-0 col-8" style="margin: 0 auto;">
                    <div class="card-body">
                        <div class="clearfix"></div>
                        <form>
                            <img src="assets/images/brand-logos/BPKPAD_Kota_Banjarmasin.png" class="ht-100" alt="user" style="height: 100px;">
                            
                            <div class="form-group text-start">
                                <label class="form-label">Email</label>
                                <input class="form-control" placeholder="Masukkan Email" type="text">
                            </div>
                            <div class="form-group text-start">
                                <label class="form-label">Password</label>
                                <input class="form-control" placeholder="Masukkan Password" type="password">
                            </div>
                            <div class="d-grid">
                                <a href="#" class="btn btn-primary">Masuk</a>
                            </div>
                        </form>
                        <div class="text-start mt-5 ms-0">
                            <div>Sudah Mendapatkan Password? Silahkan <a href="index.php">Masuk</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End::row-1 -->

    </div>

    <!-- Custom-Switcher JS -->
    <script src="assets/js/custom-switcher.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>