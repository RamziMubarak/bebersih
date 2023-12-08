<?php
include('connection.php');
session_start();

// Simpan data order ke dalam tabel orders pada database
if (isset($_POST['booking_now'])) {
    $orders = $_SESSION['cart'];
    $id_customer = $_SESSION['id_customer'];
    $tanggal = date('Y-m-d');

    $query = "INSERT INTO `order` (id_layanan, id_customer, total, tanggal,status,nama,no_rumah,no_wa,alamat) VALUES ";
    $values = array();

    foreach ($orders as $order) {
        $id_layanan = mysqli_real_escape_string($conn, $order["id_layanan"]);
        $total = $order["harga"] * $order["jumlah"];
        $values[] = "('$id_layanan', '$id_customer', '$total', '$tanggal','Menunggu','','','','')";
    }

    $query .= implode(", ", $values);

    if (mysqli_query($conn, $query)) {
        // Dapatkan ID order yang baru
        $id_order_baru = mysqli_insert_id($conn);

        // Reset keranjang belanja setelah order selesai
        $_SESSION['cart'] = array();

        // Redirect ke halaman booking-details.php dengan membawa ID order
        header("location: booking-details.php?id_order=$id_order_baru");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
include 'layouts/header.php';
?>

<div class="container-fluid" style="margin-top: 100px; background-color: #F6F7F9;">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb__text" style="margin-left: 10%; margin-top: 30px; margin-bottom: 30px;">
                <h4>Shop</h4>
                <div class="breadcrumb__links" style="font-size: 18px; color: black; ">
                    <a href="index.php" style="text-decoration: none;  ">Home</a>
                    <a href="booking.php" style="text-decoration: none; margin-left: 20px;  ">Booking</a>
                    <span style="margin-left: 20px; opacity: 0.5;">Booking Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid menu-list mt-3 mb-5">
    <div class="w-100 d-flex">
        <div class="w-50">
            <div style="margin-left: 20%; margin-top: 80px;">

                <?php
                if (!empty($_SESSION['cart'])) {
                ?>
                    <table class="table" border="0">
                        <tr>
                            <th class="text-center my-3">
                                <h3> Service </h3>
                            </th>
                            <th class="text-center my-3">
                                <h3> Subtotal </h3>
                            </th>
                            <th></th>
                        </tr>
                        <?php
                        $no = 1;
                        $grandtotal = 0;
                        foreach ($_SESSION['cart'] as $cart => $val) {
                            $subtotal = $val["harga"] * $val["jumlah"];
                        ?>
                            <tr>
                                <td style="display: flex;"><img src="img/product/<?php echo $val["photo"]; ?>" alt="Gambar Produk" class="product-image" style="width: 100px; height: 100px; margin-left: 20px ; ">
                                    <h5 style="margin-top:  36px; margin-left: 20px;">  <?php echo $val["nama_layanan"]; ?>  </h5>
                                </td>

                                <td>
                                    <h5 style="margin-top: 40px; margin-left: 45px;"> <?php echo $subtotal; ?> </h5>
                                </td>

                                <td> <a class="btn btn-danger my-3 mt-4"  href="hapus_cart.php?id_layanan=<?php echo $cart ?>">Hapus</a></td>
                            </tr>
                        <?php
                            $grandtotal += $subtotal;
                        }
                        ?>
                    </table>
                <?php
                } else {
                    header("location: booking.php");
                }
                ?>
            </div>
        </div>

        <div class="atas w-50">
            <div class="kedua container-fluid ">
                <div style="margin-left: 5%;" class="mt-5">
                    <h3>Cart Total</h3>
                    <p style="margin-top: 70px;">Total <b style="margin-left: 55%; color: red;" class="text-align: right;">Rp. <?php echo $grandtotal; ?> </b> </p>
                    <form action="booking-cart.php" method="POST">
                        <input type="submit" class="site-btn  rounded-pill " style="margin-left: 80px; margin-top: 15px;" name="booking_now" value="Booking">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<?php
include 'layouts/footer.php';
?>