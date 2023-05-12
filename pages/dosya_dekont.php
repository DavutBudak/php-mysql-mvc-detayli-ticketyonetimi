<?php
    $id = $_SESSION["id"];
    $uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
    $uye_getir->execute(array($id));
    if ($uye_getir) {
      $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
    }
    ?>

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dekont Yükle</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><i class="fa fa-home"></i> Menü</li> 
        <li><a href=""><i class="fa fa-home"></i> Dekont Yükle</a></li> 
      </ol>
    </section>

    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;"> Yüklenen Dekontlar</h4>
              <p class="text-center m-top-2">Bu Ekrandan Dekont Gönderebilir Veya Gönderilen Dekontları Görüntüleyebilir Ve Güncelleyebilirsiniz</p>
            </div>
            
            <div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal"> <b style="color:white;">Yüklenen Dekontlar</b></div>
<hr>
            <br><br>
            <?php
if (isset($_FILES['uye_dekont'])) {
    $yuklenemeyenler = array(); //yüklenemeyen ve hatası dönen resimleri bu dizide tutacağız.

    $klasor = "uploads_dekont/"; //yükleyeceğimiz klasörü belirledik.

    //Artık resimlerimiz dizi olarak geldiği için bir döngü ile tek tek kontrol ve kayıt etmemiz gerekiyor.
    $resim_sayisi = count($_FILES['uye_dekont']['name']); //kaç tane resim geldiğini öğrendik.
    for ($i = 0; $i < $resim_sayisi; $i++) {
        //resim sayısı kadar döngüye soktuk.

        $resimBoyutu = $_FILES['uye_dekont']['size'][$i]; //döngü içerisindeki resmin boyutunu öğrendik.
        $rand =substr(md5(uniqid(rand())),0,10);

        if ($resimBoyutu > (1024 * 1024 * 2)) {
            //buradaki işlem aslında bayt, kilobayt ve mb formülüdür.
            //2 rakamını mb olarak görün ve kaç yaparsanız o mb anlamına gelir.
            //Örn: (1024* 1024* 3) => 3MB/ (1024* 1024* 4) => 4MB

            $yuklenemeyenler[] = $_FILES['uye_dekont']['name'][$i] . " - BOYUT";
        } else {
            $tip = $_FILES['uye_dekont']['type'][$i]; //resim tipini öğrendik.
            $resimAdi = $_FILES['uye_dekont']['name'][$i]; //resmin adını öğrendik.
            
            if ($tip == 'image/jpeg' || $tip == 'image/jpg' || $tip == 'image/png') { //uzantısnın kontrolünü sağladık. sadece .jpg ve .png yükleyebilmesi için.
                if (move_uploaded_file($_FILES["uye_dekont"]["tmp_name"][$i], $klasor . "/" .$randomubunaal=$rand. $_FILES['uye_dekont']['name'][$i])) {


                    //tmp_name ile resmi bulduk ve nereye, hangi isimle yukleneceğini belirleyip yükledik.
                    //yükleme işlemi başarılı olursa dilediğiniz bir olayı gerçekleştirebilirsiniz.
                    $uye_dekont = $randomubunaal;

                    $resim_tarih = date("Y-m-d H:i:s");
              
                    $resimekle = $db->prepare("INSERT INTO uye_dekont_dosyalari (uye_id,uye_dekont,resim_tarih) VALUES (?,?,?)");
                    $resimekle->execute(array($_SESSION["id"],$uye_dekont,$resim_tarih));
              
                    

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



<form action="" method="post" enctype="multipart/form-data">
   
            <div class="row">
            <div class="col-md-12 form-group border">
                      <table>
                        <tr>
                          <td> <b> Dosya Seçiniz:</b> </td>
                          <td><input type="file" name="uye_dekont[]" multiple="multiple" /></td>
                        
                        </tr>

                      </table>
                    </div>
                    
                      <button style="text-align: center; width: 100%;" type="submit" class="btn btn-primary col-md-12">Dosya Gönder</button>


                </div>



          </form>
        


   
            

          <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal">

<div class="col-md-12" style="margin-top:150px;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h1 style="text-align: center;" class="modal-title">Yüklenen Dekontlar</h1>
    </div>
    <div class="modal-body">
      <div class="col-md-12">

      <?php
    if($_GET["core"] == "sil"){
        $dosyaid = $_GET["id"];
        $sil = $db->prepare("DELETE FROM uye_dekont_dosyalari WHERE id = ? AND uye_id = ? ");
        $sil->execute(array($dosyaid,$_SESSION['id']));
        if ($sil) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:?sayfa=dekontyukle");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>';
        }
    }
?>

      
            <div class="col-lg-12" >
                <div class="chart-box">



          <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Uye Dekont</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sil</th>



                </tr>
                </thead>
                <tbody>
                <?php



                $uye_dekont_dosyalari = $db -> prepare("SELECT * FROM uye_dekont_dosyalari WHERE uye_id = ? ORDER BY id Desc ");
                $uye_dekont_dosyalari->execute(array($_SESSION["id"]));
                $uye_dosya_sonuc=$uye_dekont_dosyalari->fetchAll();
                foreach ($uye_dosya_sonuc as $uye_resim ) { ?>
                    <tr>
                      
                        <td><div><a href="uploads_dekont/<?php echo  $uye_resim['uye_dekont'];?>" download><img width="150px;" height="60px;" src="uploads_dekont/<?php echo $uye_resim['uye_dekont']; ?>"></a></div></td>
                        <td><?php echo $uye_resim['resim_tarih'];?></td>
                       <td>  <a href="?sayfa=dekontduzenle&id=<?php echo $uye_resim['id']?>">[ Düzenle ]</a>
                         <a onclick="return confirm('Dosya Silinecek Onaylıyormusunuz')" href="?sayfa=dekontyukle&core=sil&id=<?php echo $uye_resim['id']?>">[ Sil ]</a></td>
                       
                    




                    </tr>
                <?php
           } ?>
                </tbody>
            </table>
    
          


         
      </div></div></center>
    
    </div>
    </div>
    <div class="modal-footer">
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->