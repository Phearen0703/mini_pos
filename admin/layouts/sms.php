<?php 
if (isset($_SESSION['message'])){
        if($_SESSION['message']['status'] == 'success'){
             echo"<div class='alert alert-success my-2>". $_SESSION['message']['sms']."</div>";
        }elseif($_SESSION["message"]["status"] == "error"){
            echo"<div class='alert alert-danger my-2>". $_SESSION['message']['sms']."</div>";
        }else{
            
        }
}

?>