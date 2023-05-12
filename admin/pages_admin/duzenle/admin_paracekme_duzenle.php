<?php
    $id = intval($_GET["id"]);
    $paratalep = $db->prepare("SELECT * FROM uye_para_talep WHERE id = ?");
    $paratalep->execute(array($id));
    if ($paratalep) {
        $uye = $paratalep->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Para Çekim Talebi Bilgisi</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i>Para Çekme Talepleri</a></li> 
        <li><a href="#"><i class="fa fa-home"></i>Para Çekme Bilgisi</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Para Çekme Bilgisi</h4>
              <p class="text-center m-top-2">Buradan Açılan Para Çekme Talebine Bilgi Verebilirsiniz.</p>
              <br>

            </div>
            <br><br>
            <?php
                        if ($_POST) {

                $uye_onay_durumu = trim($_POST["uye_onay_durumu"]);
                $uye_not = trim($_POST["uye_not"]);

                

               
                        $uye_guncelle = $db->prepare("UPDATE uye_para_talep SET uye_onay_durumu = ? , uye_not = ? WHERE id = ? ");
                        $uye_guncelle->execute(array($uye_onay_durumu, $uye_not ,$id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                            header("Location:index.php?adminsayfa=adminparacekme&page=1");
                        }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Banka Bilgisi güncelleme başarısız. Bir sorun oluştu.
                           </div>';
                        }
                    }
                 

            ?>
        
            <form method="post" action="">
   
            <div class="row">
            
                  <div class="col-md-12 form-group" style="text-align: center;">
                        <label>Onay Durumu:</label><br>

                        <select name="uye_onay_durumu" class="col-md-12 form-group" style="text-align: center;">
                          <option><?php echo $uye->uye_onay_durumu;?></option>
                          <option value="0">Cevap Bekliyor</option>
                          <option value="1" >Onayla</option>
                          <option value="2">Onaylama</option>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                    <label>Not</label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Not Giriniz"  name="uye_not" >
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