<?php
include('connection.php');
session_start();



$id_customer = $_SESSION['id_customer'];

// Query untuk mencari berdasarkan id_layanan
$q_order = "SELECT `order`.id_order, layanan.nama_layanan, `order`.Total, `order`.status FROM `order` JOIN layanan ON `order`.id_layanan = layanan.id_layanan WHERE `order`.id_customer = '$id_customer' AND `order`.status = 'Pekerja Selesai'";
$r_order = mysqli_query($conn, $q_order);


if (isset($_POST['selesai'])) {
    $id_order = $_GET['id_order'];

    $query = "UPDATE `order` SET status = 'Layanan Selesai' WHERE id_order = '$id_order'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: pesanan.php");
        exit;
    } else {
        // Terjadi kesalahan saat pembaruan data
        echo "Error: " . mysqli_error($conn);
    }
}


if (!$r_order) {
    echo "Error: " . mysqli_error($conn);
    exit; // Hentikan eksekusi skrip jika terjadi kesalahan
}

include 'layouts/header.php';
?>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
            </div>
        </div>



        <div class="row text-center justify-content-center">
            <div class="col-md-6" style="width: 1000px;">
                <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <h3 class="mb-4">Riwayat Pesanan
                        </h3>
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>ID Order</th>
                                    <th>Nama</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Terima Pesanan</th>
                                </tr>

                                <?php while ($row = mysqli_fetch_assoc($r_order)) : ?>
                                    <tr>
                                        <td>
                                            <h5> <?php echo $row["id_order"]; ?> </h5>
                                        </td>
                                        <td>
                                            <h5> <?php echo $row["nama_layanan"]; ?> </h5>
                                        </td>
                                        <td>
                                            <h5> <?php echo $row['Total']; ?> </h5>
                                        </td>
                                        <td>
                                            <h5> <?php echo $row['status']; ?> </h5>
                                        </td>
                                        <form method="POST" action="pesanan.php?id_order=<?= $row['id_order'] ?>">
                                            <td><button type="submit" name="selesai" class="btn btn-primary">Selesai</button></td>
                                        </form>
                                    </tr>

                                <?php endwhile; ?>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
</section>


<?php
include 'layouts/footer.php';
?>