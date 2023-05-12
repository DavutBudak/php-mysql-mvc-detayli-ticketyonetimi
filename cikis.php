
<?php
// UYE GIRISI YAPILMAMISSA GIRIS SAYFASINA YONLENDIR
include "init.php";

?>
<?php

unset($_SESSION['login']);
header("Refresh:0; url=giris.php");
?>
