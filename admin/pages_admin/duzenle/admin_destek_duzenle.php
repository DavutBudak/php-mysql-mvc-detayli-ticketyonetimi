<?php
    $id = intval($_GET["id"]);
    $onaydurumu = $db->prepare("SELECT * FROM uye_destek WHERE id = ?");
    $onaydurumu->execute(array($id));
    if ($onaydurumu) {
        $uye = $onaydurumu->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Destek Durum Bilgisi</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Destek</a></li> 
        <li><a href="#"><i class="fa fa-home"></i>Destek Durum Bilgisi</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Destek Durum Bilgisi</h4>
              <p class="text-center m-top-2">Buradan Açılan Destek Konusuna Bilgi Verebilirsiniz.</p>
              <br>
              <h5 style="text-align: left;"><?php echo $uye->destek_konu; ?></h5>

            </div>
            <br><br>
            <?php
                        if ($_POST) {

                $destek_konu_durum = trim($_POST["destek_konu_durum"]);
                

                if (empty($destek_konu_durum)) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                       Yıldızlı alanlar boş bırakılamaz.
                      </div>';
                }
                else {
                        $uye_guncelle = $db->prepare("UPDATE uye_destek SET destek_konu_durum = ? WHERE id = ? ");
                        $uye_guncelle->execute(array($destek_konu_durum,$id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                           header("Location:?adminsayfa=admindestek");
                          }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Banka Bilgisi güncelleme başarısız. Bir sorun oluştu.
                           </div>';
                        }
                    }
                 } 

            ?>
        
            <form method="post" action="">
   
            <div class="row">
            
                  <div class="col-md-12 form-group" style="text-align: center;">
                        <label>Onay Durumu:</label><br>

                        <select name="destek_konu_durum" class="col-md-12 form-group" style="text-align: center;">
                          <option><?php echo $uye->destek_konu_durum;?></option>
                          <option value="0">Cevap Bekliyor</option>
                          <option value="1" >Çözüldü</option>
                          <option value="2">Cevaplandı</option>
                        </select>
                      </div>


                      <button style="text-align: center; width:100%;" type="submit" class="btn btn-primary col-md-12">Kaydet</button>
                </div>

          </form>

            </div>
           
          </div>
        </div>
         
      </div>
       
    </section> 
  </div>