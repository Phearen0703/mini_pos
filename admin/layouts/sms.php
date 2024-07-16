<?php 
if (isset($_SESSION['message'])){
        if($_SESSION['message']['status'] == 'success'){
            echo "<div class='alert alert-success my-2'>" . $_SESSION['message']['sms'] . "</div>";
        }elseif($_SESSION["message"]["status"] == "error"){
            echo "<div class='alert alert-danger my-2'>" . $_SESSION['message']['sms'] . "</div>";
        }elseif($_SESSION["message"]["status"] == "warning"){
            echo "<div class='alert alert-warning my-2'>" . $_SESSION['message']['sms'] . "</div>";
        }else{
            
        }

        unset($_SESSION["message"]);
}

?>