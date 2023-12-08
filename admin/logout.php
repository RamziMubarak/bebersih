<?php session_start(); ?>

<?php
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['email_admin']);
        unset($_SESSION['nama_admin']);
        header('location: ../login.php');
        exit;}
}
?>