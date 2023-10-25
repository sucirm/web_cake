<?php 
$conn = mysqli_connect('localhost', 'root', '', 'db_mycake');
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM transaction_detail_tbl WHERE transaction_detail_id = $id");
header("location: cart.php");


 ?>