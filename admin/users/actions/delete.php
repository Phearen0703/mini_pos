<?php

include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");
if(isset($_GET["user_id"])){
    $user_id = $_GET['user_id'];


    $user = $conn->query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $user->fetch_object();
    if(file_exists($_SERVER['DOCUMENT_ROOT'] . $user->photo)){
        unlink($_SERVER['DOCUMENT_ROOT'] . $user->photo);
    }
   


    $conn->query("DELETE FROM users WHERE `users`.`id` = '$user_id'");

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
header('Location:'. $burl .'/admin/users/index.php');
?>