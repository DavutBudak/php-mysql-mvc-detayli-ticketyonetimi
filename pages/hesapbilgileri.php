<?php
$id = $_SESSION["id"];
$uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
$uye_getir->execute(array($id));
if ($uye_getir) {
    $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Hesap Ayarları</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
        <li class="active"><a href=""><i class="fa fa-files-o"></i> Giriş Bilgileri</a></li>
      </ol>
    </section>
    <?php


            if (isset($_POST['kaydet'])) {
                $uye_sifre = trim($_POST["uye_sifre"]);
                $uye_sifre_onay = trim($_POST["uye_sifre_onay"]);



               



                if (empty($uye_sifre) || empty($uye_sifre_onay)   ) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
                } 

            

                if($uye_sifre !== $uye_sifre_onay) {

                    echo 'Yeni Girilen Şifreler Aynı Değil';
                }
                /* else {
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
                  */
                    else {
                        $uye_guncelle = $db->prepare("UPDATE uye_bilgileri SET uye_sifre = ? WHERE uye_id = ?");
                        $uye_guncelle->execute(array($uye_sifre, $id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. otomatik olarak çıkış yapacaksınız
                           </div>';

                           header("location: cikis.php");

                   
                           
                                                   }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Üye güncelleme başarısız. Bir sorun oluştu.
                           </div>';
                        }
                    }
                }
            // }
?>
<style>
  form {
   max-width: 450px;
   margin: auto;
}

</style>


    <!-- Main content -->
    <section class="content container-fluid">
      <div class="row">
        <div class="col-lg-8">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Giriş Bilgileri</h4>
              <p class="text-center m-top-2">Giriş Bilgilerini Bu Ekrandan Güncelleyebilirsiniz</p>
            </div>
            <br><br>
            <form method="post" action="">
            

            <div class="row">
             

            <div class="form-group"  style="text-align: center;">
                    <label>Kullanıcı Adı: (*)</label>
                    <input disabled style="text-align: center;" type="text" class="form-control" placeholder="Kullanıcı adı giriniz"  maxlength="50" pattern="[a-zA-Z0-9-ğçşüöı-ĞÇŞÜÖİ]+" minlength="8" name="uye_kadi"
                           value="<?php echo $uye->uye_kadi; ?>">
                </div>
<br>

            </div>

            
            <div class="row">
             

            <div class="form-group"  style="text-align: center;">
                    <label>E-mail: (*)</label>
                    <input disabled type="text"  style="text-align: center;" type="email" class="form-control" placeholder="E-posta adresi giriniz"  maxlength="50"   name="uye_eposta"
                           value="<?php echo $uye->uye_eposta; ?>">
                </div>

<br>
            </div>
            <div >
            <h5 style="text-align:center;"> Şifre Değiştirmek İçin İki Alanada Yeni Şifrenizi Giriniz</h5>
            </div>
            <br>
            <div class="row">


  
            <div class="form-group" style="text-align: center;">
                    <label> Yeni Şifre: (*)</label>
                    <input  style="text-align: center;" type="password" class="form-control" placeholder="Yeni Şifrenizi giriniz" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" maxlength="20" name="uye_sifre">                           

                </div>

                <div class="form-group" style="text-align: center;">
                    <label>Yeni Şifre Onay: (*)</label>
                    <input  style="text-align: center;" type="password" class="form-control" placeholder="Yeni Şifrenizi giriniz" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" maxlength="20" name="uye_sifre_onay">                           

                </div>


                <div style="text-align: center;">
                <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
                </div>
          </form>


            </div>
           
          </div>
        </div>
        <div class="col-lg-4">
          <div class="chart-box">
            <h4 class="m-bot-2" style="text-align:center;">Bilgilendirme</h4>
            <hr >
            <p>Lorem ipsum dolor sit amet,Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet, Lorem ipsum dolor sit amet, consectetur consectetur Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur adip iscing elit. Nullam sagittis mattis arcu. Suspen disse potenti. Sed lectus est, commodo eu pre tium eu, pulvinar porttitor <code>feugiat</code>. Aliquam efficitur feugiat accumsan. Nulla hendrerit cursus nisi nec mattis. Nullam ac orci accumsan, bibendum justo eu, blandit sem.</p>
            <p>Sed lectus est, commodo eu pre tium eulvinar porttitor <code>feugiat</code>. Aliquam efficitur feugiat accumsan. Nulla hendrerit cursus nisi nec mattis. Nullam ac orci accumsan, bibendum justo eu, commodo eu pre tium eu, pulvinar porttitor blanditass</p>
           
          </div>
        </div>
      </div>

      
    
  