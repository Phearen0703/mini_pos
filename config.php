<?php

    session_start();

    $base_url = "http://localhost";
    $project_path = "/mini_pos";
    $burl = $base_url . $project_path;

    $servername = "localhost";;
    $username = "root";
    $password = "";
    $dbname = "mini_pos";

    // $_SESSION['login'] = (isset($_SESSION['login']) && $_SESSION['login'] == true) == true ? true :false;
    // $_SESSION['login'] = !isset($_SESSION['login']) ? false : !$_SESSION['login'];

    $_SESSION['login']=(isset($_SESSION['login']) && $_SESSION['login']==true) == true ? true : false;



    $conn = new mysqli($servername, $username, $password, $dbname);



?>