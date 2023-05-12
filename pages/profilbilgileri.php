<?php
    $id = $_SESSION["id"];
    $uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
    $uye_getir->execute(array($id));
    if ($uye_getir) {
      $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
    }
    ?>


    <center>
    <script> 
       function ilceGetir(val) {
	$.ajax({
		type: "POST",
		url: "pages/country.php",
		data:'il_id='+val,
		success: function(data){
			$("#sehirler").html(data);
		}
	});
}
  </script>
 
      <?php
      if ($_POST) {
        $uye_ad = trim($_POST["uye_ad"]);
        $uye_soyad = trim($_POST["uye_soyad"]);
        $uye_adres = trim($_POST["uye_adres"]);
        $uye_telno = trim($_POST["uye_telno"]);
        $uye_dogumtarih = trim($_POST["uye_dogumtarih"]);
        $uye_medenihal = trim($_POST["uye_medenihal"]);
        $uye_cinsiyet = trim($_POST["uye_cinsiyet"]);
        $uye_il = trim($_POST["uye_il"]);
        $uye_ilce = trim($_POST["uye_ilce"]);





        if (empty($uye_ad) ||  empty($uye_soyad)  ||  empty($uye_adres)  ||  empty($uye_telno)  ||  empty($uye_dogumtarih)  ||  empty($uye_medenihal)  ||  empty($uye_cinsiyet) ||  empty($uye_il)||  empty($uye_ilce)) {
          echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
        }else {
            $uye_guncelle = $db->prepare("UPDATE uye_bilgileri SET  uye_ad = ?, uye_soyad = ? , uye_adres = ? , uye_telno = ? , uye_dogumtarih = ? , uye_medenihal = ? , uye_cinsiyet = ?, uye_il = ?, uye_ilce = ? WHERE uye_id = ?");
            $uye_guncelle->execute(array($uye_ad, $uye_soyad, $uye_adres, $uye_telno, $uye_dogumtarih, $uye_medenihal, $uye_cinsiyet, $uye_il, $uye_ilce, $id));
            if ($uye_guncelle) {
              echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
              header("Location:index.php?sayfa=profilbilgileri");
            } else {
              echo '
                           <div class="alert alert-danger" role="alert">
                           Üye güncelleme başarısız. Bir sorun oluştu.
                           </div>';
            }
          }
        }
      


     
      ?>




       
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Profil Bilgileri</h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Ana Sayfa</a></li>
            <li class="active"><a href=""><i class="fa fa-bars"></i> Profil Bilgileri</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="chart-box">
                <form class="stepform" action="" method="post" enctype="multipart/form-data">
                  <fieldset class="sf-step">
                    <legend>  Kişisel Bilgiler</legend>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label> <i class="far fa-user"></i> <b>  Adınız</b></label>
                        <input class="form-control" id="placeholderInput" placeholder="Adınız" type="text" name="uye_ad" value="<?php echo $uye->uye_ad; ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label><i class="far fa-user"></i> <b> Soy Adınız </b> </label>
                        <input class="form-control" id="placeholderInput" placeholder="Soy Adınızı giriniz" name="uye_soyad" value="<?php echo $uye->uye_soyad; ?>" type="text">
                      </div>
                      </div>
<div class="row">
                      <div class="col-md-6 form-group">
                        <label> <i class="fas fa-mobile-alt"></i> <b> Telefon No </b> </label>


                        <input class="form-control" id="placeholderInput" placeholder="Telefon Numaranızı Giriniz" type="text" maxlength="15" name="uye_telno" value="<?php echo $uye->uye_telno; ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label><i class="far fa-clock"></i> <b> Doğum Tarihi</b></label>
                        <input class="form-control" id="placeholderInput" placeholder="Doğum Tarihiniz" type="date" name="uye_dogumtarih" value="<?php echo $uye->uye_dogumtarih; ?>">
                      </div>
                      
                      </div>
<div class="row">
                      <div class="col-md-12 form-group">
                        <label><i class="fas fa-user-friends"></i>  <b> Medeni Haliniz:</b></label>

                        <select name="uye_medenihal" class="form-group form-control" style="text-align: center;">
                        <?php if($uye->uye_medenihal == "") { ?>
                          <option selected value="">Medeni Haliniz</option>
                       <?php } ?>
                          <option value="Evli" <?php if ($uye->uye_medenihal == "Evli") {?> selected <?php }?>>Evli</option>
                          <option value="Bekar" <?php if ($uye->uye_medenihal == "Bekar") {?> selected <?php }?>>Bekar</option>
                        </select>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-md-12 form-group">
                        <label><i class="fas fa-venus-mars"></i> <b> Cinsiyetiniz</b>  </label>
                      </div>
                      </div>

                      <div class="col-md-12 form-group form-control">
              
                      Erkek: <input type="radio" name="uye_cinsiyet" value="Erkek" <?php if ($uye->uye_cinsiyet == "Erkek") {?> checked <?php }?>/>
                      Kadın: <input type="radio" name="uye_cinsiyet" value="Kadın" <?php if ($uye->uye_cinsiyet == "Kadın") {?> checked <?php }?>/>
                        </div>

                  </fieldset>

                  <fieldset class="sf-step">
                    <legend>Adres Bilgileri</legend>
                    <br>

                    <div class="row">
                
                    <div class="col-md-6 form-group">
                      <label> <i class="fas fa-city"></i> <b> İl</b></label>
                    

                        <select class="form-control" name="uye_il" onChange="ilceGetir(this.value);">
	<?php $listS = $db->query("SELECT * FROM iller ORDER BY id ASC"); ?>
	<option selected value="<?php $uye->uye_il;?>" ><?php echo $uye->uye_il; ?>
	<?php foreach ($listS as $list) { ?>
		<option value="<?php echo $list['id']; ?>"><?php echo $list['il_adi']; ?></option> 
	<?php } ?>
</select>
</div>

<div class="col-md-6 form-group">
                      <label> <i class="fas fa-city"></i> <b> İlçe</b></label>
<select class="form-control" name="uye_ilce" id="sehirler"> 
<option selected value="<?php $uye->uye_ilce;?>"><?php echo $uye->uye_ilce; ?>
</select>
</div>


                    </div>
<div class="row">
                      <div class="col-md-12 form-group">
                        <label> <i class="fas fa-map"></i> <b> Adres</b> </label>
                       <input class="form-control" id="placeholderInput" placeholder="Adresiniz" type="text" name="uye_adres" value="<?php echo $uye->uye_adres; ?>">
                      </div>
                      <div class="col-md-12 form-group">
                        <button type="submit" style="width: 100%;" class="btn btn-primary">Kaydet</button>
                      </div>
                      </div>
                  </fieldset>


                 

                 
                </form>
                
              </div>
            </div>
          </div>
        </section>
      </div>
   