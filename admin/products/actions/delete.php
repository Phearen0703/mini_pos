<?php

include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");
if(isset($_GET["product_id"])){
    $product_id = $_GET['product_id'];


    $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'");
    $product = $product->fetch_object();
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $product->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $product->photo);
    }
   


    $conn->query("DELETE FROM products WHERE `products`.`id` = '$product_id'");

    $_SESSION['message'] = [
        'status'=> 'success',
        'sms'=> 'Delete Successfully'
    ];
}else{
    $_SESSION['message'] = [
        'status'=> 'error',
        'sms'=> 'Delete Not Successfully'
    ];
}
header('Location:'. $burl .'/admin/products/index.php');
?>