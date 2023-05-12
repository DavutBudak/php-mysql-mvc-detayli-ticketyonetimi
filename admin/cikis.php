
<?php
// UYE GIRISI YAPILMAMISSA GIRIS SAYFASINA YONLENDIR
include "admin_init.php";

?>
<?php

unset($_SESSION['admin_login']);
header("Refresh:0; url=admin_giris.php");
?>
