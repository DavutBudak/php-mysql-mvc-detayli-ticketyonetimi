
 <?php

$uye_bilgileri_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
$uye_bilgileri_getir->execute(array($_SESSION['id']));
if ($uye_bilgileri_getir) {
    $uye_bilgileri = $uye_bilgileri_getir->fetch(PDO::FETCH_OBJ);
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bakiye Yükle</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i> Bakiye Yükle</a></li>
        </ol>
    </section>
    <center> 

    <?php

if($uye_bilgileri->para_cekme_onay_durumu == 0 ){ 


        if ($_POST) {
            $uye_ad = $uye_bilgileri->uye_ad;
            $uye_soyad = $uye_bilgileri->uye_soyad;
            $meta_login = $uye_bilgileri->meta_login;
            $uye_yatirim_banka_adi = trim($_POST["uye_yatirim_banka_adi"]);
            $uye_yatirim_miktar = trim($_POST["uye_yatirim_miktar"]);
            $uye_yatirim_tarih = trim($_POST["uye_yatirim_tarih"]);
            $uye_yatirim_talebi_tarih = date('Y-m-d H.i:s');
            $uye_yatirim_onay = trim($_POST["uye_yatirim_onay"]);
            $uye_yatirim_not = trim($_POST["uye_yatirim_not"]);
            $uye_yatirim_doviz_cinsi = trim($_POST["uye_yatirim_doviz_cinsi"]);


            

            if (empty($meta_login)  || empty($uye_yatirim_tarih) || empty($uye_yatirim_miktar)  || empty($uye_yatirim_banka_adi) || empty($uye_ad) || empty($uye_soyad)) {
                echo '
                   <div class="alert alert-danger" style="text-align:center;" role="alert">
                            Bütün Alanları Eksiksiz Ve Doğru Doldurunuz </div>';
            } 

            else {
                $uye_guncelle = $db->prepare("INSERT INTO uye_yatirim (uye_id, meta_login, uye_ad , uye_soyad, uye_yatirim_miktar, uye_yatirim_banka_adi, uye_yatirim_tarih, uye_yatirim_talebi_tarih, uye_yatirim_doviz_cinsi) VALUES (?,?,?,?,?,?,?,?,?)");
                $uye_guncelle->execute(array($_SESSION['id'], $meta_login, $uye_ad, $uye_soyad, $uye_yatirim_miktar, $uye_yatirim_banka_adi, $uye_yatirim_tarih, $uye_yatirim_talebi_tarih, $uye_yatirim_doviz_cinsi));
            }


            if ($uye_guncelle) {
                echo '
                       <div class="alert alert-success" role="alert">
                       kayıt edildi. Listeye yönlendirilecek.
                       </div>';

                header("Location:?sayfa=bakiye&page=1");
            } 
        }
    }


if($uye_bilgileri->para_cekme_onay_durumu !== NULL){ 


    if ($_POST) {

        echo '
        <div class="alert alert-danger" role="alert">
           PARA YATIRMA İŞLEMİNİZ BAŞARISIZ OLDU LÜTFEN DETAYLI BİLGİ İÇİN DESTEK İLE BİZE ULAŞABİLİRSİNİZ.
            </div>';     
}
}

?>    


<?php if ($uye_bilgileri->meta_login !== "kapali") {?>

   






    <div class="row chart-box"> 
  <button class="btn btn-success col-md-6" onclick="openCity('normalbirim')">NORMAL BİRİM</button>
  <button class="btn btn-danger  col-md-6" onclick="openCity('kriptobirim')">KRİPTO BİRİM</button>
</div>



<div class="row"> 
    <!----TRY - USD - EUR . İÇİN BAŞLANGIÇ---->
    <div class="col-md-2"></div>
<div  id="normalbirim" class="w3-container city chart-box col-md-8">




    <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">Bakiye Yükle</h4> </div>

    <form action="" method="POST">

    <i class="fas fa-credit-card"></i> <label><b> Banka Adı  </b> </label>
    <input type="text" class="form-control" style="text-align: center;"  name="uye_yatirim_banka_adi">
    <br>
   <i class="fas fa-lira-sign"></i>    <label> <b> Yatırılacak Miktar </b></label>
    <input type="number" class="form-control" style="text-align: center;" min="1"  value="1" name="uye_yatirim_miktar"  required>
    <br>
    <label><i class="fas fa-user-friends"></i> <b>  Döviz Cinsi:</b></label>

    <select name="uye_yatirim_doviz_cinsi" class="form-group form-control" style="text-align: center;">
                          <option selected value="TRY">TRY</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                        </select>
    <br>
    <i class="far fa-clock"></i>    <label><b> Yatırma Tarihi</b></label>
    <input type="date" class="form-control" style="text-align: center;" value="<?php echo date('Y-m-d') ?>" name="uye_yatirim_tarih">
    <br>

    <button type="submit" name="normalbirim" class="btn btn-primary">Talep Gönder</button>
</form></div>
</div>
             <!----TRY - USD - EUR . İÇİN BİTİŞ ---->




                <!----KRİPTO  İÇİN BAŞLANGIÇ---->
<div class="row">
<div class="col-md-2"></div>

                <div style="display:none" id="kriptobirim" class="w3-container city chart-box  col-md-8" >

<div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;" >Kripto Bakiye Yükle</h4> </div>

<form action="" method="POST">
  <label> <b>Kripto Para Birimi </b> </label>
<input type="text" class="form-control" style="text-align: center;"  name="uye_yatirim_banka_adi">
<br>
<b style="font-size: 15px;"> ₿ </b>  <label> <b> Yatırılacak Miktar </b></label>
<input type="number" class="form-control" style="text-align: center;" min="0" step="0.00001" value="0" name="uye_yatirim_miktar"  required>
<br>
<label><i class="fas fa-user-friends"></i> <b>  Kripto Cinsi:</b></label>

<select name="uye_yatirim_doviz_cinsi" class="form-group form-control" style="text-align: center;">
                      <option selected value="BITCOIN">BITCOIN</option>
                      <option value="ETHEREUM">ETHEREUM</option>
                      <option  value="TETHERUSDT">TETHER USDT</option>

                    </select>
<br> 
<label>  <i class="far fa-clock"></i> <b> Yatırma Tarihi</b> </label>
<input type="date" class="form-control" style="text-align: center;" value="<?php echo date('Y-m-d') ?>" name="uye_yatirim_tarih">
<br>

<button type="submit" class="btn btn-primary">Talep Gönder</button>
</form>
</div>
</div>
                        <!----KRİPTO  İÇİN  BİTİŞ---->













<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>





    <div class="col-lg-12">
                <div class="chart-box">
                <h3>  İşlem Geçmişi </h3>
<hr>
                <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col" >Banka Adı</th>
                    <th scope="col" >Miktar</th>
                    <th scope="col" >Döviz Cinsi</th>
                    <th scope="col">Talep Tarihi</th>
                    <th scope="col" >Onay Durumu</th>
                    <th scope="col" style="text-align:center;">Not</th>





                </tr>
                </thead>
                <tbody>
                <?php

$limit = 5;
$query = "SELECT count(*) FROM uye_yatirim WHERE uye_id =$_SESSION[id]";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;

              
$uyeler = $db -> prepare("SELECT * FROM uye_yatirim WHERE uye_id = ? ORDER BY id Desc LIMIT $starting_limit,$limit");
$uyeler->execute(array($_SESSION["id"]));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>
                        <td><?php echo $uye['uye_yatirim_banka_adi'];?></td>
                        <td class="text-success"><?php echo $uye['uye_yatirim_miktar'];?><?php if($uye['uye_yatirim_doviz_cinsi'] == 'TRY'){ echo " ₺";} elseif ($uye['uye_yatirim_doviz_cinsi']== 'USD') { echo " $";}elseif ($uye['uye_yatirim_doviz_cinsi']== 'EUR') { echo " €";}  elseif ($uye['uye_yatirim_doviz_cinsi']== 'BITCOIN') { echo " ₿";} elseif ($uye['uye_yatirim_doviz_cinsi']== 'ETHEREUM') { echo " Ξ";} else {echo " ₮";} ?></td>
                        <td><?php echo $uye['uye_yatirim_doviz_cinsi'];?></td>
                        <td><?php echo $uye['uye_yatirim_tarih'];?></td>
                        <td class="text-danger"><?php if($uye['uye_yatirim_onay'] == 1){ echo "Onaylandı";} elseif ($uye['uye_yatirim_onay']== 2) { echo "Onaylanmadı";}else{echo "Onay Bekleniyor";}?></td>
                        <td style="color:red;"><?php echo $uye['uye_yatirim_not'];?></td>

                        



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

          <li><a class="skew25" href="<?php echo "index.php?sayfa=bakiye&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?sayfa=bakiye&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?sayfa=bakiye&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>

           </ul></div>
                </div>
            </div>
            <?php  } else{ ?>
            <div class="alert alert-danger" style="text-align: center; line-height:40px">BU SAYFAYI GÖRÜNTÜLEMEK İÇİN PROFİL BİLGİLERİNİ EKSİKSİZ BİR ŞEKİLDE DOLDURDUKTAN SONRA YÖNETİCİ ONAYI BEKLEMELİSİNİZ.</div>
<?php }     ?> 


