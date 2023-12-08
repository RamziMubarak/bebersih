<?php
include 'connection.php';
session_start();
$id_layanan = $_GET["id_layanan"];

$Add = "SELECT * FROM layanan WHERE id_layanan = '$id_layanan' ";
$query = mysqli_query($conn, $Add);
$row = mysqli_fetch_object($query);

$_SESSION['cart'][$id_layanan] = [
    "id_layanan" => $row->id_layanan,
    "nama_layanan" => $row->nama_layanan,
    "harga" => $row->harga,
    "photo" => $row->photo,
    
    "jumlah" => 1
];

header("Location: booking-cart.php");
?>
