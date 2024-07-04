<?php
include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

if(isset($_POST['name']) && isset($_FILES['photo'])){

}else{

    $_SESSION['message']=[
        'status'=>'error',
        'sms'=>'Validation Error'
    ];

    header('Location:'. $burl .'/admin/customers/create.php');
}

?>