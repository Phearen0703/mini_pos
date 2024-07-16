<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/mini_pos/config.php");

if (isset($_POST['name']) && isset($_POST['username'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $oldpassword = $_POST['old_password'];
    $newpassword = $_POST['new_password'];
    $photo = $_FILES['photo'];
    $user_id = $_POST['id'];

    if (!$name) {
        $_SESSION['message'] = [
            'status' => 'error',
            'sms' => 'Validation Error'
        ];

    } else {

        $path = '';
        $user = $conn->query("SELECT * FROM users WHERE id = '$user_id'")->fetch_object();

            if($photo['size']>0){
            $path = "/mini_pos/admin/assets/images/users/" . time() . $photo['name'];
            move_uploaded_file($photo['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . $path);
    
    
            $photo = $user->photo;
            
    
            if(file_exists($_SERVER['DOCUMENT_ROOT'] . $photo)){
                unlink($_SERVER['DOCUMENT_ROOT'] . $photo);
            }
           
        }else{
            $path = $user->photo;
           
        }

        if($oldpassword){
            if($user->password != $oldpassword){
                $_SESSION['message'] = [
                    'status' => 'error',
                    'sms' => 'Old Password is incorrect'
                ];
            }
        }
        $password = $user->password;
        if($oldpassword){
            $password = $newpassword;
        }
        $conn->query("UPDATE users SET name='$name',photo='$path', username = '$username', password = '$password' WHERE id ='$user_id'");

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
header('Location:' . $burl . '/admin/users/index.php');

?>