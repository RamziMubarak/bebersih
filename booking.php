<?php
include('connection.php');
session_start();

$q_layanan = "SELECT * FROM layanan";
$r_layanan = mysqli_query($conn, $q_layanan);

// Inisialisasi variabel flag
$dataNotFound = false;

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // Query untuk mencari berdasarkan id_layanan
    $q_search = "SELECT * FROM layanan WHERE id_layanan = '$search'";
    $r_search = mysqli_query($conn, $q_search);
}

if (isset($_POST['btn-search'])) {
    $search = $_POST['txt-search'];
    if (!empty($search)) {
        $query = "SELECT * FROM layanan WHERE nama_layanan LIKE '%$search%'";
    } else {
        echo "<script>alert('Silakan masukkan kata kunci pencarian.');</script>";
        $query = "SELECT * FROM layanan";
    }
} else {
    $query = "SELECT * FROM layanan";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    $dataNotFound = true;
}

include 'layouts/header.php';
?>


<div class="container-fluid" style="margin-top: 100px; background-color: #F6F7F9;">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb__text" style="margin-left: 10%; margin-top: 30px; margin-bottom: 30px;">
                <h4>Shop</h4>
                <div class="breadcrumb__links" style="font-size: 18px;">
                    <a href="index.php" style="text-decoration: none;  ">Home</a>
                    <span style="margin-left: 20px; opacity: 0.5;">Booking</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-5">
    <div class="w-100 d-flex">
        <div class="w-25 ">
            <form method="POST" action="booking.php">
                <div class="input-group mb-3" style="width: 250px; margin-left: 40px;">
                    <input type="text" class="form-control" placeholder="Cari Layanan" name="txt-search">
                    <button class="btn btn-primary" type="submit" name="btn-search">Cari</button>
                    <button class="btn btn-secondary" type="reset" onclick="window.location.href='booking.php'"><i class="fas fa-sync-alt">Reset</i></button>
                </div>
        </div>
        </form>

        <?php
        if ($dataNotFound) {
            echo "<script>alert('Data tidak ditemukan.');</script>";
        }
        ?>
        <div class="atas w-75">

            <!-- Card -->
            <div class="row row-cols-1 row-cols-md-4 g-3 mb-5">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="col ms-4">
                        <div class="card h-100 w-100 border-0">
                            <img src="img/product/<?php echo $row['photo'] ?>" class="card-img-top object-fit-cover" alt="..." height="250px">
                            <div class="card-body ">
                                <h5 class="card-title"> <?php echo $row['nama_layanan'] ?> <br> </h5>
                                <p class="desc card-text"><?php echo $row['desc'] ?></p>
                                <p class="card-text" style="color: red; "></p><?php echo $row['harga'] ?></p>
                                <div class=" d-flex">
                                    <a class="p btn btn-primary  border-0 d-flex justify-content-center" href="add_cart.php?id_layanan=<?php echo $row['id_layanan'] ?>" role="button" type="submit" style="background-color: #3497DA; ">Booking Now</a>
                                    <button cl data-bs-toggle="modal" data-bs-target="#modal2<?= $row['id_layanan'] ?>" class="btn btn-primary ms-2">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modal2<?= $row['id_layanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <div class="mb-3 w-75">
                                        <img src="img/product/<?php echo $row['photo'] ?>" style="margin-left: 60px;">
                                    </div>
                                    <div class=" mb-2">
                                        <h2 for="tingkat" class="form-label"> <?php echo $row['nama_layanan'] ?> </h2>
                                        <p for="tingkat" class="form-label"> <?php echo $row['desc'] ?> </p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mail">Harga</label>
                                        <h5 for="tingkat" class="form-label"> <?php echo $row['harga'] ?> </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <a class="p btn btn-primary   border-0 d-flex " href="add_cart.php?id_layanan=<?php echo $row['id_layanan'] ?>" role="button" type="submit" style="background-color: #3497DA; ">Booking Now</a>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>



<?php
include 'layouts/footer.php';
?>