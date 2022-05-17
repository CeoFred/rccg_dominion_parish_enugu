<?php session_start();
if(isset($_SESSION['user_authenticated'])){
    session_destroy();

 return header("Location: /?logout=true");
 exit();
}
 else {
 return header("Location: /?logout=false");
 exit();

 }