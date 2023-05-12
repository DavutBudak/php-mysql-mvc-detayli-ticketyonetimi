

<?php
$id = $_SESSION["id"];

$uye_getir = $db->prepare("SELECT * FROM uye_para_talep WHERE uye_id = ?");
$uye_getir->execute(array($id));
if ($uye_getir) {
    $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
}

?>


<?php

$uye_bilgileri_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
$uye_bilgileri_getir->execute(array($id));
if ($uye_bilgileri_getir) {
    $uye_bilgileri = $uye_bilgileri_getir->fetch(PDO::FETCH_OBJ);
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Para Çek</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i> Para Çek</a></li>
        </ol>
    </section>
    <center>
        <!-- Main content -->



 
        <?php

if($uye_bilgileri->para_cekme_onay_durumu == 0 ){ 


        if ($_POST) {
            $uye_ad = $uye_bilgileri->uye_ad;
            $uye_soyad = $uye_bilgileri->uye_soyad;
            $meta_login = $uye_bilgileri->meta_login;
            $uye_talep_miktar = trim($_POST["uye_talep_miktar"]);
            $uye_talep_doviz_cinsi = trim($_POST["uye_talep_doviz_cinsi"]);
            $uye_talep_tarih = trim($_POST["uye_talep_tarih"]);
            $uye_talep_verdigi_tarih = date('Y-m-d H.i:s');
            $uye_talep_banka_adi = trim($_POST["uye_talep_banka_adi"]);

            if (empty($meta_login)  || empty($uye_talep_miktar) || empty($uye_talep_tarih) || empty($uye_talep_banka_adi) || empty($uye_ad) || empty($uye_soyad)  || empty($uye_talep_doviz_cinsi)   ) {
                echo '
                   <div class="alert alert-danger" style="text-align:center;" role="alert">
Bütün Alanları Doldurunuz                  </div>';
            } else {
                $uye_guncelle = $db->prepare("INSERT INTO uye_para_talep (uye_id, meta_login, uye_ad , uye_soyad, uye_talep_miktar, uye_talep_banka_adi, uye_talep_tarih, uye_talep_verdigi_tarih, uye_talep_doviz_cinsi) VALUES (?,?,?,?,?,?,?,?,?)");
                $uye_guncelle->execute(array($id, $meta_login, $uye_ad, $uye_soyad, $uye_talep_miktar, $uye_talep_banka_adi, $uye_talep_tarih, $uye_talep_verdigi_tarih, $uye_talep_doviz_cinsi));
            }


            if ($uye_guncelle) {
                echo '
                       <div class="alert alert-success" role="alert">
                       kayıt edildi. Listeye yönlendirilecek.
                       </div>';

                header("Location:?sayfa=paracekme&page=1");
            } 
        }
    }

if($uye_bilgileri->para_cekme_onay_durumu !== NULL){ 


    if ($_POST) {

        echo '
        <div class="alert alert-danger" role="alert">
           PARA ÇEKME İŞLEMİNİZ BAŞARISIZ OLDU LÜTFEN BANKA HESABI EKLEDİĞİNİZDEN EMİN OLUN. VEYA DETAYLI BİLGİ İÇİN DESTEK İLE BİZE ULAŞABİLİRSİNİZ.
            </div>';     
}
}
        ?>

          
            <div class="row">
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->
            <div class="col-lg-2" ></div>
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->

            <div class="col-lg-8" >
                <div class="chart-box">


<?php if ($uye_bilgileri->meta_login !== "kapali") {?>

                    <h2 style="margin-top: 50px;"> Para Çekme Talebi</h2><br><br>
                    <form action="" method="POST">

                      <label> <b> Talep Edilen Miktar</b> </label>
                        <input type="number" class="form-control" style="text-align: center;" min="1" name="uye_talep_miktar">
                        <br>
                        <i class="far fa-clock"></i>    <label> <b> Talep Tarihi</b> </label>
                        <input type="date" class="form-control" style="text-align: center;" value="<?php echo date('Y-m-d') ?>" name="uye_talep_tarih">
                        <br>
                            <tbody>
                                <?php
                                $uyeler = $db->prepare("SELECT * FROM uye_banka_hesaplari WHERE  uye_id = ? ORDER BY uye_id ASC");
                                $uyeler->execute(array($id));
                                $uye_sonuc = $uyeler->fetchAll();
                                ?>
                                <tr>
 
                                <i class="fas fa-money-check-alt"></i> <select name="uye_talep_banka_adi" class="form-control" style="text-align: center; " >
                                


                                        <?php foreach ($uye_sonuc as $uye) { ?>

                                            <option  value="<?php echo $uye['idyeni']; ?>"><?php echo $uye['uye_banka_adi']; ?> - <?php echo $uye['uye_iban'] ?> - <?php echo $uye['uye_banka_doviz_cinsi'] ?> </option>
                                        <?php } ?>
                                    </select>
                                </tr>
                            </tbody>
<br>                                <select name="uye_talep_doviz_cinsi" class="form-group form-control" style="text-align: center;">
                          <option selected value="TRY">TRY</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Talep Gönder</button>
                    </form>
                </div>
                </div>

            </div>
       





            <div class="col-lg-12">
                <div class="chart-box">
                <h3>  İşlem Geçmişi </h3>
<hr>
                <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col" >Banka Adı</th>
                    <th scope="col" >IBAN</th>
                    <th scope="col" >Döviz Cinsi</th>
                    <th scope="col" >Miktar</th>
                    <th scope="col">Talep Tarihi</th>
                    <th scope="col" >Onay Durumu</th>
                    <th scope="col" style="text-align:center;">Not</th>





                </tr>
                </thead>
                <tbody>
                <?php

$limit = 5;
$query = "SELECT count(*) FROM uye_para_talep WHERE uye_id =$_SESSION[id]";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;

              
                $uyeler = $db -> prepare("SELECT a.*,b.uye_banka_adi,b.uye_iban,b.uye_banka_doviz_cinsi FROM uye_para_talep a LEFT JOIN uye_banka_hesaplari b ON a.uye_talep_banka_adi=b.idyeni WHERE a.uye_id = ? ORDER BY id DESC LIMIT $starting_limit,$limit");
                $uyeler->execute(array($id));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>
                        <td><?php echo $uye['uye_banka_adi'];?></td>
                        <td><?php echo $uye['uye_iban'];?></td>
                        <td><?php echo $uye['uye_talep_doviz_cinsi'];?></td>
                        <td class="text-success"><?php echo $uye['uye_talep_miktar']; if($uye['uye_talep_doviz_cinsi'] == "USD"){echo " $";} elseif($uye['uye_talep_doviz_cinsi'] == "TRY"){echo " ₺";} elseif($uye['uye_talep_doviz_cinsi'] == "EUR"){echo " €";} ?>   </td>
                        <td><?php echo $uye['uye_talep_tarih'];?></td>
                        <td class="text-danger"><?php if($uye['uye_onay_durumu'] == 1){ echo "Onaylandı";} elseif ($uye['uye_onay_durumu']== 2) { echo "Onaylanmadı";}else{echo "Onay Bekleniyor";}?></td>
                        <td style="color:red;"><?php echo $uye['uye_not'];?></td>

                        



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

          <li><a class="skew25" href="<?php echo "index.php?sayfa=paracekme&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?sayfa=paracekme&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?sayfa=paracekme&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>

           </ul></div>
                </div>
            </div>
            <?php  } else{ ?>
            <div class="alert alert-danger" style="text-align: center; line-height:40px">BU SAYFAYI GÖRÜNTÜLEMEK İÇİN PROFİL BİLGİLERİNİ EKSİKSİZ BİR ŞEKİLDE DOLDURDUKTAN SONRA YÖNETİCİ ONAYI BEKLEMELİSİNİZ.</div>
<?php }     ?> 