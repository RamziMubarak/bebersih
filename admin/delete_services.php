<?php

include 'connection.php';

$id_layanan = $_GET['id_layanan'];
//upload gambar
$q = "DELETE FROM layanan where id_layanan = '$id_layanan'";

$result = mysqli_query($conn, $q);


if ($result) {
    $success = true;
    header("location:services.php?success=$success&pesan=Anda Berhasil Menghapus");
} else {
    $success = false;
    header("location:services.php?success=$success&pesan=Anda Gagal Menghapus");
}

die();
