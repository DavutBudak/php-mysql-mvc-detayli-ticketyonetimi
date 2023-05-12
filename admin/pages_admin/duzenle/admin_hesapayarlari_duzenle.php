
<?php 
    if($_GET["core"] == "sil_dekont"){
        $dosyaid_dekont = $_GET["id"];
        $sil_dekont = $db->prepare("DELETE FROM uye_dekont_dosyalari WHERE id = ? ");
        $sil_dekont->execute(array($dosyaid_dekont));
        if ($sil_dekont) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:index.php?adminsayfa=adminhesapayarlari&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>'; 
        }
    }
?>



<?php 
    if($_GET["core"] == "sil_kimlik"){
        $dosyaid_kimlik = $_GET["id"];
        $sil_kimlik = $db->prepare("DELETE FROM uye_kimlik_dosyalari WHERE id = ? ");
        $sil_kimlik->execute(array($dosyaid_kimlik));
        if ($sil_kimlik) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:index.php?adminsayfa=adminhesapayarlari&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>'; 
        }
    }
?>




<?php 
    if($_GET["core"] == "sil_ehliyet"){
        $dosyaid_ehliyet = $_GET["id"];
        $sil_ehliyet = $db->prepare("DELETE FROM uye_ehliyet_dosyalari WHERE id = ? ");
        $sil_ehliyet->execute(array($dosyaid_ehliyet));
        if ($sil_ehliyet) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:index.php?adminsayfa=adminhesapayarlari&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>'; 
        }
    }
?>



<?php 
    if($_GET["core"] == "sil_ikametgah"){
        $dosyaid_ikametgah = $_GET["id"];
        $sil_ikametgah = $db->prepare("DELETE FROM uye_ikametgah_dosyalari WHERE id = ? ");
        $sil_ikametgah->execute(array($dosyaid_ikametgah));
        if ($sil_ikametgah) {
            echo '
            <div class="alert alert-success" role="alert">
            banka bilgisi silindi.
            </div>';
            header("Location:index.php?adminsayfa=adminhesapayarlari&page=1");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Banka bilgisi silme başarısız. Bir sorun oluştu.
            </div>'; 
        }
    }
?>





<?php
$id = $_GET["id"];
$uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
$uye_getir->execute(array($id));
if ($uye_getir) {
    $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
}
?>

