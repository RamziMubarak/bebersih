<?php
include('connection.php');

if (isset($_POST['register_btn'])) {
    $path = "img/admin/" . basename($_FILES['photo_customer']['name']);
    $email_customer = $_POST['email_customer'];
    $password_customer = $_POST['password_customer'];
    $nama_customer = $_POST['nama_customer'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $image = $_FILES['photo_customer']['name'];

    $query = "INSERT INTO customer VALUES ('','$email_customer','$password_customer','$nama_customer','$alamat','$no_telp','$image')";

    $result = mysqli_query($conn, $query);

    if (move_uploaded_file($_FILES['photo_customer']['tmp_name'], $path)) {
        echo "<script> alert('Produk berhasil di upload.');
       
        </script>";
    }

    if ($result) {
        header("location: login.php");
    } else {
        header("location: register.php?error=Registrasi+gagal");
    }

die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebersih</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

<body>
    <div class="container">
        <div class="right">
            <img src="img/image.png" style="height: 450px; margin-top: 100px;">
        </div>
        <div class="login">
            <form method="POST" action="register.php" enctype="multipart/form-data">
                <h1 class="atas">Register</h1>
                <p class="atas">Welcome to Bebersih</p>
                <label class="p"  for="">Email</label>
                <input type="email" name="email_customer" placeholder="">
                <label class="p" for="">Password</label>
                <input type="password"  name="password_customer" placeholder="">
                <label class="p"  for="">Name</label>
                <input type="text" name="nama_customer" placeholder="Nama Anda">
                <label class="p" name="alamat" for="">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat Rumah Anda">
                <label class="p" for="">Phone</label>
                <input type="text" name="no_telp" placeholder="Nomer Telepon Anda">
                <div class="mb-3">
                    <label for="mail">Picture</label>
                    <input type="file" name="photo_customer" class="form-control my-3">
                </div>
                <div class="mb-3 mt-4 ">
                    <input type="submit" class="site-btn  rounded-pill " id="register-btn" name="register_btn" value="Register" style="width: 140px; height: 40px; border: none; font-size: 14px; margin-left: 50px; margin-top: 10px;">
                </div>
            </form>
        </div>

    </div>
</body>