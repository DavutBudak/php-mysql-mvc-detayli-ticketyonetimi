<?php
   require_once ('admin_init.php'); 
   if(!$_SESSION["admin_login"]){
      header("Location:admin_giris.php");
   }else{
      include 'pages_admin/headfooter/header.php';
      include 'admin_get.php';
      include 'pages_admin/headfooter/footer.php';
   }
  
?>