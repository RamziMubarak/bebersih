<?php
include('connection.php');
session_start();

include 'layouts/header.php';

$q_admin = "SELECT * FROM admin";
$r_admin = mysqli_query($conn, $q_admin);

$q_layanan = "SELECT * FROM layanan";
$r_layanan = mysqli_query($conn, $q_layanan);



if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['email_customer']);
        header('location: login.php');
        exit;
    }
}



?>


<!-- Header-->
<header class="" style="background-image: url(img/hero/hero.jpg); background-size: cover; height: 800px; width: 100%;" id="utama">
    <div class="container px-4 text-center">
        <h1 class="atas fw-bolder " style="margin-top: 100px; color: black; ">Welcome To Bebersih</h1>
        <p class="atas lead" style="color: black;">A functional Bootstrap 5 boilerplate for one page scrolling
            websites
        </p>
        <a class="btn btn-lg btn-light" href="#about">About Us!</a>
    </div>
</header>

<!-- About section-->
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2 class="atas text-center" style="font-size: 3.7em; color: #3497DA">About Us</h2>
                <div class="d-flex justify-content-center">
                    <img class="mt-5" src="img/logotextpng.png" alt="">
                </div>
                <p class="lead text-center mt-5 fs-4">Selamat datang di Bebersih, brand yang menyediakan layanan
                    service untuk memastikan rumah Anda tetap bersih dan nyaman. Kami bangga menjadi mitra kebersihan Anda
                    dan menawarkan solusi terbaik untuk memenuhi kebutuhan pembersihan rumah Anda.</p>
                <p class="lead text-center fs-4"> Bebersih didirikan dengan visi untuk kepada pelanggan kami. Kami
                    memahami betapa berharganya
                    waktu dan lingkungan yang bersih bagi Anda, dan itulah mengapa kami mengutamakan kualitas
                    layanan dan kepuasan pelanggan.</p>
            </div>
        </div>
    </div>
</section>


<!-- Services section-->
<section class="bg-light" id="ourservice">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center" style="font-size: 3.7em; color: #3497DA">Our Service </h2>
                <div class="p row row-cols-1 row-cols-md-2 g-4 text-center mt-3">
                    <?php while ($row2 = mysqli_fetch_assoc($r_layanan)) : ?>
                        <div class="col">
                            <div class="card border-0" style="background-color: transparent;">
                                <img src="img/product/<?php echo $row2['photo'] ?>" class="card-img-top object-fit-cover" alt="..." height="350px">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row2['nama_layanan'] ?></h5>

                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact section-->
<section id="contact">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center" style="font-size: 3.7em; color: #3497DA">Developer</h2>
                <div class="row row-cols-1 row-cols-md-3 g-4 mt-5">
                    <?php while ($row = mysqli_fetch_assoc($r_admin)) : ?>
                        <div class="col" >
                            <div class="card h-100  border-0" >
                                <img src="img/admin/<?php echo $row['photo_admin'] ?>" class="card-img-top object-fit-cover" alt="..." height="250px">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['nama_admin'] ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include 'layouts/footer.php';
?>