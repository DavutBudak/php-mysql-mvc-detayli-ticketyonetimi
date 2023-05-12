<?php
   require_once ('init.php'); 
   if(!$_SESSION["login"]){
      header("Location:giris.php");
   }else{
      include 'pages/headfooter/header.php';
      include 'get.php';
      include 'pages/headfooter/footer.php';
   }
  
?>