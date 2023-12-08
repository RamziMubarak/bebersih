<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="">
    <title>Bebersih</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/lock.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/user.css' rel='stylesheet'>

    <!-- <script>
        
        function changeFunc() {
            var selectBox = document.getElementById("selectbox");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;

            if (selectedValue == 1) {
                location.href = 'update-profile.php';
            } else if (selectedValue == 2) {
                location.href = 'dashboard.php?logout=success';
            }
        }
    </script> -->
</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar fixed-top bg-white" id="mainNav">
        <div class="container-fluid">

            <tr>
                <a class="atas nav-link float-right" onclick="redirectToURLWithID('index.php', 'utama')" style="margin-left: 10%;">Home</a>
                <a class="atas nav-link" onclick="redirectToURLWithID('index.php','about')" style="margin-left: 80px;">About</a>
                <a class="atas nav-link" onclick="redirectToURLWithID('index.php','ourservice')" style="margin-left: 80px;">Our Service</a>
                <img src="img/logo.png" alt="" style="width: 60px; height: 60px; margin-left: auto; margin-right: auto">

                <?php
                // Periksa status login pengguna
                if (isset($_SESSION['logged_in'])) {
                    // Jika pengguna sudah login
                ?>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['nama_customer']; ?>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile-customer.php">Profile</a></li>
                            <li><a class="dropdown-item" href="pesanan.php">Pesanan Berlangsung</a></li>
                            <li><a class="dropdown-item" href="index.php?logout=1">Log Out</a></li>
                        </ul>
                    </div>
                <?php
                } else if (!isset($_SESSION['logged_in'])) {
                    // Jika pengguna belum login
                ?>
                    <a class="atas nav-link" href="login.php">Login</a>
                    
                <?php
                }
                ?>

                <a class="atas nav-link" href="booking.php" style="margin-left: 80px; margin-right: 10%;">Booking Online</a>
            </tr>

        </div>
    </nav>