<?php 
session_start();
  ob_start();

    /* Veritabanı Baglantı Bilgileri */
   $hostname = "localhost";
    $username = "kullaniciadi";
    $pass = "Pasword";
    $database = "dbname";

    /* MySQL Bağlantısı */
    try {
       $db = new PDO("mysql:host=localhost;"  . "dbname=dbname;" .  " charset=utf8", "kullaniciadi", "Pasword");
    } catch (PDOException $error) {
        print $error->getMessage();
        exit();
    }
    
    error_reporting(E_ALL);
    ini_set("display_errors", 0);
    