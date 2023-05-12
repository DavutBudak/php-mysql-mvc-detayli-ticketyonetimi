
<?php
// UYE GIRISI yapılmışsa  SAYFASINA YONLENDIR

include "admin_init.php";
if ($_SESSION["admin_login"]) {
    header("Location:index.php");
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Admin Giriş</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Template style -->
<link rel="stylesheet" href="../assets/dist/css/style.css">
<link rel="stylesheet" href="../assets/dist/et-line-font/et-line-font.css">
<link rel="stylesheet" href="../assets/dist/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="../assets/dist/weather/weather-icons.min.css">
<link type="text/css" rel="stylesheet" href="../assets/dist/weather/weather-icons-wind.min.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="body-bg-color">
    <center>




<div class="wrapper">
  <div class="form-body">
    <form action="" class="col-form" method="POST" >
    <div class="col-logo"><a href="index.php"><img alt="" src="../assets/dist/img/yeni.logo.png"></a></div>
      <header>Admin Paneli</header>
      <fieldset>
          <?php
             if ($_POST) {
                 $admin_kullaniciadi = trim($_POST["admin_kullaniciadi"]);
                 $admin_sifre = trim($_POST["admin_sifre"]);
                 if (!$admin_kullaniciadi || !$admin_sifre) {
                    echo '<p>Lütfen kullanıcı adı ve sifre alanını doldurunuz.</p>';
                } else {
                    $admin_uye_varmi = $db->prepare("SELECT * FROM admin_bilgileri WHERE BINARY admin_kadi = ? AND BINARY  admin_sifre = ?");
                    $admin_uye_varmi->execute(array($admin_kullaniciadi, $admin_sifre));
                    if ($admin_uye_varmi->rowCount() > 0) {
                        $admin_uye = $admin_uye_varmi->fetch(PDO::FETCH_OBJ);
                        $_SESSION["admin_login"] = true;
                        $_SESSION["admin_uye"] = $admin_uye->admin_kadi;
                        $_SESSION["admin_id"] = $admin_uye->admin_id;
    
                        header("Refresh: 0; url=index.php");
                       
                    } else {
                        echo '<p>Lütfen kullanıcı adı ve sifrenizi doğru giriniz.</p>';
                    }
                }
            }
          
          ?>
        
        <section>
          <div class="form-group has-feedback">
            <label class="control-label">Kullanıcı Adı</label>
            <input class="form-control" placeholder="Kullanıcı Adı" name="admin_kullaniciadi" type="text">
            <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span> </div>
        </section>

        <section>
          <div class="form-group has-feedback">
            <label class="control-label">Parola</label>
            <input class="form-control" placeholder="Parola" name="admin_sifre" type="password">
            <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span> </div>
        </section>
      </fieldset>
      <footer class="text-right">
        <button type="submit" class="btn btn-info pull-right">Giriş Yap</button>
        </footer>
    </form>
  </div>
</div>
<!-- wrapper --> 

<!-- jQuery --> 
<script src="../assets/dist/js/jquery.min.js"></script> 
<script src="../assets/bootstrap/js/bootstrap.min.js"></script> 
<script src="../assets/dist/js/ovio.js"></script>
</body>
</html>