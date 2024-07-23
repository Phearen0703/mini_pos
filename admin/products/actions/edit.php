<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/mini_pos/config.php");

if (isset($_POST['name']) && isset($_FILES['photo'])) {

    $photo = $_FILES['photo'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $product_id = $_POST['id'];
    $product_category = $_POST['product_category'];

    if (!$name) {
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];

    } else {

        $path = '';
        $product = $conn->query("SELECT * FROM products WHERE id = '$product_id'")->fetch_object();

        if($photo['size']>0){
            $path = "/mini_pos/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);
    
    
            $photo = $product->photo;
        
            
    
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
           
        }else{
            $path = $product->photo;
        }

        
        $conn->query("UPDATE products SET name='$name',price='$price',product_category_id='$product_category',photo='$path' WHERE id ='$product_id'");

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
header('Location:' . $burl . '/admin/products/index.php');

?>