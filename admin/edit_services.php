<?php

include 'connection.php';


$path = "img/" . basename($_FILES['picture']['name']);
$image = $_FILES['picture']['name'];
$id_layanan = $_GET['id_layanan'];
$nama_layanan = $_POST['nama_layanan'];
$desc = $_POST['desc'];
$harga = $_POST['harga'];

//upload gambar
$q = "UPDATE layanan SET nama_layanan = '$nama_layanan' , `desc` = '$desc' , harga = '$harga' where id_layanan = '$id_layanan' ";

$result = mysqli_query($conn, $q);

if (move_uploaded_file($_FILES['picture']['tmp_name'], $path)) {
    echo "<script> alert('Produk berhasil di Edit.');
        window.location.href='services.php';

        </script>";
}

if ($result) {
    $success = true;
    header("location:services.php?success=$success&pesan=anda berhasil edit");
} else {
    $success = false;
    header("location:services.php?success=$success&pesan=anda gagal edit");
}

die();
