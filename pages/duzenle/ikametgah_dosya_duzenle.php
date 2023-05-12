<?php
    $id = intval($_GET["id"]);
    $uyefoto = $db->prepare("SELECT * FROM uye_ikametgah_dosyalari WHERE id = ? AND uye_id=?");
    $uyefoto->execute(array($id,$_SESSION['id']));
    if ($uyefoto) {
        $uye = $uyefoto->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> İkametgah Dosya Düzenle</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i>  Dosya Düzenle</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> İkametgah Dosya Düzenleme Sayfası</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;"> İkametgah Dosyanı Güncelle </h4>
              <p class="text-center m-top-2">Gönderdiğiniz Dosyaları Bu Ekrandan Güncelleyebilirsiniz</p>
            </div>
            <br><br>
 
            <?php

if($uye) { 

if($_POST['yukleikametgah']){



   $gecici_ad=$_FILES["uye_ikametgah"]["tmp_name"];
   $rand =substr(md5(uniqid(rand())),0,10);
   $kalici_yol_ad="uploads_ikametgah/".$randomubunaal=$rand.($_FILES["uye_ikametgah"]["name"]);

   if ($_FILES["uye_ikametgah"]["error"]) // hata oluştu ise
      echo "<font color='green'>Hata : ",$_FILES["uye_ikametgah"]["error"],"</font>";
   else{
      if (file_exists($kalici_yol_ad)) // yüklenen dosya upload dizininde varsa
         echo "<font color='red'>Yazdığınız ad ile bir dosya zaten kayıtlıdır.</font>";
      else{
         if ( move_uploaded_file($gecici_ad,$kalici_yol_ad)) {

          $resim_tarih = date("Y-m-d H:i:s");
          $uye_ikametgah = $randomubunaal=$rand.($_FILES["uye_ikametgah"]["name"]);

       
          $uye_guncelle_ikametgah = $db->prepare("UPDATE uye_ikametgah_dosyalari SET uye_ikametgah = ? , resim_tarih = ? WHERE id = ? AND uye_id=?");
          $uye_guncelle_ikametgah->execute(array($uye_ikametgah,$resim_tarih, $id,$_SESSION['id']));

          echo "<font color='green'>Dosya başarı ile yüklendi.</font>";

         

           
           
         } // eğer dosya kaydedilirse
         
            
         else
             echo "<font color='red'>Dosya yükleme başarısız.</font>";
      }
   }
}

?>




 


            <form method="post" action="" enctype="multipart/form-data">
   
            <div class="row">
            <div class="col-md-12 form-group border">
            <table border="0">
<tr>
<td class="bg-info">Kimlik Seçiniz:</td>
<td  class="bg-info"><input type="file" name="uye_ikametgah"></td>
</tr>

                        <div  class="col-md-4"></div>
                        <div style="margin-bottom: 20px;" class="col-md-4"><a href="uploads_ikametgah/<?php echo $uye->uye_ikametgah; ?>" download><img width="100%;" height="150px;" src="uploads_ikametgah/<?php echo $uye->uye_ikametgah; ?>"></a></div>
                        <div  class="col-md-4"></div>

                       


                      </table>
                    </div>
                      <input class="btn btn-primary" type="submit" name="yukleikametgah" value="Seçilen Dosyayı Yükle" style="width: 100%;" >

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