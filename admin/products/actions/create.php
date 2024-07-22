<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

if(isset($_POST['name']) && isset($_FILES['photo']) && isset($_POST['price']) && isset($_POST['product_category'])){

    $name = $_POST['name'];
    $product_category = $_POST['product_category'];
    $price = $_POST['price'];
    $photo = $_FILES['photo'];
    $created_at = date('Y-m-d H:i:s');
    $created_by = $_SESSION['auth'];


    if(!$name || !$photo || !$price || !$product_category){
        $_SESSION['message']=[
            'status'=>'error',
            'sms'=>'Validation Error'
        ];
    
    }else{
       
       $path = "/mini_pos/admin/assets/images/" . time() . $photo['name'];
       move_uploaded_file( $photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

       $conn->query("INSERT INTO products(product_category_id,name,price, photo, created_at, created_by) VALUE('$product_category','$name','$price','$path','$created_at','$created_by')");

       $_SESSION['message']=[
        'status'=>'success',
        'sms'=>'Insert Successfully'
    ];
    }

}else{

    $_SESSION['message']=[
        'status'=>'error',
        'sms'=>'Validation Error'
    ];

}
header('Location:'. $burl .'/admin/products/create.php');

?>