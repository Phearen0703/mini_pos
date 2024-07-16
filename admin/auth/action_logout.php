<?php
     include($_SERVER['DOCUMENT_ROOT']."/mini_pos/config.php");


     $_SESSION['message']=[
          'status' => 'warning',
          'sms' => 'Logout Seccussfully',
      ];

     $_SESSION['login'] = false;

     header('Location:' . $burl .'/admin/auth/login.php');
?>