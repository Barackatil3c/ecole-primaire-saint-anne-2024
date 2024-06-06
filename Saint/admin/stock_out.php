<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['user'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/user.jpg" type="image/x-icon">
    <title>Stock Out</title>
</head>
<style>
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
        margin-top: 60px;
        /* Adjusted for navbar height */
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
        text-align: center;
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
</style>

<body>
    <?php
    include "nav.php";
    ?>
    <br><br><br><br><br><br><br>
    <div class="col-sm-9 ms-3">
        <button class="btn m-1"><i class="fa-solid fa-bars " style="font-size:30px"></i></button>
        <div class="card ">
            <div class="card-header">
                <center> <i class="fa-solid  fa-clock-rotate-left"></i> Stock Out</center>
            </div>
            <div class="card-body">
                <div class="table table-resplonsive table-sm w-80">
                    <table class="table border table-stripped table-hover">
                        <thead class="table-dark text-white">
                            <th>Stock out Id </th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price per Kg</th>
                            <th>Total price</th>
                            <th>Date</th>
                        </thead>
                        <tbody>
                            <?php
                            $select = $conn->query("SELECT * FROM stockout");
                            if (mysqli_num_rows($select) > 0) {
                                while ($row = mysqli_fetch_assoc($select)) {
                                    $s_id = $row['StockOutId'];
                                    $p_id = $row['ProductId'];
                                    $quantity = $row['quantity'];
                                    $date = $row['date'];
                                    $select_product = $conn->query("SELECT * FROM products WHERE ProductId='$p_id'");
                                    foreach ($select_product as $row_product) {
                                        $Pname = $row_product["ProductName"];
                                        $Pprice = $row_product["PricePerKg"];
                                    }
                                    $total = $quantity * $Pprice;
                                    echo " <tr>
                        <td>$p_id</td>
                        <td>$Pname</td>
                        <td>$quantity Kg</td>
                        <td>$Pprice Rwf</td>
                        <td>$total Rwf</td>
                        <td>$date</td>
                    </tr>";
                                }
                            } else {
                                echo "<td colspan='3'><center> No stock out found</center></td>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
                <center><a href="add_stock_out.php" class="btn btn-warning btn-sm"><i class="fa-solid fa-plus"></i>New</a>
                    <button class="btn btn-dark btn-sm" onclick="download()"><i class="fa-solid fa-download"></i>Download</button>
                </center>
            </div>
        </div>

    </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.getElementById('content');
            html2pdf()
                .from(element)
                .save();
        }
    </script>
    <?php include "footer.php" ?>
</body>

</html>