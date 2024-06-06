<?php
include_once "../conn.php";

$sql = mysqli_query($conn, "
    SELECT products.ProductId, products.ProductName, products.PricePerKg, 
           stockin.quantity AS p_in_quantity, stockout.quantity AS p_out_quantity, 
           stockin.date AS p_in_date, stockout.date AS p_out_date 
    FROM products
    LEFT JOIN stockin ON products.ProductId = stockin.ProductId
    LEFT JOIN stockout ON products.ProductId = stockout.ProductId
");

$form = '';

if ($sql) {
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql)) {
            $a++;
            $form .= '<tr>
                        <td>' . $a . '</td>
                        <td>' . $fetch['ProductName'] . '</td>
                        <td>' . $fetch['PricePerKg'] . '</td>
                        <td>' . $fetch['p_in_quantity'] . '</td>
                        <td>' . $fetch['p_out_quantity'] . '</td>
                        <td>' . $fetch['p_in_date'] . '</td>
                        <td>' . $fetch['p_out_date'] . '</td>
                    </tr>';
        }
    } else {
        $form .= '<tr><td colspan="7">No records found!</td></tr>';
    }
} else {
    $form .= '<tr><td colspan="7">Error fetching data!</td></tr>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../images/user.jpg" type="image/x-icon">
    <title>Product Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            align-items: center;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .print-btn {
            display: flex;
            width: 100px;
            margin: 0 auto;
            padding: 10px;
            background-color: #07ffb7;
            border: none;
            /* color: #fff; */
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #07ffb7;
        }

        thead {
            background-color: #515559;
            color: #fff;
        }

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

        .card-body {
            padding: 120px;
        }
    </style>
</head>

<body>
    <?php include "nav.php"; ?><br><br>
    <div class="col-sm-9 ms-3">
        <br><br><br>
        <div class="card ">
            <div class="card-header">
                <center> <i class="fa-solid  fa-clock-rotate-left"></i> Report</center>
           
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Price Per Kg</th>
                <th>Stock In Quantity</th>
                <th>Stock Out Quantity</th>
                <th>Stock In Date</th>
                <th>Stock Out Date</th>
            </tr>
        </thead>
        <?php echo $form; ?>
    </table>
    </div>
        </div>
    <hr>
    <button class="print-btn" onclick="printReport()">Print the Report</button>

    <script>
        function printReport() {
            window.print();
        }
    </script>
    <hr>
    <?php include "footer.php";?>
</body>

</html>