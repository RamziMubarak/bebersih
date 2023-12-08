<?php
ob_start();
session_start();
include('layouts/header.php');

?>

<?php
if (isset($_POST['create_btn'])) {
    $nama_layanan = $_POST['nama_layanan'];
    $desc = $_POST['desc'];
    $harga = $_POST['harga'];

    // This is image file
    $photo = $_FILES['photo']['tmp_name'];

    // Images name
    $image_name1 = str_replace(' ', '_', $nama_layanan) . "1.jpg";


    // Upload image
    move_uploaded_file($photo, "../img/product/" . $image_name1);

    $query_insert_product = "INSERT INTO layanan (nama_layanan, `desc`, harga,
        photo)  VALUES (?, ?, ?, ?)";

    $stmt_insert_product = $conn->prepare($query_insert_product);

    $stmt_insert_product->bind_param(
        'ssss',
        $nama_layanan,
        $desc,
        $harga,
        $image_name1
    );

    if ($stmt_insert_product->execute()) {
        header('location: services.php?success_create_message=Product has been created successfully');
    } else {
        header('location: services.php?fail_create_message=Could not create product!');
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Create services</h1>
    <nav class="mt-4 rounded" aria-label="breadcrumb">
        <ol class="breadcrumb px-3 py-2 rounded mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="services.php">Services</a></li>
            <li class="breadcrumb-item active">Create services</li>
        </ol>
    </nav>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Product</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_services.php">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="nama_layanan">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Service Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Service Price</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="harga">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Service Image</label>
                            <input type="file" class="form-control" id="exampleFormControlInput1" placeholder="" name="photo">
                        </div>
                        <div class="m-t-20 text-right">
                            <a href="services.php" class="btn btn-danger">Cancel <i class="fas fa-undo"></i></a>
                            <button type="submit" class="btn btn-primary submit-btn" name="create_btn">Create <i class="fas fa-save"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include('layouts/footer.php'); ?>