<script> 
       function ilceGetir(val) {
	$.ajax({
		type: "POST",
		url: "../pages/country.php",
		data:'il_id='+val,
		success: function(data){
			$("#sehirler").html(data);
		}
	});
}
  </script>
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Hesap Ayarları</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i>Hesap Ayarları</a></li>
        </ol>
    </section>
    <center>
        <!-- Main content -->
      
            <div class="row">
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->
            <div class="col-lg-2" ></div>
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->

            <div class="col-lg-8" >
                <div class="chart-box">

                <?php 
            if (isset($_POST["uye_kadi"])) {
                $uye_kadi = trim($_POST["uye_kadi"]);
                $uye_sifre = trim($_POST["uye_sifre"]);
                $uye_eposta = trim($_POST["uye_eposta"]);
                $uye_ad = trim($_POST["uye_ad"]);
                $uye_soyad = trim($_POST["uye_soyad"]);
                $uye_adres = trim($_POST["uye_adres"]);
                $uye_telno = trim($_POST["uye_telno"]);
                $uye_dogumtarih = trim($_POST["uye_dogumtarih"]);
                $uye_medenihal = trim($_POST["uye_medenihal"]);
                $uye_cinsiyet = trim($_POST["uye_cinsiyet"]);
                $uye_il = trim($_POST["uye_il"]);
                $uye_ilce = trim($_POST["uye_ilce"]);
                $meta_login = trim($_POST["meta_login"]);
                $para_cekme_onay_durumu = trim($_POST["para_cekme_onay_durumu"]);

              

                if (empty($uye_kadi) || empty($uye_sifre) || empty($uye_eposta) ) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
                } else {
                  $ayni_uye_varmi = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_kadi = ? AND uye_id != ?");
                    $ayni_uye_varmi->execute(array($uye_kadi, $id));

  



                    if ($ayni_uye_varmi->rowCount()) {
                        echo '
                           <div class="alert alert-danger" role="alert">
                           Bu kullanıcı adı zaten kayıtlı. Farklı bir kullanıcı adı deneyin.
                          </div>';
                    } else {
                        $uye_guncelle = $db->prepare("UPDATE uye_bilgileri SET uye_kadi = ?, uye_sifre = ?, uye_eposta = ? , uye_ad = ?, uye_soyad = ? , uye_adres = ? , uye_telno = ? , uye_dogumtarih = ? , uye_medenihal = ? , uye_cinsiyet = ? , uye_il = ? , uye_ilce = ? , meta_login = ? ,para_cekme_onay_durumu = ? WHERE uye_id = ?");
                        $uye_guncelle->execute(array($uye_kadi, $uye_sifre, $uye_eposta, $uye_ad, $uye_soyad, $uye_adres, $uye_telno, $uye_dogumtarih, $uye_medenihal, $uye_cinsiyet, $uye_il, $uye_ilce, $meta_login,$para_cekme_onay_durumu, $id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                            header("Location:index.php?adminsayfa=adminhesapayarlari&page=1");
                        }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Üye güncelleme başarısız. Bir sorun oluştu.
                           </div>';
                        }
                    }
                }
            }
            ?>
            <form method="post" action="" > 
            <div class="col-md-12 form-group">
                    <label style="color: red;">Meta Login: ( <small>Üye Profil Bilgilerini Doldurtuktan Sonra Meta Login Kodu Verilir.</small> )</label>
                    <input style="color: red; text-align:center;" type="text" class="form-control" maxlength="25" minlength="6" placeholder="Meta Login" name="meta_login"
                           value="<?php echo $uye->meta_login; ?>">
                </div>




                <div class="col-md-12 form-group">
                        <label><i class="fas fa-lira-sign"></i>  Para Çekme - Yatırma Onay:</label>

                        <select name="para_cekme_onay_durumu" class="form-group form-control" style="text-align: center;">
                        <?php if($uye->para_cekme_onay_durumu == "") { ?>
                       <?php } ?>
                          <option value="0" <?php if ($uye->para_cekme_onay_durumu == "0") {?> selected <?php }?>>İzin Var</option>
                          <option value="1" <?php if ($uye->para_cekme_onay_durumu == "1") {?> selected <?php }?>>İzin Yok</option>
                        </select>
                      </div>



                <div class="col-md-12 form-group">
                    <label>Kullanıcı Adı: (*)</label>
                    <input type="text" class="form-control"  placeholder="Kullanıcı adı giriniz" name="uye_kadi"
                           value="<?php echo $uye->uye_kadi; ?>">
                </div>
                <div class="col-md-12  form-group">
                    <label>Şifre: (*)</label>
                    <input type="text" class="form-control" placeholder="Şifre giriniz"  name="uye_sifre"
                           value="<?php echo $uye->uye_sifre; ?>">
                </div>
                <div class="col-md-12  form-group">
                    <label>E-posta: (*)</label>
                    <input type="email" class="form-control" placeholder="E-posta adresi giriniz" name="uye_eposta"
                           value="<?php echo $uye->uye_eposta; ?>">
                </div>
                <div class="row">

                      <div class="col-md-6 form-group">
                        <label> <i class="far fa-user"></i> Adınız</label>
                        <input class="form-control" id="placeholderInput" placeholder="Adınız" type="text" name="uye_ad" value="<?php echo $uye->uye_ad; ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label> <i class="far fa-user"></i>  Soy Adınız</label>
                        <input class="form-control" id="placeholderInput" placeholder="Soy Adınızı giriniz" name="uye_soyad" value="<?php echo $uye->uye_soyad; ?>" type="text">
                      </div>
                      </div>
                      <div class="row">

                      <div class="col-md-6 form-group">
                        <label> <i class="fas fa-mobile-alt"></i> Telefon No</label>
                        <input class="form-control" id="placeholderInput" placeholder="Telefon Numaranızı Giriniz" type="text" maxlength="11" name="uye_telno" value="<?php echo $uye->uye_telno; ?>">
                      </div>
                      <div class="col-md-6 form-group">
                        <label> <i class="far fa-clock"></i> Doğum Tarihi</label>
                        <input class="form-control" id="placeholderInput" placeholder="Doğum Tarihiniz" type="date" name="uye_dogumtarih" value="<?php echo $uye->uye_dogumtarih; ?>">
                      </div>
                      </div>
                      <div class="row">

                
               <div class="col-md-12 form-group">
                        <label><i class="fas fa-user-friends"></i>Medeni Haliniz:</label>

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
                        <label> <i class="fas fa-venus-mars"></i>Cinsiyetiniz</label>
                      </div>
                      <div class="col-md-12 form-group form-control">


                        Erkek: <input type="radio" name="uye_cinsiyet" value="Erkek" <?php if ($uye->uye_cinsiyet == "Erkek") {?> checked <?php }?>/>






                        Kadın: <input type="radio" name="uye_cinsiyet" value="Kadın" <?php if ($uye->uye_cinsiyet == "Kadın") {?> checked <?php }?>/>
                        </div>
                      </div>

                        <br>
                        
                    <div class="row">
                
                <div class="col-md-6 form-group">
                  <label> <i class="fas fa-city"></i> <b> İl</b></label>
                

                    <select class="form-control" name="uye_il" onChange="ilceGetir(this.value);">
