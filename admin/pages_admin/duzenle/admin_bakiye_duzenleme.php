<?php
    $id = intval($_GET["id"]);
    $bakiyeyukle = $db->prepare("SELECT * FROM uye_yatirim WHERE id = ?");
    $bakiyeyukle->execute(array($id));
    if ($bakiyeyukle) {
        $uye = $bakiyeyukle->fetch(PDO::FETCH_OBJ);
    }
?>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Para Yatırma Bilgisi</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Para Yatırma</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Para Yatırma Bilgisi</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Para Yatırma Onay Bilgisi</h4>
              <p class="text-center m-top-2">Buradan Açılan Yatırım Konusuna Bilgi Verebilirsiniz.</p>
              <br>

            </div>
            <br><br>
            <?php
                        if ($_POST) {

                $uye_yatirim_onay = trim($_POST["uye_yatirim_onay"]);
                $uye_yatirim_not = trim($_POST["uye_yatirim_not"]);

                

               
                        $uye_guncelle = $db->prepare("UPDATE uye_yatirim SET uye_yatirim_onay = ? , uye_yatirim_not = ? WHERE id = ? ");
                        $uye_guncelle->execute(array($uye_yatirim_onay, $uye_yatirim_not ,$id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler kayıt edildi. Listeye yönlendirilecek.
                           </div>';
                            header("Location:index.php?adminsayfa=adminbakiye&page=1");
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

                        <select name="uye_yatirim_onay" class="col-md-12 form-group" style="text-align: center;">
                          <option><?php echo $uye->uye_yatirim_onay;?></option>
                          <option value="0">Cevap Bekliyor</option>
                          <option value="1" >Onayla</option>
                          <option value="2">Onaylama</option>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                    <label>Not</label>
                    <input type="text" class="form-control" id="placeholderInput" placeholder="Not Giriniz"  name="uye_yatirim_not" >
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


