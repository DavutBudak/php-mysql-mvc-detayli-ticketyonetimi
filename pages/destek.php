<?php
    if($_GET["core"] == "sil"){
        $destekid = $_GET["id"];
        $sil = $db->prepare("DELETE FROM uye_destek WHERE id = ? AND uye_id = ? ");
        $sil->execute(array($destekid,$_SESSION['id']));
        if ($sil) {
            echo '
            <div class="alert alert-success" role="alert">
            Destek bilgisi silindi.
            </div>';
            header("Location:?sayfa=destek&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Destek bilgisi silme başarısız. Bir sorun oluştu.
            </div>';
        }
    }
?>



<?php
if (isset($_FILES['destek_konu_dosya'])) {
    $yuklenemeyenler = array(); //yüklenemeyen ve hatası dönen resimleri bu dizide tutacağız.

    $klasor = "uploadsdestek/"; //yükleyeceğimiz klasörü belirledik.

    //Artık resimlerimiz dizi olarak geldiği için bir döngü ile tek tek kontrol ve kayıt etmemiz gerekiyor.
    $resim_sayisi = count($_FILES['destek_konu_dosya']['name']); //kaç tane resim geldiğini öğrendik.
    for ($i = 0; $i < $resim_sayisi; $i++) {
        //resim sayısı kadar döngüye soktuk.

        $resimBoyutu = $_FILES['destek_konu_dosya']['size'][$i]; //döngü içerisindeki resmin boyutunu öğrendik.
        $rand =substr(md5(uniqid(rand())),0,10);

        if ($resimBoyutu > (1024 * 1024 * 2)) {
            //buradaki işlem aslında bayt, kilobayt ve mb formülüdür.
            //2 rakamını mb olarak görün ve kaç yaparsanız o mb anlamına gelir.
            //Örn: (1024* 1024* 3) => 3MB/ (1024* 1024* 4) => 4MB

            $yuklenemeyenler[] = $_FILES['destek_konu_dosya']['name'][$i] . " - BOYUT";
        } else {
            $tip = $_FILES['destek_konu_dosya']['type'][$i]; //resim tipini öğrendik.
            $resimAdi = $_FILES['destek_konu_dosya']['name'][$i]; //resmin adını öğrendik.
            
            if ($tip == 'image/jpeg' || $tip == 'image/jpg' || $tip == 'image/png') { //uzantısnın kontrolünü sağladık. sadece .jpg ve .png yükleyebilmesi için.
                if (move_uploaded_file($_FILES["destek_konu_dosya"]["tmp_name"][$i], $klasor . "/" .$randomubunaal=$rand. $_FILES['destek_konu_dosya']['name'][$i])) {


                    //tmp_name ile resmi bulduk ve nereye, hangi isimle yukleneceğini belirleyip yükledik.
                    //yükleme işlemi başarılı olursa dilediğiniz bir olayı gerçekleştirebilirsiniz.
                    $destek_konu_dosya = $randomubunaal;
              
                } 
            } 
        }
    }if (count($yuklenemeyenler) > 0) {
        echo "";
        var_dump($yuklenemeyenler);
    } 
    
    else 
    echo '';



   
}


?>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Destek</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i> Destek</a></li>
        </ol>
    </section>
    <center>
        <!-- Main content -->


        <?php

        if ($_POST) {
            $destek_konu = trim($_POST["destek_konu"]);
            $destek_konu_tarihi = date('Y-m-d H.i:s');
            $destek_konu_kategori = trim($_POST["destek_konu_kategori"]);
            $destek_konu_onem = trim($_POST["destek_konu_onem"]);
            $destek_konu_aciklama = trim($_POST["destek_konu_aciklama"]);
           
           

            
            if ( empty($destek_konu)  || empty($destek_konu_aciklama)  || empty($destek_konu_tarihi) || empty($destek_konu_kategori)  || empty($destek_konu_onem)  ) {
                echo '
                   <div class="alert alert-danger" role="alert">
                   Yıldızlı alanlar boş bırakılamaz.
                  </div>';
            } else {  
                $ekle = $db->prepare("INSERT INTO uye_destek (uye_id, uye_kadi, destek_konu, destek_konu_aciklama, destek_konu_tarihi, destek_konu_kategori, destek_konu_onem,destek_konu_dosya) VALUES (?,?,?,?,?,?,?,?)");
                $ekle->execute(array($_SESSION["id"], $_SESSION["uye"], $destek_konu, $destek_konu_aciklama, $destek_konu_tarihi, $destek_konu_kategori, $destek_konu_onem,$destek_konu_dosya));
            }


            if ($ekle) {
                echo '
                       <div class="alert alert-success" role="alert">
                       Destek Oluştruldu En Kısa Sürede Geri Dönüş Yapılacaktır
                       </div>';
                       header("Location:?sayfa=destek&page=1");
                       
            } else {
                echo '
                       <div class="alert alert-danger" role="alert">
                      başarısız. Bir sorun oluştu.
                       </div>';
            }
 
} 

        ?>




            <div class="row">
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->
            <div class="col-lg-2" ></div>
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->

                <div class="chart-box">
   

 <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">Açılan Destekler</h4> </div>
 <hr>

<div style=" width: 100%;" class="btn btn-success" data-toggle="modal" data-target="#ornekModal"> <b style="color:white;">Destek Oluştur</b></a></h4> </div>

<!-- MODAL KODLARI BAŞLANGIC-->

<div class="modal fade" tabindex="-1" role="dialog" id="ornekModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Destek Oluştur</h4>
      </div>
      <div class="modal-body">
      <form method="post" action="" enctype="multipart/form-data">

      <div class="row">
         <div class="col-md-6 form-group">
           <label>Konu</label>
           <input type="text" class="form-control" id="placeholderInput" placeholder="Konu Başlığı"  name="destek_konu" >
         </div>

         <div class="col-md-6 form-group">
           <label>Mesaj</label>
           <input type="text" class="form-control" id="placeholderInput" placeholder="Konu Başlığı"  name="destek_konu_aciklama" >
         </div>

         <div class="col-md-6 form-group">
                        <label>Konu Kategorisi</label><br>

                        <select name="destek_konu_kategori" class="col-md-12 form-group" style="text-align: center;">
                          <option value="Genel">Genel</option>
                          <option value="Odemeler">Odemeler</option>
                          <option value="Ban">Ban</option>
                          <option value="Telif">Telif</option>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                        <label>Konu Önemi</label><br>

                        <select name="destek_konu_onem" class="col-md-12 form-group" style="text-align: center;">
                          <option value="Kritik">Kritik</option>
                          <option value="Yuksek">Yüksek</option>
                          <option value="Orta">Orta</option>
                          <option value="Dusuk">Düşük</option>
                        </select>
                      </div>


                      <div class="col-md-12 form-group border">
                      <table>
                        <tr>
                          <td>Dosya Seçiniz:</td> 
                          <td><input type="file" name="destek_konu_dosya[]" multiple="multiple" /></td>
                         
                        </tr>

                      </table>
                    </div>
                   <button style="text-align: center;" type="submit" class="btn btn-primary col-md-12">Konuyu Gönder</button>

       </div>
       </form>

    </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-default" data-dismiss="modal">Kapat</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- MODAL KODLARI BİTİŞ-->

              <hr>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Kullanıcı</th>
                    <th scope="col">Konu</th>
                    <th scope="col">Konu Tarihi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Önem</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Sil</th>


                </tr>
                </thead>
                <tbody>
                <?php


                $limit = 5;
                $query = "SELECT count(*) FROM uye_destek WHERE uye_id =$_SESSION[id]";

                $s = $db->query($query);
                $total_results = $s->fetchColumn();
                $total_pages = ceil($total_results/$limit);
                
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else{
                    $page = $_GET['page'];
                }



                $starting_limit = ($page-1)*$limit;



                $uyeler = $db -> prepare("SELECT * FROM uye_destek WHERE uye_id = ? ORDER BY id Desc LIMIT $starting_limit,$limit");
                $uyeler->execute(array($_SESSION["id"]));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>

                        <td> <?php echo $_SESSION["uye"];?></td>
                        <td> <a href="?sayfa=destekcevap&id=<?php echo $uye['id']?>"> <?php echo $uye['destek_konu'];?></a></td>
                        <td><?php echo $uye['destek_konu_tarihi'];?></td>
                        <td><?php echo $uye['destek_konu_kategori'];?></td>
                        <td><?php echo $uye['destek_konu_onem'];?></td>
                      <td class="text-danger" ><?php if($uye['destek_konu_durum'] == 1){ echo "Çözüldü";} elseif ($uye['destek_konu_durum']== 2) { echo "Cevaplandı";}else{echo "Cevap Bekliyor";}?></td>

                        <td><a onclick="return confirm('Veri silinecek Onaylıyormusunuz')" href="?sayfa=destek&core=sil&id=<?php echo $uye['id']?>">[ Sil ]</a></td>


                       
 


                    </tr>
                <?php } 
                ?>
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

          <li><a class="skew25" href="<?php echo "index.php?sayfa=destek&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?sayfa=destek&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?sayfa=destek&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>

            
                        
          </div>
