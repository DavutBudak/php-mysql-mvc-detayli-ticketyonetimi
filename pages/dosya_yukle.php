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
      <h1>Kişisel Dosyaları Yükle</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><i class="fa fa-home"></i> Menü</li> 
        <li><a href=""><i class="fa fa-home"></i> Kişisel Dosyaları Yükle</a></li> 
      </ol>
    </section>

    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;"> Yüklenen Kişisel Dosyalar</h4>
              <p class="text-center m-top-2">Bu Ekrandan Dekont Gönderebilir Veya Gönderilen Dekontları Görüntüleyebilir Ve Güncelleyebilirsiniz</p>
            </div>





            <?php

 
if($_POST['yuklekimlik']){



   $gecici_ad=$_FILES["uye_kimlik"]["tmp_name"];
   $rand =substr(md5(uniqid(rand())),0,10);
   $kalici_yol_ad="uploads_kimlik/".$randomubunaal=$rand.($_FILES["uye_kimlik"]["name"]);
   if ($_FILES["uye_kimlik"]["size"]  > 4000000) {

      echo "<font color='green'>Dosya Boyutu Sınırı Aşıyor (Max Boyut 4 'MB' dir).","</font>";
   } else { 
  
   if ($_FILES["uye_kimlik"]["error"]) // hata oluştu ise
      echo "<font color='green'>Hata Oluştu Ve Dosya Yüklenemedi (Dosya Seçtiğinizden Emin Olun).","</font>";
   else{
      if (file_exists($kalici_yol_ad)) // yüklenen dosya upload dizininde varsa
         echo "<font color='red'>Yazdığınız ad ile bir dosya zaten kayıtlıdır.</font>";
      else{
         if ( move_uploaded_file($gecici_ad,$kalici_yol_ad)) {

          $resim_tarih = date("Y-m-d H:i:s");
          $uye_kimlik = $randomubunaal=$rand.($_FILES["uye_kimlik"]["name"]);

       

          $uye_guncelle_kimlik = $db->prepare("UPDATE uye_kimlik_dosyalari SET uye_kimlik = ?, resim_tarih = ? WHERE uye_id = ?");
          $uye_guncelle_kimlik->execute(array($uye_kimlik, $resim_tarih, $id));
          echo "<font color='green'>Dosya başarı ile yüklendi.</font>";

         

           
           
         } // eğer dosya kaydedilirse
         
            
         else
             echo "<font color='red'>Dosya yükleme başarısız.</font>";
      }
   }
}
}

?>



<?php

 
if($_POST['yukleehliyet']){



   $gecici_ad=$_FILES["uye_ehliyet"]["tmp_name"];
   $rand =substr(md5(uniqid(rand())),0,10);
   $kalici_yol_ad="uploads_ehliyet/".$randomubunaal=$rand.($_FILES["uye_ehliyet"]["name"]);
   if ($_FILES["uye_ehliyet"]["size"]  > 4000000) {

      echo "<font color='green'>Dosya Boyutu Sınırı Aşıyor (Max Boyut 4 'MB' dir).","</font>";
   } else { 
   if ($_FILES["uye_ehliyet"]["error"]) // hata oluştu ise
      echo "<font color='green'>Hata : ",$_FILES["uye_ehliyet"]["error"],"</font>";
   else{
      if (file_exists($kalici_yol_ad)) // yüklenen dosya upload dizininde varsa
         echo "<font color='red'>Yazdığınız ad ile bir dosya zaten kayıtlıdır.</font>";
      else{
         if ( move_uploaded_file($gecici_ad,$kalici_yol_ad)) {

          $resim_tarih = date("Y-m-d H:i:s");
          $uye_ehliyet = $randomubunaal=$rand.($_FILES["uye_ehliyet"]["name"]);

       

          $uye_guncelle_ehliyet = $db->prepare("UPDATE uye_ehliyet_dosyalari SET uye_ehliyet = ?, resim_tarih = ? WHERE uye_id = ?");
          $uye_guncelle_ehliyet->execute(array($uye_ehliyet, $resim_tarih, $id));
          echo "<font color='green'>Dosya başarı ile yüklendi.</font>";

         

           
           
         } // eğer dosya kaydedilirse
         
            
         else
             echo "<font color='red'>Dosya yükleme başarısız.</font>";
      }
   }
}
 }
