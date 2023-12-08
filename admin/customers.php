<?php
session_start();

?>

<?php include('layouts/header.php'); ?>

<?php
$q_customer = "SELECT * FROM customer";
$r_customer = mysqli_query($conn, $q_customer);
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Customers</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Customers</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($r_customer)) : ?>
                        <tr>
                            <td><?php echo $row['id_customer']; ?></td>
                            <td><?php echo $row['email_customer']; ?></td>
                            <td><?php echo $row['nama_customer']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['no_telp']; ?></td>
                        </tr>
                    <?php endwhile;  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('layouts/footer.php'); ?>