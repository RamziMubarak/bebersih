<?php
include('connection.php');
session_start();

?>

<?php include('layouts/header.php'); ?>

<?php
$q_order = "SELECT * FROM `order`";
$r_order = mysqli_query($conn, $q_order);
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">orders</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">orders</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Order</th>
                        <th>ID Layanan</th>
                        <th>ID Customer</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($r_order)) : ?>
                        <tr>
                            <td><?php echo $row['id_order']; ?></td>
                            <td><?php echo $row['id_layanan']; ?></td>
                            <td><?php echo $row['id_customer']; ?></td>
                            <td><?php echo $row['Total']; ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                        </tr>
                    <?php endwhile;  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('layouts/footer.php'); ?>