?>



            <?php

 
if($_POST['yukleikametgah']){



   $gecici_ad=$_FILES["uye_ikametgah"]["tmp_name"];
   $rand =substr(md5(uniqid(rand())),0,10);
   $kalici_yol_ad="uploads_ikametgah/".$randomubunaal=$rand.($_FILES["uye_ikametgah"]["name"]);

   if ($_FILES["uye_ikametgah"]["size"]  > 4000000) {

      echo "<font color='green'>Dosya Boyutu Sınırı Aşıyor (Max Boyut 4 'MB' dir).","</font>";
   } else { 

   if ($_FILES["uye_ikametgah"]["error"]) // hata oluştu ise
      echo "<font color='green'>Hata : ",$_FILES["uye_ikametgah"]["error"],"</font>";
   else{
      if (file_exists($kalici_yol_ad)) // yüklenen dosya upload dizininde varsa
         echo "<font color='red'>Yazdığınız ad ile bir dosya zaten kayıtlıdır.</font>";
      else{
         if ( move_uploaded_file($gecici_ad,$kalici_yol_ad)) {

          $resim_tarih = date("Y-m-d H:i:s");
          $uye_ikametgah = $randomubunaal=$rand.($_FILES["uye_ikametgah"]["name"]);

       

          $uye_guncelle_ikametgah = $db->prepare("UPDATE uye_ikametgah_dosyalari SET uye_ikametgah = ?, resim_tarih = ? WHERE uye_id = ?");
          $uye_guncelle_ikametgah->execute(array($uye_ikametgah, $resim_tarih, $id));
          echo "<font color='green'>Dosya başarı ile yüklendi.</font>";

         

           
           
         } // eğer dosya kaydedilirse
         
            
         else
             echo "<font color='red'>Dosya yükleme başarısız.</font>";
      }
   }
}
 }

?>






<div class="row"> 
   <div class="col-md-4">
  <button class="btn btn-success"  style="width: 100%;" onclick="openCity('kimlik')">KİMLİK DOSYASI YÜKLE</button>
  </div>
  <div class="col-md-4">
  <button class="btn btn-danger" style="width: 100%;"  onclick="openCity('ehliyet')">EHLİYET DOSYASI YÜKLE</button>
  </div>
  <div class="col-md-4">
  <button  class="btn btn-primary" style="width: 100%;"  onclick="openCity('ikametgah')">İKAMETGAH DOSYASI YÜKLE</button>
  </div>
</div>


<br><br>


<!----KİMLİK İÇİN BAŞLANGIÇ---->
<div class="row" >
<div class="col-md-2"></div>
<div  id="kimlik" class="w3-container city chart-box col-md-8"  style="border:4px double green;">
<div class="col-md-2"></div>

    <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">Kimlik Yükle</h4> </div>
    <form action="" method="post" enctype="multipart/form-data">

<table border="0">
<tr>
<td class="bg-success">Kimlik Seçiniz:</td>
<td  class="bg-success"><input type="file" name="uye_kimlik"></td>
</tr>
<tr>
<td colspan="2" class="bg-success"><input type="submit" name="yuklekimlik" value="Seçilen Dosyayı Yükle" style="width: 70%;" ></td>
</tr>
</table>
<br>
<table >
   <tr class="bg-success">
   <div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal_kimlik"> <b style="color:white;">Yüklenen Kimlik Dosyası</b></div>
 </td>
   </tr>
</table>

</form>
</div>

</div>

             <!----KİMLİK İÇİN BİTİŞ ---->






             <!----EHLİYET İÇİN BAŞLANGIÇ---->
             <div class="row">

<div class="col-md-2"></div>
<div style="display:none; border:4px double red; "  id="ehliyet" class="w3-container city chart-box col-md-8" >
<div class="col-md-2"></div>

    <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">Ehliyet Yükle</h4> </div>
    <form action="" method="post" enctype="multipart/form-data">

