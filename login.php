<?php
session_start();
include('connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}



if (isset($_POST['login_btn'])) {
    $email_customer = $_POST['email_customer'];
    $password_customer = $_POST['password_customer'];

    // Query untuk mencari keberadaan pengguna dalam tabel customer
    $query_customer = "SELECT * FROM customer
        WHERE email_customer = ? AND password_customer = ? LIMIT 1";

    // Query untuk mencari keberadaan pengguna dalam tabel admin
    $query_admin = "SELECT * FROM admin
        WHERE email_admin = ? AND password_admin = ? LIMIT 1";

    // Query untuk mencari keberadaan pengguna dalam tabel pekerja
    $query_pekerja = "SELECT * FROM pekerja
        WHERE email_pekerja = ? AND password_pekerja = ? LIMIT 1";

    // Persiapkan statement untuk query customer
    $stmt_customer = $conn->prepare($query_customer);
    $stmt_customer->bind_param('ss', $email_customer, $password_customer);

    // Persiapkan statement untuk query admin
    $stmt_admin = $conn->prepare($query_admin);
    $stmt_admin->bind_param('ss', $email_customer, $password_customer);

    // Persiapkan statement untuk query pekerja
    $stmt_pekerja = $conn->prepare($query_pekerja);
    $stmt_pekerja->bind_param('ss', $email_customer, $password_customer);

    // Eksekusi query customer
    $stmt_customer->execute();
    $stmt_customer->store_result();

    // Eksekusi query admin
    $stmt_admin->execute();
    $stmt_admin->store_result();

    // Eksekusi query pekerja
    $stmt_pekerja->execute();
    $stmt_pekerja->store_result();

    // Jika pengguna ditemukan dalam tabel customer
    if ($stmt_customer->num_rows == 1) {
        $stmt_customer->bind_result(
            $id_customer,
            $email_customer,
            $password_customer,
            $nama_customer,
            $alamat,
            $no_telp,
            $photo_customer
        );
        $stmt_customer->fetch();

        $_SESSION['id_customer'] = $id_customer;
        $_SESSION['email_customer'] = $email_customer;
        $_SESSION['password_customer'] = $password_customer;
        $_SESSION['nama_customer'] = $nama_customer;
        $_SESSION['alamat'] = $alamat;
        $_SESSION['no_telp'] = $no_telp;
        $_SESSION['photo_customer'] = $photo_customer;

        $_SESSION['logged_in'] = true;

        header('location:index.php?message=Logged in successfully');
        exit;
    }
    // Jika pengguna ditemukan dalam tabel admin
    elseif ($stmt_admin->num_rows == 1) {
        $stmt_admin->bind_result(
            $id_admin,
            $email_admin,
            $password_admin,
            $nama_admin,
            $no_telp,
            $photo_admin,
            
        );
        $stmt_admin->fetch();

        $_SESSION['id_admin'] = $id_admin;
        $_SESSION['email_admin'] = $email_admin;
        $_SESSION['password_admin'] = $password_admin;
        $_SESSION['nama_admin'] = $nama_admin;
        $_SESSION['no_telp'] = $no_telp;
        $_SESSION['photo_admin'] = $photo_admin;
        $_SESSION['logged_in'] = true;

        header('location:admin/index.php?message=Logged in successfully');
        exit;
    }
    // Jika pengguna ditemukan dalam tabel admin
    elseif ($stmt_pekerja->num_rows == 1) {
        $stmt_pekerja->bind_result(
            $id_pekerja,
            $email_pekerja,
            $password_pekerja,
            $nama_pekerja,
            $no_telp,
            $photo_pekerja
        );
        $stmt_pekerja->fetch();

        $_SESSION['id_pekerja'] = $id_pekerja;
        $_SESSION['email_pekerja'] = $email_pekerja;
        $_SESSION['password_pekerja'] = $password_pekerja;
        $_SESSION['nama_pekerja'] = $nama_pekerja;
        $_SESSION['no_telp'] = $no_telp;
        $_SESSION['photo_pekerja'] = $photo_pekerja;

        $_SESSION['logged_in'] = true;

        header('location: pekerja/index.php?message=Logged in successfully');
        exit;
    } else {
        header('location: login.php?error=Could not verify your account');
        exit;
    }
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
    <link href="styles.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="right">
            <img src="img/image.png" style="height: 100%;" alt="">
        </div>
        <div class="login">
            <form method="POST" action="login.php">
                <h1 class="atas">Login</h1>
                <p class="p">Welcome To Bebersih</p>
                <label class="p " for="" style="margin-top: 20px;">Email</label>
                <input type="text" name="email_customer" placeholder="">
                <label class="p" for="">Password</label>
                <input type="password" name="password_customer" placeholder="">
                <input type="submit" name="login_btn" id="login-btn" class="submit">
                <p>
                    <a href="register.php">Belum Mempunyai Akun ?</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>