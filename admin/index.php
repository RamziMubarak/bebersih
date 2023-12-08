<?php

include('connection.php');
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('location: ../login.php');
    exit;
}   

// Setelah proses login berhasil

$query_total_orders = "SELECT COUNT(*) AS total_orders FROM `order`";
$stmt_total_orders = $conn->prepare($query_total_orders);
$stmt_total_orders->execute();
$stmt_total_orders->bind_result($total_orders);
$stmt_total_orders->store_result();
$stmt_total_orders->fetch();

$query_total_payments = "SELECT SUM(`Total`) AS total_payments FROM `order` ";
$stmt_total_payments = $conn->prepare($query_total_payments);
$stmt_total_payments->execute();
$stmt_total_payments->bind_result($total_payments);
$stmt_total_payments->store_result();
$stmt_total_payments->fetch();

$query_total_customer = "SELECT COUNT(*) AS total_customer FROM customer";
$stmt_total_customer = $conn->prepare($query_total_customer);
$stmt_total_customer->execute();
$stmt_total_customer->bind_result($total_customer);
$stmt_total_customer->store_result();
$stmt_total_customer->fetch();

include('layouts/header.php');

?>



<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4 ml-4 ">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_orders)) {
                                                                                echo $total_orders;
                                                                            } ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 ">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_payments)) {
                                                                                echo $total_payments;
                                                                            } ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4 ">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Customers</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php if (isset($total_customer)) {
                                                                                echo $total_customer;
                                                                            } ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include('layouts/footer.php'); ?>