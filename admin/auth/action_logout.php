<?php
     include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");


     $_SESSION['message']=[
          'status' => 'warning',
          'sms' => 'Logout Seccussfully',
      ];

     $_SESSION['login'] = false;
     $_SESSION['auth'] = 0;

     header('Location:' . $burl .'/admin/auth/login.php');
?>