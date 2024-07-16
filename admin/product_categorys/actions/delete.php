<?php

include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");
if(isset($_GET["category_id"])){
    $category_id = $_GET['category_id'];


    $category = $conn->query("SELECT * FROM product_categories WHERE id = '$category_id'");
    $category = $category->fetch_object();
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $category->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $category->photo);
    }
   


    $conn->query("DELETE FROM product_categories WHERE `product_categories`.`id` = '$category_id'");

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
header('Location:'. $burl .'/admin/product_categorys/index.php');
?>