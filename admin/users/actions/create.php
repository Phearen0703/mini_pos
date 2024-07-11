<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

if(isset($_POST['name']) && isset($_FILES['photo'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $photo = $_FILES['photo'];

    if(!$name || !$photo){
        $_SESSION['message']=[
            'status'=>'error',
            'sms'=>'Validation Error'
        ];
    
    }else{
       
       $path = "/mini_pos/admin/assets/images/users/" . time() . $photo['name'];
       move_uploaded_file( $photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);

       $conn->query("INSERT INTO users(name,username,password, photo) VALUE('$name','$username','$password','$path')");

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
header('Location:'. $burl .'/admin/users/create.php');

?>