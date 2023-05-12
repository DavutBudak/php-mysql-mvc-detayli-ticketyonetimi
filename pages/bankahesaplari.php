
<?php

$uye_getir1 = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
$uye_getir1->execute(array($_SESSION['id']));
if ($uye_getir1) {
    $uye1 = $uye_getir1->fetch(PDO::FETCH_OBJ);
}
?>

<?php
    if($_GET["core"] == "sil"){
        $bankaid = $_GET["id"];
        $sil = $db->prepare("DELETE FROM uye_banka_hesaplari WHERE idyeni = ? AND uye_id = ? ");
        $sil->execute(array($bankaid,$_SESSION['id']));
        if ($sil) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:?sayfa=bankahesaplari&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>';
        }
    }
?>




<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Banka Hesapları</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><i class="fa fa-home"></i> Menü</li> 
        <li><a href=""><i class="fa fa-home"></i> Banka Hesapları</a></li> 
      </ol>
    </section>

    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
          <?php if ($uye1->meta_login !== NULL) {?>

            <div class="head-title">
              <h4 style="text-align: center;">Banka Hesaplarım</h4>
              <p class="text-center m-top-2">Banka Hesaplarınızı Bu Ekrandan Görüntüleyebilir Ve Güncelleyebilirsiniz</p>
            </div>
            <br><br>
            <?php  
          if ($_POST) {
            $uye_ad = $uye1->uye_ad;
            $uye_soyad = $uye1->uye_soyad;
              $uye_banka_adi = trim($_POST["uye_banka_adi"]);
              $uye_sube_adi = trim($_POST["uye_sube_adi"]);
              $uye_hesap_no = trim($_POST["uye_hesap_no"]);
              $uye_swift_kodu = trim($_POST["uye_swift_kodu"]);
              $uye_banka_doviz_cinsi = trim($_POST["uye_banka_doviz_cinsi"]);

              // SWİFT KODU BÜYÜK GELSİN DİYE
              $uye_swift_kodu = mb_strtoupper($_POST["uye_swift_kodu"],"UTF-8");
              // SWİFT KODU BÜYÜK GELSİN DİYE

// İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM
$iban = trim($_POST["uye_iban"]);
$iban1=substr($iban,0,15); // 0dan 15 e  bolumu alir              
$iban2=substr($iban,15); // 15.karakterden sonraki tum bolumu alir                
$uye_iban =  $iban1 . " " . $iban2;
// İBAN TABLODA DÜZGÜN GÖZÜKSÜN DİYE İBANIN ORTASINA BOŞLUK ATTIRCAM


              if (empty($uye_banka_adi) ||  empty($uye_sube_adi)  ||  empty($uye_hesap_no)  ||  empty($uye_iban)  ||  empty($uye_ad) ||  empty($uye_soyad)  ||  empty($uye_swift_kodu) ||  empty($uye_banka_doviz_cinsi) ) {
                  echo '
                     <div class="alert alert-danger" style="text-align:center;" role="alert">
                     * TÜM BİLGİLERİNİZİ EKSİKSİZ BİR ŞEKİLDE DOLDURUNUZ *
                          </div>';
              } else {
                $insert = $db->prepare("INSERT INTO uye_banka_hesaplari (uye_id, uye_ad, uye_soyad, uye_banka_adi, uye_sube_adi, uye_hesap_no,uye_iban, uye_swift_kodu, uye_banka_doviz_cinsi) VALUES (?,?,?,?,?,?,?,?,?)");
                $insert -> execute(array($_SESSION["id"], $uye_ad, $uye_soyad, $uye_banka_adi, $uye_sube_adi, $uye_hesap_no, $uye_iban, $uye_swift_kodu, $uye_banka_doviz_cinsi));
                      
                if ($insert){
                    echo '
                    <div class="alert alert-success" role="alert">
                    Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                    </div>';
                    header("Location:?sayfa=bankahesaplari&page=1");
                }else{
                    echo '
                    <div class="alert alert-danger" role="alert">
Kayıt İşlemi Başarısız. Profil Ayarlarından Bütün Bilgilerinizi Eksiksiz Bir Şekilde Doldurmalısınız. </div>';
                }
                  }
              }
          
          ?>


            <form method="post" action="">
   
            <div class="row">
                  <div class="col-md-6 form-group">
                    <label> <b> Banka Adı </b> </label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Banka Adı Giriniz"  name="uye_banka_adi" maxlength="50" minlength="3" >
                  </div>
                  <div class="col-md-6 form-group">
                    <label> <b> Banka Şubesi</b> </label>
                    <input class="form-control" id="placeholderInput" placeholder="Şube Adı Giriniz"  minlength="3" maxlength="50"  name="uye_sube_adi" type="text">
                  </div>


                  <div class="col-md-6 form-group">
                    <label> <b> Swift Kodu</b>  </label>
                    <input style="text-transform:uppercase" class="form-control" id="placeholderInput" placeholder="Swift Kodu Giriniz" minlength="6" maxlength="11"  name="uye_swift_kodu" type="text">
                  </div>
                  <div class="col-md-6 form-group">
                    <label> <b> Şube & Hesap No</b> </label>
                    <input class="form-control" id="placeholderInput" placeholder=" Şube & Hesap No Giriniz" minlength="15" maxlength="16"  name="uye_hesap_no" type="text">
                  </div>
                 
                  <div class="col-md-6 form-group" >

                 <label> <b>  İban No</b></label> 
                    <input class="form-control" placeholder="İban No Giriniz"  name="uye_iban" type="text" minlength="26" maxlength="28" value="TR">
                  </div>
                  <div class="col-md-6 form-group" >

                <label><i class="fas fa-user-friends"></i> <b> Banka Hesabı Döviz Cinsi:</b></label>

    <select name="uye_banka_doviz_cinsi" class="form-group form-control" style="text-align: center;">
                          <option selected value="TRY">TRY</option>
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
          <div class="chart-box">
            <h4 class="m-bot-2" style="text-align: center;">Kayıtlı Banka Hesapları</h4>              <hr>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Banka Adı</th>
                    <th scope="col">Şube Adı</th>
                    <th scope="col">Swift Kodu</th>
                    <th scope="col">Şube & Hesap No</th>
                    <th scope="col">Banka Döviz Cinsi</th>
                    <th scope="col">Iban No</th>
                    <th scope="col">Düzenle</th>

                </tr>
                </thead>
                <tbody>
                <?php


$limit = 5;
                $query = "SELECT count(*) FROM uye_banka_hesaplari WHERE uye_id =$_SESSION[id]";

                $s = $db->query($query);
                $total_results = $s->fetchColumn();
                $total_pages = ceil($total_results/$limit);
                
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else{
                    $page = $_GET['page'];
                }



                $starting_limit = ($page-1)*$limit;


                $uyeler = $db -> prepare("SELECT * FROM uye_banka_hesaplari WHERE  uye_id = ? ORDER BY idyeni DESC LIMIT $starting_limit,$limit");
                $uyeler->execute(array($_SESSION["id"]));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>
                        <td><?php echo $uye['uye_banka_adi'];?></td>
                        <td><?php echo $uye['uye_sube_adi'];?></td>
                        <td><?php echo $uye['uye_swift_kodu'];?></td>
                        <td><?php echo $uye['uye_hesap_no'];?></td>
                        <td><?php echo $uye['uye_banka_doviz_cinsi'];?></td>
                        <td><?php echo $uye['uye_iban'];?></td>
                        <td><a href="?sayfa=bankahesapduzenle&id=<?php echo $uye['idyeni']?>">[ Düzenle ]</a>
                          <a onclick="return confirm('Veri silinecek Onaylıyormusunuz')" href="?sayfa=bankahesaplari&core=sil&id=<?php echo $uye['idyeni']?>">[ Sil ]</a>
                          </td>

                    
                        



                    </tr>
                <?php } ?>
                </tbody>
                
            </table>
            <?php

$ileri = $_GET['page'];
$ilerigit = $ileri+1;

if ($ileri < $total_pages )
{}
else {
  $ilerigit = $ileri +0;
}

$geri = $_GET['page'];
$gerigit = $geri - 1 ;
if ($geri > 1 )
{}
else {
  $gerigit = $geri -0;

}
?>
       <div class="pagination skew-25"> <ul>
         <?php 
         if($total_pages == 0){}
         else {         ?>

          <li><a class="skew25" href="<?php echo "index.php?sayfa=bankahesaplari&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?sayfa=bankahesaplari&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?sayfa=bankahesaplari&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>

          </div> 
            
          
       
    </section> 
</div>
  </div>

  <?php  } else{ ?>
            <div class="alert alert-danger" style="text-align: center;">BU SAYFAYI GÖRÜNTÜLEMEK İÇİN PROFİL BİLGİLERİNİ EKSİKSİZ BİR ŞEKİLDE DOLDURDUKTAN SONRA YÖNETİCİ ONAYI BEKLEMELİSİNİZ.</div>
<?php } ?>