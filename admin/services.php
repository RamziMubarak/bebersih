<?php
session_start();


include('layouts/header.php');

$q_services = "SELECT * FROM layanan";
$r_services = mysqli_query($conn, $q_services);
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Services</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Services</li>
        </ol>
    </nav>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Nama</th>
                        <th>Desc</th>
                        <th>Harga</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($r_services)) : ?>
                        <tr>
                            <td><?php echo $row['id_layanan']; ?></td>
                            <td><?php echo $row['photo']; ?></td>
                            <td><?php echo $row['nama_layanan']; ?></td>
                            <td><?php echo $row['desc']; ?></td>
                            <td><?php echo $row['harga']; ?></td>
                            <td class="text-center">
                                <button data-bs-toggle="modal" data-bs-target="#modal2<?= $row['id_layanan']; ?>" class="btn btn-info btn-circle">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="delete_services.php?id_layanan=<?php echo $row['id_layanan']; ?>" onclick="return confirm('Data ini akan dihapus?')" role="button" class="btn btn-danger btn-circle">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="modal2<?= $row['id_layanan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Rubah Keahlian Anda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="edit_services.php?id_layanan=<?= $row['id_layanan']; ?>" method="POST" enctype="multipart/form-data">

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama : </label>
                                                <input name="nama_layanan" type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Desc : </label>
                                                <input name="desc" type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Harga : </label>
                                                <input name="harga" type="text" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Photo: </label>
                                                <input name="photo" type="file" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<?php include('layouts/footer.php'); ?>