<table border="0">
<tr>
<td class="bg-danger">Ehliyet Seçiniz:</td>
<td class="bg-danger"><input type="file" name="uye_ehliyet"></td>
</tr>
<tr>
<td colspan="2" class="bg-danger"><input type="submit" name="yukleehliyet" value="Seçilen Dosyayı Yükle" style="width: 70%;" ></td>
</tr>
</table>
<br>
<table >
   <tr class="bg-danger">
   <div style="width: 100%;"  class="btn btn-danger" data-toggle="modal" data-target="#ornekModal_ehliyet"> <b style="color:white;">Yüklenen Ehliyet Dosyası</b></div>
 </td>
   </tr>
</table>
</form>
</div>
             </div>

             <!----EHLİYET İÇİN BİTİŞ ---->






             <!----İKAMETGAH  İÇİN BAŞLANGIÇ---->
             <div class="row">

<div class="col-md-2"></div>
<div style="display:none;  border:4px double #5BB8FF; " id="ikametgah" class="w3-container city chart-box col-md-8">
<div class="col-md-2"></div>

    <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">İkametgah Yükle</h4> </div>
    <form action="" method="post" enctype="multipart/form-data">

<table border="0">
<tr>
<td class="bg-info">İkametgah Seçiniz:</td>
<td class="bg-info"><input type="file"  name="uye_ikametgah"></td>
</tr>
<tr>
<td colspan="2" class="bg-info"><input  type="submit" name="yukleikametgah" value="Seçilen Dosyayı Yükle" style="width: 70%;" ></td>
</tr>
</table>
<br>
<table >
   <tr class="bg-info">
   <div style="width: 100%;"  class="btn btn-info" data-toggle="modal" data-target="#ornekModal_ikametgah"> <b style="color:white;">Yüklenen İkametgah Dosyası</b></div>
 </td>
   </tr>
</table>

</form>
</div>
             </div>

             <!----İKAMETGAH İÇİN BİTİŞ ---->



<!--- DOSYA GEÇİŞİ SAĞLAMAK İÇİN SCRİPT BAŞLANGIÇ-->
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
<!--- DOSYA GEÇİŞİ SAĞLAMAK İÇİN SCRİPT BİTİŞ -->





<!-- KİMLİK MODAL DİV BAŞLANGIÇ-->


 <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_kimlik">
<div class="col-md-2"></div>
<div class="col-md-8" style="margin-top:150px;">
<div class="col-md-2"></div>
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h1 style="text-align: center;" class="modal-title">Yüklenen Kimlik Dosyası</h1>
    </div>
    <div class="modal-body">
      <div class="col-md-12">



      
            <div class="col-lg-12" >
                <div class="chart-box">



          <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Uye Kimlik</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Düzenle</th>



                </tr>
                </thead>
                <tbody>
                <?php



                $uye_kimlik_dosyalari = $db -> prepare("SELECT * FROM uye_kimlik_dosyalari WHERE uye_id = ? ");
                $uye_kimlik_dosyalari->execute(array($_SESSION["id"]));
                $uye_dosya_sonuc_kimlik=$uye_kimlik_dosyalari->fetchAll();
                foreach ($uye_dosya_sonuc_kimlik as $uye_resim_kimlik ) {
                   if($uye_resim_kimlik['uye_kimlik'] =='demo123.png') { ?>
                                      <div style="background-color:red; text-align:center; font-size: 25px; color:white"> Yüklü Dosya Bilgisi Bulunamadı. </div>
                                      <?php
                   }
                   else { 
                   
                   ?>
                
                    <tr>

                  
                      
                        <td><div><a href="uploads_kimlik/<?php echo  $uye_resim_kimlik['uye_kimlik'];?>" download><img width="150px;" height="60px;" src="uploads_kimlik/<?php echo $uye_resim_kimlik['uye_kimlik']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_kimlik['resim_tarih'];?></td>
                       <td>  <a href="?sayfa=kimlikduzenle&id=<?php echo $uye_resim_kimlik['id']?>">[ Düzenle ]</a>
                       
                    




                    </tr>
                <?php
           }  } ?>
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

