<?php
    $id = intval($_GET["id"]);
    $bankahesabi = $db->prepare("SELECT * FROM uye_banka_hesaplari WHERE idyeni = ?");
    $bankahesabi->execute(array($id));
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
                        if ($_POST) {

                $uye_banka_adi = trim($_POST["uye_banka_adi"]);
                $uye_sube_adi = trim($_POST["uye_sube_adi"]);
                $uye_hesap_no = trim($_POST["uye_hesap_no"]);
                $uye_banka_doviz_cinsi = trim($_POST["uye_banka_doviz_cinsi"]);

                
// İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM
$iban = trim($_POST["uye_iban"]);   
$iban1=substr($iban,0,15); // 0dan 15 e  bolumu alir              
$iban2=substr($iban,15); // 15.karakterden sonraki tum bolumu alir                
$uye_iban =  $iban1 . " " . $iban2;
// İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM



              if (empty($uye_banka_adi) || empty($uye_sube_adi) || empty($uye_hesap_no) || empty($uye_iban)  || empty($uye_banka_doviz_cinsi)) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
                }
                else {
                        $uye_guncelle = $db->prepare("UPDATE uye_banka_hesaplari SET uye_banka_adi = ?, uye_sube_adi = ?, uye_hesap_no = ?, uye_iban = ?, uye_banka_doviz_cinsi = ? WHERE idyeni = ? ");
                        $uye_guncelle->execute(array($uye_banka_adi, $uye_sube_adi, $uye_hesap_no, $uye_iban, $uye_banka_doviz_cinsi, $id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                            header("Location:index.php?adminsayfa=adminbankahesaplari&page=1");
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
                    <label>Banka Adı</label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Banka Adı Giriniz"  name="uye_banka_adi" value="<?php echo $uye->uye_banka_adi;?>">
                  </div>
                  <div class="col-md-6 form-group">
                    <label>Banka Şubesi</label>
                    <input class="form-control" id="placeholderInput" placeholder="Şube Adı Giriniz"  name="uye_sube_adi" type="text" value="<?php echo $uye->uye_sube_adi;?>">
                  </div>
                 
                  <div class="col-md-6 form-group" >
                    <label>Hesap No</label>
                    <input class="form-control" id="placeholderInput" placeholder="Hesap No Giriniz"  name="uye_hesap_no" type="text" value="<?php echo $uye->uye_hesap_no;?>">
                  </div>
                 
                  <div class="col-md-6 form-group" >
                  <label> Döviz Cinsi</label>

                  <select name="uye_banka_doviz_cinsi" class="form-group form-control" style="text-align: center;">
                  <option selected value=" <?php echo $uye->uye_banka_doviz_cinsi;?> "> <?php echo $uye->uye_banka_doviz_cinsi; ?> </option>
                          <option  value="TRY">TRY</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                        </select>
                  </div>

                  <div class="col-md-12 form-group" >
                   <p style="text-align: center;">   <label>İban No</label></p>
                    <input class="form-control" id="placeholderInput" placeholder="İban No Giriniz"  name="uye_iban" type="text" value="<?php echo $uye->uye_iban;?>">
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