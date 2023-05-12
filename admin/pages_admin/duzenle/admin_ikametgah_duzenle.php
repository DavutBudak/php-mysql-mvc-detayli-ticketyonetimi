<?php
    $id = intval($_GET["id"]);
    $uyefoto = $db->prepare("SELECT * FROM uye_ikametgah_dosyalari WHERE id = ?");
    $uyefoto->execute(array($id));
    if ($uyefoto) {
        $uye = $uyefoto->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>İkametgah Düzenle</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i>İkametgah Düzenle</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> İkametgah Düzenleme Sayfası</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">İkametgah Dosyasını Güncelle </h4>
              <p class="text-center m-top-2">Gönderdiğiniz Dosyaları Bu Ekrandan Güncelleyebilirsiniz</p>
            </div>
            <br><br>
 
            <?php
if (isset($_FILES['uye_ikametgah'])) {
    $yuklenemeyenler = array(); //yüklenemeyen ve hatası dönen resimleri bu dizide tutacağız.

    $klasor = "../uploads_ikametgah/"; //yükleyeceğimiz klasörü belirledik.

    //Artık resimlerimiz dizi olarak geldiği için bir döngü ile tek tek kontrol ve kayıt etmemiz gerekiyor.
    $resim_sayisi = count($_FILES['uye_ikametgah']['name']); //kaç tane resim geldiğini öğrendik.
    for ($i = 0; $i < $resim_sayisi; $i++) {
        //resim sayısı kadar döngüye soktuk.

        $resimBoyutu = $_FILES['uye_ikametgah']['size'][$i]; //döngü içerisindeki resmin boyutunu öğrendik.
        $rand =substr(md5(uniqid(rand())),0,10);

        if ($resimBoyutu > (1024 * 1024 * 2)) {
            //buradaki işlem aslında bayt, kilobayt ve mb formülüdür.
            //2 rakamını mb olarak görün ve kaç yaparsanız o mb anlamına gelir.
            //Örn: (1024* 1024* 3) => 3MB/ (1024* 1024* 4) => 4MB

            $yuklenemeyenler[] = $_FILES['uye_ikametgah']['name'][$i] . " - BOYUT";
        } else {
            $tip = $_FILES['uye_ikametgah']['type'][$i]; //resim tipini öğrendik.
            $resimAdi = $_FILES['uye_ikametgah']['name'][$i]; //resmin adını öğrendik.
            
            if ($tip == 'image/jpeg' || $tip == 'image/jpg' || $tip == 'image/png') { //uzantısnın kontrolünü sağladık. sadece .jpg ve .png yükleyebilmesi için.
                if (move_uploaded_file($_FILES["uye_ikametgah"]["tmp_name"][$i], $klasor . "/" .$randomubunaal=$rand. $_FILES['uye_ikametgah']['name'][$i])) {


                    //tmp_name ile resmi bulduk ve nereye, hangi isimle yukleneceğini belirleyip yükledik.
                    //yükleme işlemi başarılı olursa dilediğiniz bir olayı gerçekleştirebilirsiniz.
                    $uye_ikametgah = $randomubunaal;

                    $resim_tarih = date("Y-m-d H:i:s");
              
                    $resimekle = $db->prepare("UPDATE uye_ikametgah_dosyalari SET uye_ikametgah = ? , resim_tarih = ? WHERE id = ?");
                    $resimekle->execute(array($uye_ikametgah,$resim_tarih, $id));
              
                    header("Location:?adminsayfa=adminhesapayarlari&page=1");


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







            <form method="post" action="" enctype="multipart/form-data">
   
            <div class="row">
            <div class="col-md-12 form-group border">
                      <table>
                        <tr>
                          <td>Dosya Seçiniz:</td>
                          <td><input type="file" name="uye_ikametgah[]" ></td>
                        
                        </tr>

                        <div  class="col-md-4"></div>
                        <div style="margin-bottom: 20px;" class="col-md-4"><a href="../uploads_ikametgah/<?php echo $uye->uye_ikametgah; ?>" download><img width="100%;" height="150px;" src="../uploads_ikametgah/<?php echo $uye->uye_ikametgah; ?>"></a></div>
                        <div  class="col-md-4"></div>

                       


                      </table>
                    </div>
                      <button style="text-align: center;" type="submit" class="btn btn-primary col-md-12">Kaydet</button>

                </div>

          </form>

            </div>
           
          </div>
        </div>
         
      </div>
       
    </section> 
  </div>