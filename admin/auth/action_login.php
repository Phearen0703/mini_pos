<?php 

    include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");

    if(isset($_POST['username']) && isset($_POST['password'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $conn ->query("SELECT username, password FROM users WHERE username = '$username' AND password = '$password'");

        if($user -> fetch_object()){
        
            $_SESSION['message']=[
                'status' => 'success',
                'sms' => 'Login Seccussfully',
            ];

            $_SESSION['login'] = true;
            header('Location:' . $burl . '/admin/index.php');
            exit();
        }
       
    }
    $_SESSION['message']=[
        'status' => 'error',
        'sms' => 'Wrong username or password',
    ];
    header('Location:' . $burl . '/admin/auth/login.php');
?>