<?php $listS = $db->query("SELECT * FROM iller ORDER BY id ASC"); ?>
<option value="<?php $uye->uye_il;?>" selected><?php echo $uye->uye_il; ?>
<?php foreach ($listS as $list) { ?>
<option value="<?php echo $list['id']; ?>"><?php echo $list['il_adi']; ?></option> 
<?php } ?>
</select>
</div>

<div class="col-md-6 form-group">
                  <label> <i class="fas fa-city"></i> <b> İlçe</b></label>
<select class="form-control" name="uye_ilce" id="sehirler"> 
<option value="<?php $uye->uye_ilce;?>" selected><?php echo $uye->uye_ilce; ?>
</select>
</div>





                </div>
                        <div class="row">

                      <div class="col-md-12 form-group">
                        <label> <i class="fas fa-map"></i> Adres Detay</label>
                        <input class="form-control" id="placeholderInput" placeholder="Adresiniz" type="text" name="uye_adres" value="<?php echo $uye->uye_adres; ?>">
                      </div>
                        </div>

                      
<br>

<div class="row">



                    <div class="col-md-3 form-group ">
<div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal_dekont"> <b style="color:white;">Dekontlar</b></div>
                    </div>

                    <div class="col-md-3 form-group ">
<div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal_kimlik"> <b style="color:white;"> Kimlik</b></div>
                    </div>     
                    <div class="col-md-3 form-group ">
<div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal_ehliyet"> <b style="color:white;"> Ehliyet</b></div>
                    </div>    
                    <div class="col-md-3 form-group ">
<div style="width: 100%;"  class="btn btn-success" data-toggle="modal" data-target="#ornekModal_ikametgah"> <b style="color:white;"> İkametgah</b></div>
                    </div>             
</div>


<!-- YÜKLENEN DEKONT DOSYALARI BAŞLANGIÇ -->

