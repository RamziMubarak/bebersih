<?php

include 'connection.php';



$path = "img/" . basename($_FILES['photo_customer']['name']);
$image = $_FILES['photo_customer']['name'];
$id_customer = $_GET['id_customer'];
$nama_customer = $_POST['nama_customer'];
$password_customer = $_POST['password_customer'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

//upload gambar

$q = "UPDATE customer SET nama_customer = '$nama_customer', password_customer = '$password_customer', alamat = '$alamat', no_telp = '$no_telp', photo_customer = '$image' WHERE id_customer = '$id_customer'";

$result = mysqli_query($conn, $q);



if (move_uploaded_file($_FILES['picture']['tmp_name'], $path)) {
    echo "<script> alert('Produk berhasil di Edit.');
        window.location.href='profile-customer.php';

        </script>";
}

if ($result) {
    $success = true;
    header("location:profile-customer.php?success=$success&pesan=anda berhasil edit");
} else {
    $success = false;
    header("location:profile-customer.php?success=$success&pesan=anda gagal edit");
}


die();
