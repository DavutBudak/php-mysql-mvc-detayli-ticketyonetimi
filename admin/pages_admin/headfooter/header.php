

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Ticket Yönetimi</title>
  

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
    <script src="https://kit.fontawesome.com/1d31c2c74b.js" crossorigin="anonymous"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous">
</script>
</head>
<body class="sidebar-mini">
<div class="wrapper"> 
<header class="main-header dark-bg"> 
    
    <!-- Logo --> 
    <a href="index.php" class="logo dark-bg"> 
    <!-- mini logo for sidebar mini 50x50 pixels --> 
    <span class="logo-mini"><img src="../assets//dist/img/yeni.logo.png" alt="Ovio"></span> 
    <!-- logo for regular state and mobile devices --> 
    <span class="logo-lg"><img src="../assets/dist/img/yeni.logo.png" alt="Ovio"></span> </a> 
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation"> 
      <!-- Sidebar toggle button--> 
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
      <div class="pull-left search-box">
        <form action="#" method="get" class="search-form">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> </button>
            </span></div>
        </form>
        <!-- search form --> </div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
           
          
          <!-- Tasks Menu --> 
          <!-- User Account Menu -->
          <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="../assets/dist/img/img1admin.png" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $_SESSION["admin_uye"]; ?></span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <div class="pull-left user-img"><img src="../assets/dist/img/img1admin.png" class="img-responsive" alt="User"></div>
                <p class="text-left"> <?php echo $_SESSION["admin_uye"]; ?></p>
              </li>
              <li><a href="index.php?adminsayfa=adminhesapayarlari&page=1"><i class="icon-gears"></i> Hesap Ayarları</a></li>
              <li><a href="cikis.php"><i class="fa fa-power-off"></i> Çıkış Yap</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar dark-bg">
    <section class="sidebar">
      <div class="user-panel black-bg">
        <div class="pull-left image"> <img src="../assets/dist/img/img1admin.png" class="img-circle" alt="User Image"> </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["admin_uye"]; ?></p>
          <a href="#"><i class="fa fa-circle"></i> Online</a> </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <br>
        <li class="treeview active"><a href="#"><i class="fa fa-dashboard"></i> <span>Menü</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          <li><a href="index.php"><i class="fa fa-angle-right"></i> Ana Sayfa</a></li>
          <li><a href="?adminsayfa=adminhesapayarlari&page=1"><i class="fa fa-angle-right"></i>Hesap Ayarları</a></li>
            <li><a href="?adminsayfa=adminbankahesaplari&page=1"><i class="fa fa-angle-right"></i> Banka Hesapları</a></li>
            <li><a href="?adminsayfa=adminbakiye&page=1"><i class="fa fa-angle-right"></i>Para Yatırma Talepleri</a></li>
            <li><a href="?adminsayfa=adminparacekme&page=1"><i class="fa fa-angle-right"></i>Para Çekme Talepleri</a></li>
            <li><a href="?adminsayfa=admindestek&page=1"><i class="fa fa-angle-right"></i>Destek</a></li>



            
          </ul>
        </li>
      </ul>
      <!-- sidebar-menu --> 
    </section>
  </aside>