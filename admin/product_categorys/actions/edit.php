<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/mini_pos/config.php");

if (isset($_POST['name']) && isset($_FILES['photo'])) {

    $name = $_POST['name'];
    $photo = $_FILES['photo'];
    $category_id = $_POST['id'];

    if (!$name) {
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];

    } else {

        $path = '';
        $category = $conn->query("SELECT * FROM product_categories WHERE id = '$category_id'")->fetch_object();

        if($photo['size']>0){
            $path = "/mini_pos/admin/assets/images/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);
    
    
            $photo = $category->photo;
        
            
    
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
           
        }else{
            $path = $category->photo;
        }

        
        $conn->query("UPDATE product_categories SET name='$name',photo='$path' WHERE id ='$category_id'");

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
header('Location:' . $burl . '/admin/product_categorys/index.php');

?>