<div class="row"> 

                    <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_dekont">

  <div class="col-md-12" style="margin-top:150px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Yüklenen Dosyalar</h1>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

        <table class="table" style="margin-top: 20px;">
                <thead class="thead-light">
                <tr>
                <th scope="col">İd</th>

                <th scope="col">Uye İd</th>

                    <th scope="col">Uye Dosyası</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sil</th>



                </tr>
                </thead>
                <tbody>
                <?php
                $uye_dosyalari = $db -> prepare("SELECT * FROM uye_dekont_dosyalari WHERE uye_id=?");
                $uye_dosyalari->execute(array($id = $_GET["id"]));
                $uye_dosya_sonuc=$uye_dosyalari->fetchAll();
                foreach ($uye_dosya_sonuc as $uye_resim ) { ?>
                    <tr>
                      
                    <td><?php echo $uye_resim['id'];?></td>
                    <td><?php echo $uye_resim['uye_id'];?></td>
                        <td><div><a href="../uploads_dekont/<?php echo  $uye_resim['uye_dekont'];?>" download><img width="150px;" height="60px;" src="../uploads_dekont/<?php echo $uye_resim['uye_dekont']; ?>"></a></div></td>
                        <td><?php echo $uye_resim['resim_tarih'];?></td>
                       <td>
                       <a href="?adminsayfa=admindekontduzenle&id=<?php echo $uye_resim['id']?>">[ Düzenle ]</a>
                        <a onclick="return confirm('Dosya Silinecek Onaylıyormusunuz')" href="?adminsayfa=adminhesapayarlariduzenle&core=sil_dekont&id=<?php echo $uye_resim['id']?>">[ Sil ]</a></td>
                    </tr>
                <?php
           } ?>
                </tbody>
            </table>
          </div>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
<!-- YÜKLENEN DEKONT DOSYALARI BAŞLANGIÇ -->







<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->

<div class="row"> 

                    <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_kimlik">

  <div class="col-md-12" style="margin-top:150px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Yüklenen Kimlik</h1>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

        <table class="table" style="margin-top: 20px;">
                <thead class="thead-light">
                <tr>
                <th scope="col">İd</th>

                <th scope="col">Uye İd</th>

                    <th scope="col">Uye Kimlik</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sil</th>



                </tr>
                </thead>
                <tbody>
                <?php
                $uye_dosyalari_kimlik = $db -> prepare("SELECT * FROM uye_kimlik_dosyalari WHERE uye_id=?");
                $uye_dosyalari_kimlik->execute(array($id = $_GET["id"]));
                $uye_dosya_sonuc_kimlik=$uye_dosyalari_kimlik->fetchAll();
                foreach ($uye_dosya_sonuc_kimlik as $uye_resim_kimlik ) { ?>
                    <tr>
                      
                    <td><?php echo $uye_resim_kimlik['id'];?></td>
                    <td><?php echo $uye_resim_kimlik['uye_id'];?></td>
                        <td><div><a href="../uploads_kimlik/<?php echo  $uye_resim_kimlik['uye_kimlik'];?>" download><img width="150px;" height="60px;" src="../uploads_kimlik/<?php echo $uye_resim_kimlik['uye_kimlik']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_kimlik['resim_tarih'];?></td>
                       <td>
                       <a href="?adminsayfa=adminkimlikduzenle&id=<?php echo $uye_resim_kimlik['id']?>">[ Düzenle ]</a>
                        <a onclick="return confirm('Dosya Silinecek Onaylıyormusunuz')" href="?adminsayfa=adminhesapayarlariduzenle&core=sil_kimlik&id=<?php echo $uye_resim_kimlik['id']?>">[ Sil ]</a></td>
                    </tr>
                <?php
           } ?>
                </tbody>
            </table>
          </div>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->






<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->

