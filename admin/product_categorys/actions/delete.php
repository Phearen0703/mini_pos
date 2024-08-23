<?php

include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");
if(isset($_GET["category_id"])){
    $category_id = $_GET['category_id'];


    $category = $conn->query("SELECT * FROM product_categories WHERE id = '$category_id'");
    $category = $category->fetch_object();

    //check if product is belong to this cat

    $check = $conn->query("SELECT COUNT(*) as total FROM products WHERE product_category_id = '$category_id'")->fetch_object()->total;

    if($check>0){
        $_SESSION['message'] = [
            'status'=> 'warning',
            'sms'=> 'Can not delete. Category is use.'
        ];
        header('Location:'. $burl .'/admin/product_categorys/index.php');
        exit();

    }
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