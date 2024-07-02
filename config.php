<?php

    session_start();

    $servername = "localhost";;
    $username = "root";
    $password = "";
    $dbname = "mini_pos";
    $conn = new mysqli($servername, $username, $password, $dbname);
?>