<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

if(isset($_POST['name']) && isset($_FILES['photo'])){

    $name = $_POST['name'];
    $photo = $_FILES['photo'];

    if(!$name || !$photo){
        $_SESSION['message']=[
            'status'=>'error',
            'sms'=>'Validation Error'
        ];
    
    }else{
       
       $path = "/mini_pos/admin/assets/images/" . time() . $photo['name'];
       move_uploaded_file( $photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

       $conn->query("INSERT INTO product_categories(name, photo) VALUE('$name','$path')");

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
header('Location:'. $burl .'/admin/product_categorys/create.php');

?>