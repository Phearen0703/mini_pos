<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/mini_pos/config.php");

if (isset($_POST['name']) && isset($_FILES['photo'])) {

    $name = $_POST['name'];
    $photo = $_FILES['photo'];
    $customer_id = $_POST['id'];

    if (!$name) {
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];

    } else {

        $path = '';
        $customer = $conn->query("SELECT * FROM customers WHERE id = '$customer_id'")->fetch_object();

        if($photo['size']>0){
            $path = "/mini_pos/admin/assets/images/customers/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);
    
    
            $photo = $customer->photo;
        
            
    
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
           
        }else{
            $path = $customer->photo;
        }

        
        $conn->query("UPDATE customers SET name='$name',photo='$path' WHERE id ='$customer_id'");

        $_SESSION['message'] = [
            'status' => 'success',
            'sms' => 'Update Successfully'
        ];
      


    }
}else{
    $_SESSION['message'] = [
        'status' => 'error',
        'sms' => 'Validation Error'
    ];
}
header('Location:' . $burl . '/admin/customers/index.php');

?>