<!-- KİMLİK MODAL DİV BİTİŞ-->







<!-- EHLİYET MODAL DİV BAŞLANGIÇ-->


<div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_ehliyet">
<div class="col-md-2"></div>
<div class="col-md-8" style="margin-top:150px;">
<div class="col-md-2"></div>
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h1 style="text-align: center;" class="modal-title">Yüklenen Ehliyet Dosyası</h1>
    </div>
    <div class="modal-body">
      <div class="col-md-12">



      
            <div class="col-lg-12" >
                <div class="chart-box">



          <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Uye Ehliyet</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Düzenle</th>



                </tr>
                </thead>
                <tbody>
                <?php



                $uye_ehliyet_dosyalari = $db -> prepare("SELECT * FROM uye_ehliyet_dosyalari WHERE uye_id = ? ");
                $uye_ehliyet_dosyalari->execute(array($_SESSION["id"]));
                $uye_dosya_sonuc_ehliyet=$uye_ehliyet_dosyalari->fetchAll();
                foreach ($uye_dosya_sonuc_ehliyet as $uye_resim_ehliyet ) { 
                  if($uye_resim_kimlik['uye_kimlik'] =='demo123.png') { ?>
                     <div style="background-color:red; text-align:center; font-size: 25px; color:white"> Yüklü Dosya Bilgisi Bulunamadı. </div>
                     <?php
  }
  else { 
  
  ?>
                   ?>
                    <tr>
                      
                        <td><div><a href="uploads_ehliyet/<?php echo  $uye_resim_ehliyet['uye_ehliyet'];?>" download><img width="150px;" height="60px;" src="uploads_ehliyet/<?php echo $uye_resim_ehliyet['uye_ehliyet']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_ehliyet['resim_tarih'];?></td>
                       <td>  <a href="?sayfa=ehliyetduzenle&id=<?php echo $uye_resim_ehliyet['id']?>">[ Düzenle ]</a>
                       
                    




                    </tr>
                <?php
           }  } ?>
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

<!-- EHLİYET MODAL DİV BİTİŞ-->







<!-- EHLİYET MODAL DİV BAŞLANGIÇ-->


<div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_ikametgah">
<div class="col-md-2"></div>
<div class="col-md-8" style="margin-top:150px;">
<div class="col-md-2"></div>
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h1 style="text-align: center;" class="modal-title">Yüklenen İkametgah Dosyası</h1>
    </div>
    <div class="modal-body">
      <div class="col-md-12">



      
            <div class="col-lg-12" >
                <div class="chart-box">



          <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Uye İkametgah</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Düzenle</th>



                </tr>
                </thead>
                <tbody>
                <?php



                $uye_ikametgah_dosyalari = $db -> prepare("SELECT * FROM uye_ikametgah_dosyalari WHERE uye_id = ? ");
                $uye_ikametgah_dosyalari->execute(array($_SESSION["id"]));
                $uye_dosya_sonuc_ikametgah=$uye_ikametgah_dosyalari->fetchAll();
                foreach ($uye_dosya_sonuc_ikametgah as $uye_resim_ikametgah ) { 
                  if($uye_resim_kimlik['uye_kimlik'] =='demo123.png') { ?>
                     <div style="background-color:red; text-align:center; font-size: 25px; color:white"> Yüklü Dosya Bilgisi Bulunamadı. </div>
                     <?php
  }
  else { 
  
  ?>
                   
                   ?>
                    <tr>
                      
                        <td><div><a href="uploads_ikametgah/<?php echo  $uye_resim_ikametgah['uye_ikametgah'];?>" download><img width="150px;" height="60px;" src="uploads_ikametgah/<?php echo $uye_resim_ikametgah['uye_ikametgah']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_ikametgah['resim_tarih'];?></td>
                       <td>  <a href="?sayfa=ikametgahduzenle&id=<?php echo $uye_resim_ikametgah['id']?>">[ Düzenle ]</a>
                       
                    




                    </tr>
                <?php
           }  } ?>
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

<!-- EHLİYET MODAL DİV BİTİŞ-->
