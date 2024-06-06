<?php declare(strict_types=1); 
$servername="localhost";
$username= "root";
$password= "";
$dbname= "ecole";
$conn=new mysqli($servername, $username, $password, $dbname);
if(!$conn){
    die("Could not connect ". mysqli_error($conn));
}
?>