<div class="row"> 

                    <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_ehliyet">

  <div class="col-md-12" style="margin-top:150px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Yüklenen Ehliyet</h1>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

        <table class="table" style="margin-top: 20px;">
                <thead class="thead-light">
                <tr>
                <th scope="col">İd</th>

                <th scope="col">Uye İd</th>

                    <th scope="col">Uye Ehliyet</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sil</th>



                </tr>
                </thead>
                <tbody>
                <?php
                $uye_dosyalari_ehliyet = $db -> prepare("SELECT * FROM uye_ehliyet_dosyalari WHERE uye_id=?");
                $uye_dosyalari_ehliyet->execute(array($id = $_GET["id"]));
                $uye_dosya_sonuc_ehliyet=$uye_dosyalari_ehliyet->fetchAll();
                foreach ($uye_dosya_sonuc_ehliyet as $uye_resim_ehliyet ) { ?>
                    <tr>
                      
                    <td><?php echo $uye_resim_ehliyet['id'];?></td>
                    <td><?php echo $uye_resim_ehliyet['uye_id'];?></td>
                        <td><div><a href="../uploads_ehliyet/<?php echo  $uye_resim_ehliyet['uye_ehliyet'];?>" download><img width="150px;" height="60px;" src="../uploads_ehliyet/<?php echo $uye_resim_ehliyet['uye_ehliyet']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_ehliyet['resim_tarih'];?></td>
                       <td>
                       <a href="?adminsayfa=adminehliyetduzenle&id=<?php echo $uye_resim_ehliyet['id']?>">[ Düzenle ]</a>
                        <a onclick="return confirm('Dosya Silinecek Onaylıyormusunuz')" href="?adminsayfa=adminhesapayarlariduzenle&core=sil_ehliyet&id=<?php echo $uye_resim_ehliyet['id']?>">[ Sil ]</a></td>
                    </tr>
                <?php
           } ?>
                </tbody>
            </table>
          </div>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->





<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->

<div class="row"> 

                    <div class="modal fade" tabindex="-1" role="dialog" id="ornekModal_ikametgah">

  <div class="col-md-12" style="margin-top:150px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h1 class="modal-title">Yüklenen İkametgah</h1>
      </div>
      <div class="modal-body">
        <div class="col-md-12">

        <table class="table" style="margin-top: 20px;">
                <thead class="thead-light">
                <tr>
                <th scope="col">İd</th>

                <th scope="col">Uye İd</th>

                    <th scope="col">Uye İkametgah</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sil</th>



                </tr>
                </thead>
                <tbody>
                <?php
                $uye_dosyalari_ikametgah = $db -> prepare("SELECT * FROM uye_ikametgah_dosyalari WHERE uye_id=?");
                $uye_dosyalari_ikametgah->execute(array($id = $_GET["id"]));
                $uye_dosya_sonuc_ikametgah=$uye_dosyalari_ikametgah->fetchAll();
                foreach ($uye_dosya_sonuc_ikametgah as $uye_resim_ikametgah ) { ?>
                    <tr>
                      
                    <td><?php echo $uye_resim_ikametgah['id'];?></td>
                    <td><?php echo $uye_resim_ikametgah['uye_id'];?></td>
                        <td><div><a href="../uploads_ikametgah/<?php echo  $uye_resim_ikametgah['uye_ikametgah'];?>" download><img width="150px;" height="60px;" src="../uploads_ikametgah/<?php echo $uye_resim_ikametgah['uye_ikametgah']; ?>"></a></div></td>
                        <td><?php echo $uye_resim_ikametgah['resim_tarih'];?></td>
                       <td>
                       <a href="?adminsayfa=adminikametgahduzenle&id=<?php echo $uye_resim_ikametgah['id']?>">[ Düzenle ]</a>
                        <a onclick="return confirm('Dosya Silinecek Onaylıyormusunuz')" href="?adminsayfa=adminhesapayarlariduzenle&core=sil_ikametgah&id=<?php echo $uye_resim_ikametgah['id']?>">[ Sil ]</a></td>
                    </tr>
                <?php
           } ?>
                </tbody>
            </table>
          </div>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
                    </div>
                    <div class="row">
                        <button type="submit" class="btn form-control btn-primary col-md-4">Düzenlemeyi Kaydet</button>
                        </div>
<!-- YÜKLENEN KİMLİK DOSYALARI BAŞLANGIÇ -->

              </div>
              

            </form>
            
            </div>
            

                </div>
            </div>





