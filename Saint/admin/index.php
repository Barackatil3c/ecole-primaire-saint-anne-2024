<?php
session_start();
include '../conn.php';
 if (!isset($_SESSION['user'])) {
    header("location:../login.php");
 }
 $id = $_GET['user_id'];
 $user=$conn->query("SELECT * FROM users ");
 if (mysqli_num_rows($user)>0){
    while ($row=mysqli_fetch_assoc($user)) {
        $username=$row['username'];
        echo "User".$username;
    }}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/user.jpg" type="image/x-icon">
    <title>Dashboard</title>
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

.me-2 {
    margin-right: 0.5rem;
}

/* Navbar */
nav {
    position: fixed;
    top: -8px;
    width: 100%;
    background-color: #07ffb7;
    z-index: 1000;
}

.nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    /* padding: 0.5rem 1rem; */
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

.nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
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
    align-items: center;
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
    text-align: center;
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

</style>
<body>
    <?php include "nav.php"; ?>
    <div class="row m-4">
        <div class="card ">
         <div class="card-header"><br><br>
      <center > <i class="fa-solid  fa-clock-rotate-left"></i><b>Some of our products</b> </center> 
    </div>
    <div class="card-body">
      <div class="table table-resplonsive table-sm w-80">
                <table class="table border table-stripped table-hover">
                   <thead class="table-dark text-white">
                    <th>Product Id </th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per Kg</th>
                    <th>Total price</th>
                   </thead> 
                   <tbody>
                <?php 
                $select=$conn->query("SELECT * FROM products  LIMIT 5");
                 if (mysqli_num_rows($select)>0){
                    while ($row=mysqli_fetch_assoc($select)) {
                        $p_id=$row['ProductId'];
                        $Pname=$row['ProductName'];
                        $price=$row['PricePerKg'];
                        $total=$row['Total_price'];
                        $quantity=$row['quantity'];
                        echo " <tr>
                        <td>$p_id</td>
                        <td>$Pname</td>
                        <td>$quantity</td>
                        <td>$price</td>
                        <td>$total</td>
                    </tr>";
                    } 
                 }
                 else {
                    echo "<td colspan='3'><center> No products Found</center></td>";
                 }

                ?>
                   
                   </tbody> 
                </table>
            </div>
        <center><a href="products.php" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-right"></i> View all</a></center>
    </div>
  </div>
            
        </div>
      </div>  
    </div>
    <?php include "footer.php"?>
</body>
</html>