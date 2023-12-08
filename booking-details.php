<?php
include('connection.php');
session_start();

include 'layouts/header.php';

// Cek apakah ada permintaan pembaruan data
if (isset($_POST['update'])) {
    $id_order = $_GET['id_order'];
    $nama = $_POST['nama'];
    $no_rumah = $_POST['no_rumah'];
    $no_wa = $_POST['no_wa'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE `order` SET nama = '$nama', no_rumah = '$no_rumah', no_wa = '$no_wa', alamat = '$alamat' WHERE id_order = '$id_order'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Pembaruan berhasil, lakukan tindakan yang diinginkan
        // Misalnya, tampilkan pesan sukses atau redirect ke halaman lain
        echo '<script>alert("Pembelian Berhasil."); window.location.href = "booking.php";</script>';
        exit;
    } else {
        // Terjadi kesalahan saat pembaruan data
        echo "Error: " . mysqli_error($conn);
    }
}

?>

<div class="container-fluid " style="margin-top: 100px; background-color: #F6F7F9;">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb__text" style="margin-left: 10%; margin-top: 30px; margin-bottom: 30px;">
                <h4>Shop</h4>
                <div class="breadcrumb__links" style="font-size: 18px; color: black; ">
                    <a href="index.php" style="text-decoration: none;">Home</a>
                    <a href="booking.php" style="text-decoration: none; margin-left: 20px;">Booking</a>
                    <a href="booking.php" style="text-decoration: none; margin-left: 20px;">Booking Cart</a>
                    <span style="margin-left: 20px; opacity: 0.5;">Booking Details</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Section Begin -->
<section class="checkout spad ">
    <div class="container" >
        <div class="checkout__form" style="margin-left: 320px;">
        <h1 class="atas"> Details Order </h1>
            <div class="row mt-5">
                <div class="col-lg-8 col-md-6">
                    <form method="POST" action="">
                        <div class="checkout__input">
                            <p>Nama<span>*</span></p>
                            <input type="text" name="nama">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nomor Rumah<span>*</span></p>
                                    <input type="text" name="no_rumah">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nomer WhatsApp<span>*</span></p>
                                    <input type="text" name="no_wa">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Alamat Lengkap<span>*</span></p>
                            <input type="text" name="alamat" placeholder="Street Address" class="checkout__input__add">
                        </div>
                        <input type="submit" name="update" class="btn btn-secondary btn-lg submit mt-2" style="width: 200px; height: 50px; margin-left: 230px;" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<?php include 'layouts/footer.php'; ?>