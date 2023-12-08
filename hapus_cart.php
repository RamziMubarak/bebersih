<?php
include 'connection.php';
session_start();

$id_layanan = $_GET["id_layanan"];

unset($_SESSION["cart"][$id_layanan]);

header("Location: booking.php");
