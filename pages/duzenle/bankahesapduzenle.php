<?php
    $id = intval($_GET["id"]);
    $bankahesabi = $db->prepare("SELECT * FROM uye_banka_hesaplari WHERE idyeni = ? AND uye_id=?");
    $bankahesabi->execute(array($id,$_SESSION['id']));
    if ($bankahesabi) {
        $uye = $bankahesabi->fetch(PDO::FETCH_OBJ);
    }
?>

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Banka Hesapları</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Banka Hesapları</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Banka Hesabını Düzenle</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Banka Hesabını Düzenle</h4>
              <p class="text-center m-top-2">Banka Hesaplarınızı Bu Ekrandan Güncelleyebilirsiniz</p>
            </div>
            <br><br>
        

<?php
            if( $uye ){ 
                        if ($_POST) {

                $uye_banka_adi = trim($_POST["uye_banka_adi"]);
                $uye_sube_adi = trim($_POST["uye_sube_adi"]);
                $uye_hesap_no = trim($_POST["uye_hesap_no"]);
                $uye_banka_doviz_cinsi = trim($_POST["uye_banka_doviz_cinsi"]);
                $uye_swift_kodu = trim($_POST["uye_swift_kodu"]);

                // SWİFT KODU BÜYÜK GELSİN DİYE
                $uye_swift_kodu = mb_strtoupper($_POST["uye_swift_kodu"],"UTF-8");
                // SWİFT KODU BÜYÜK GELSİN DİYE



                // İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM
                $iban = trim($_POST["uye_iban"]);
                $iban1=substr($iban,0,15); // 0dan 15 e  bolumu alir              
                $iban2=substr($iban,15); // 15.karakterden sonraki tum bolumu alir                
                $uye_iban =  $iban1 . " " . $iban2;
                // İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM




                if (empty($uye_banka_adi) || empty($uye_sube_adi) || empty($uye_hesap_no) || empty($uye_iban)|| empty($uye_swift_kodu) ||  empty($uye_banka_doviz_cinsi)) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
                }
                else {
                        $uye_guncelle = $db->prepare("UPDATE uye_banka_hesaplari SET uye_banka_adi = ?, uye_sube_adi = ?, uye_hesap_no = ?, uye_iban = ?, uye_swift_kodu = ?, uye_banka_doviz_cinsi = ? WHERE idyeni = ? AND uye_id = ? ");
                        $uye_guncelle->execute(array($uye_banka_adi, $uye_sube_adi, $uye_hesap_no, $uye_iban,$uye_swift_kodu, $uye_banka_doviz_cinsi, $id, $_SESSION["id"]
                    ));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                            header("Location:index.php?sayfa=bankahesaplari");
                        }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Banka Bilgisi güncelleme başarısız. Bir sorun oluştu.
                           </div>';
                        }
                    }
                 }               

                 ?>
                
             
                 
            <form method="post" action="">
   
            <div class="row">
                  <div class="col-md-6 form-group">
                    <label> <b>  Banka Adı</b></label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Banka Adı Giriniz"  name="uye_banka_adi" maxlength="50" minlength="3" value="<?php echo $uye->uye_banka_adi;?>">
                  </div>
                  <div class="col-md-6 form-group">
                    <label> <b> Banka Şubesi</b> </label>
                    <input class="form-control" id="placeholderInput" placeholder="Şube Adı Giriniz"  name="uye_sube_adi" type="text"  maxlength="50" minlength="3" value="<?php echo $uye->uye_sube_adi;?>">
                  </div>
                  <div class="col-md-6 form-group">
                    <label> <b> Swift Kodu</b> </label>
                    <input style="text-transform:uppercase" class="form-control" id="placeholderInput" placeholder="Şube Adı Giriniz"  name="uye_swift_kodu" type="text"  minlength="6" maxlength="11"  value="<?php echo $uye->uye_swift_kodu;?>">
                  </div>
                  <div class="col-md-6 form-group" >
                    <label> <b> Şube & Hesap No</b> </label>
                    <input class="form-control" id="placeholderInput" placeholder="Hesap No Giriniz"  name="uye_hesap_no" type="text" minlength="15" maxlength="16" value="<?php echo $uye->uye_hesap_no;?>">
                  </div>
                  <div class="col-md-6 form-group" >
                 <p style="text-align: center;">  <label> <b>  İban No</b> </label> </p>  
                    <input class="form-control" id="placeholderInput" placeholder="İban No Giriniz"  name="uye_iban" type="text"  minlength="26" maxlength="28" value="<?php echo $uye->uye_iban;?>">
                  </div>

                  <div class="col-md-6 form-group" >

 <p><label><i class="fas fa-user-friends"></i> <b> Banka Hesabı Döviz Cinsi:</b></label> </p> 

<select name="uye_banka_doviz_cinsi" class="form-group form-control" style="text-align: center;">
          <option  value="TRY">TRY</option>
          <option value="USD">USD</option>
          <option value="EUR">EUR</option>
        </select>

</div>
                      <button style="text-align: center;" type="submit" class="btn btn-primary col-md-12">Banka Hesabını Kaydet</button>

                </div>

          </form>

            </div>
           
          </div>
        </div>
         
      </div>
       
    </section> 
  </div>
  <?php } else { 
                                header("Location:pages/duzenle/hata.php");

   } ?> 
          
          <?php
	









 