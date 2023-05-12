
<?php
// UYE GIRISI yapılmışsa indexe SAYFASINA YONLENDIR
include "init.php";
if ($_SESSION["login"]) {
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
<title>Ovio -  Bootstrap Based Responsive Dashboard &amp; Admin Template</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Template style -->
<link rel="stylesheet" href="assets/dist/css/style.css">
<link rel="stylesheet" href="assets/pages/et-line-font/et-line-font.css">
<link rel="stylesheet" href="assets/pages/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="assets/dist/weather/weather-icons.min.css">
<link type="text/css" rel="stylesheet" href="assets/dist/weather/weather-icons-wind.min.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="body-bg-color">
<center>
<?php
if (isset($_POST["uye_kadi"])) {

   $uye_kadi = trim($_POST["uye_kadi"]);
   $uye_sifre = trim($_POST["uye_sifre"]);
   $uye_eposta = trim($_POST["uye_eposta"]);
   $onay = trim($_POST["onay"] ? 1 : 0);

   $uye_kadi = $_POST['uye_kadi'];
   
   $uye_kadi = str_replace(" ","",$uye_kadi);

   $uye_sifre = $_POST['uye_sifre'];
   
   $uye_sifre = str_replace(" ","",$uye_sifre);


   
    if (empty($uye_kadi) || empty($uye_sifre) || empty($uye_eposta)) {
      echo '
       <div class="alert alert-danger" role="alert">
       Yıldızlı alanları lütfen boş bırakmayınız.
      </div>';
    } else {
       if ($onay != 1) {
        echo '
        <div class="alert alert-danger" role="alert">
        Üyelik kurallarını kabul etmeniz gerekiyor.
        </div>';
       } else {


         $ayni_uye_varmi_kadi = $db -> prepare("SELECT * FROM uye_bilgileri WHERE BINARY uye_kadi = ?");
         $ayni_uye_varmi_kadi -> execute(array($uye_kadi));


        


         $ayni_uye_varmi_eposta = $db -> prepare("SELECT * FROM uye_bilgileri WHERE BINARY uye_eposta = ?");
         $ayni_uye_varmi_eposta -> execute(array($uye_eposta));
          if($ayni_uye_varmi_kadi -> rowCount() || $ayni_uye_varmi_eposta -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
            Bu kullanıcı Adı Veya E-posta Daha Önce Alınmış. Lütfen Farklı Bilgiler İle Devam Ediniz.
            </div>';
           }    
         
            
          else{
// BURADA YENİ BİR KULLANICI KAYIT OLUŞTURDU YANİ UYE_İD , UYE_KADİ VB EKLENDİ AŞŞAĞIDA BU EKLENEN KULLANICININ BİLGİLERİNİ ÇEKİP ÜYENİN KİMLİK-İKAMETGAH-EHLİYET DOSYASINI DOLDURACAĞIZ
            
             $uye_ekle = $db->prepare("INSERT INTO uye_bilgileri (uye_kadi, uye_sifre, uye_eposta) VALUES (?,?,?)");
             $uye_ekle -> execute(array($uye_kadi, $uye_sifre, $uye_eposta));

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



// KAYIT OLUŞTURULDUKTAN HEMEN SONRA KAYDOLAN KULLANICI ADI NI ALIP AŞŞAGIDA DA UYE_İD SİNİ ALMAK İÇİN KAYDOLAN KULLANICIYI ÇAĞIRDIM
             $uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_kadi = ?");
             $uye_getir->execute(array($uye_kadi));
             if ($uye_getir) {
               $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
             }              
// ----------------------------------------------------------------------------------------------------------------------------------




// ÜYENİN KİMLİK-İKAMETGAH-EHLİYET DOSYASININ DOLMASI İÇİN
   $uye_id_ekle = $uye->uye_id;
   $uye_dosya_ekle = "demo123.png";
   $resim_tarih_ekle = date("Y-m-d H:i:s");
// --------------------------------------------------------------




// KAYIT OLUŞTURULDUKTAN SONRA KULLANICININ KAYIT OLDUĞU KULLANICI ADI İLE ALDIĞIM UYE_İD' Sİ İLE ÜYENİN KİMLİK-İKAMETGAH-EHLİYET DOSYASININ DOLDURDUM

             $kimlik_ekle = $db->prepare("INSERT INTO uye_kimlik_dosyalari (uye_id, uye_kimlik, resim_tarih) VALUES (?,?,?)");
             $kimlik_ekle-> execute(array($uye_id_ekle, $uye_dosya_ekle, $resim_tarih_ekle));

             $ehliyet_ekle = $db->prepare("INSERT INTO uye_ehliyet_dosyalari (uye_id, uye_ehliyet, resim_tarih) VALUES (?,?,?)");
             $ehliyet_ekle-> execute(array($uye_id_ekle, $uye_dosya_ekle, $resim_tarih_ekle));

             $ikametgah_ekle = $db->prepare("INSERT INTO uye_ikametgah_dosyalari (uye_id, uye_ikametgah, resim_tarih) VALUES (?,?,?)");
             $ikametgah_ekle-> execute(array($uye_id_ekle, $uye_dosya_ekle, $resim_tarih_ekle));
// ----------------------------------------------------------------------------------------------------------------------------------------------------


             if ($uye_ekle || $kimlik_ekle  || $ehliyet_ekle  || $ikametgah_ekle){
            
               echo '
               <div class="alert alert-success" role="alert">
               Kayıt işlemi tamamlandı. Giriş sayfasına yönlendiriliyorsunuz...
               </div>';
				header("Refresh: 2; url=giris.php"); 
				 
             }else{
               echo '
               <div class="alert alert-danger" role="alert">
               Üye kaydı başarısız. Bir sorun oluştu.
               </div>';
              }
          }
       }
    }
}
?>   



<div class="wrapper">
  <div class="form-body">
    <form action="" class="col-form" method="post">
    <div class="col-logo"><a href="index.php"><img alt="" src="assets/dist/img/yeni.logo.png"></a></div>
      <header>Kayıt</header>
      <fieldset>
        <section>
          <div class="form-group has-feedback">
            <label class="control-label">Kullanıcı Adı</label>
            <input  type="text"   pattern="[a-zA-Z0-9]+" minlength="8"  class="form-control" placeholder="Kullanıcı adınızı giriniz" maxlength="50" name="uye_kadi"> 
            <span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>
        </section>
        <section>
          <div class="form-group has-feedback">
            <label class="control-label">E-mail</label>
            <input type="email" class="form-control"  maxlength="50"  placeholder="E-posta adresinizi giriniz" name="uye_eposta">            <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span> </div>
        </section>
        <section>
          <div class="form-group has-feedback">
            <label class="control-label">Şifre</label>
            <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8"  class="form-control" placeholder="Şifrenizi giriniz" maxlength="20" name="uye_sifre">            <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span> </div>
        </section>
        <section>
        <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="onay">
                    <label class="form-check-label">Üyelik kurallarını kabul ediyorum (*)</label>
                </div>
        </section>
      </fieldset>
      <footer class="text-right">
        <button type="submit" class="btn btn-info pull-right">Kayıt Ol</button>
        <a href="giris.php" class="button button-secondary">Giriş Yap</a> </footer>
    </form>
  </div>
</div>
</center>
<!-- wrapper --> 

<!-- jQuery --> 
<script src="../dist/js/jquery.min.js"></script> 
<script src="../bootstrap/js/bootstrap.min.js"></script> 
<script src="../dist/js/ovio.js"></script>
</body>
</html>