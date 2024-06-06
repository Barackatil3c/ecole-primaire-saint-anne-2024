<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
}
if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $price = $_POST['PricePerKg'];
    $quantity = $_POST['quantity'];
    $total = $price * $quantity;

    $insert = $conn->query("INSERT INTO products(ProductName,PricePerKg,quantity,Total_price) VALUES('$pname','$price','$quantity','$total')");
    if ($insert) {
        header("location:products.php");
    } else {
        header("location:add_products.php?error=product not added");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/user.jpg" type="image/x-icon">
    <title>Add product</title>
</head>
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

/* Layout */
.container-fluid {
    display: flex;
    flex-direction: column;
    height: 100vh;
}

.content {
    display: flex;
    flex: 1;
    margin-top: 60px; /* Adjusted for navbar height */
}

.border {
    border: 1px solid #ddd;
}

.rounded {
    border-radius: 5px;
}

/* Colors */
.bg-warning {
    background-color: #ffc107;
}

.bg-primary {
    background-color: #007bff;
}

.bg-success {
    background-color: #28a745;
}

.bg-info {
    background-color: #17a2b8;
}

.bg-danger {
    background-color: #dc3545;
}

.text-black {
    color: #000;
}

.text-white {
    color: #fff;
}

.text-center {
    text-align: center;
}

/* Spacing */
.mt-2 {
    margin-top: 0.5rem;
}

.m-1 {
    margin: 0.25rem;
}

.m-3 {
    margin: 1rem;
}

.m-4 {
    margin: 1.5rem;
}

.p-5 {
    padding: 3rem;
}

.p-4 {
    padding: 1.5rem;
}

.ms-3 {
    margin-left: 1rem;
}

.me-2 {
    margin-right: 0.5rem;
}

/* Navbar */
nav {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #07ffb7;
    z-index: 1000;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1rem;
    top: -8px;
}

.nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
}

.nav-brand {
    display: flex;
    align-items: center;
}

.nav-brand img {
    border-radius: 50%;
    width: 60px;
    margin-right: 1rem;
}

.nav-brand h5 {
    margin: 0;
    font-weight: bold;
}

.nav-item {
    margin-left: 1rem;
}

.nav-link {
    color: #000;
    text-decoration: none;
    padding: 0.5rem;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: #0056b3;
}

/* Cards */
.card {
    border: 1px solid #ddd;
    border-radius: 0.25rem;
    margin-bottom: 1rem;
}

.card-header {
    padding: 0.75rem 1.25rem;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

/* Buttons */
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-warning {
    color: #212529;
    background-color: #07ffb7;
    border-color: #07ffb7;
}

.btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
}

.btn-danger {
    color: #fff;
    background-color: #dc3545;
    border-color: #dc3545;
}

.btn-dark {
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

/* Tables */
.table {
    width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.075);
}

.table-bordered {
    border: 1px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05);
}

.table-dark {
    background-color: #343a40;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
    border-color: #454d55;
}

.table-dark.table-bordered {
    border: 0;
}

/* Icons */
.fa {
    margin-right: 0.5rem;
}
.placeholder{
    height: 40px;
    padding: 9px;
    border-color: transparent;
}
.placeholder input{
    padding: 10px;
    border-color: transparent;
    border-radius: 6px;
}

</style>

<body>
    <?php include "nav.php" ?><br><br><br><br><br><br>
    <div class="col-sm-9 ms-3">
        <!-- <button class="btn m-1"><i class="fa-solid fa-bars " style="font-size:30px"></i></button> -->
        <div class="card ">
            <div class="card-header">
                <center> <i class="fa-solid  fa-clock-rotate-left"></i> Our Prdoucts</center>
            </div>
            <div class="card-body">
                <form method="post" class="border rounded shadow p-4 mt-3">
                    <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        echo '<div class="alert alert-danger alert-dismissible">
                       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>' .
                            $error . '
                     </div>';
                    }
                    ?>
                    <div class="placeholder">
                        <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Product name</span>
                        <input type="text" placeholder="Enter product name" name="pname" class="form-control">
                    </div><br>
                    <div class="placeholder">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i>&nbsp; Price</span>
                        <input type="text" placeholder="Enter product price per kg" name="PricePerKg" class="form-control">
                    </div><br>
                    <div class="placeholder">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i>&nbsp; Quantity</span>
                        <input type="text" placeholder="Enter product quantity" name="quantity" class="form-control">
                    </div>
                    <center><button type="submit" name="submit" class="btn btn-dark"><i class="fa-solid fa-plus"></i>Add</button></center>
                </form>
            </div>
        </div>

    </div>
    </div>
    </div>
    <?php include "footer.php" ?>
</body>

</html>