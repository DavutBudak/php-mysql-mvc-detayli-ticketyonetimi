<?php
    $id = intval($_GET["id"]);
    $destekcevap = $db->prepare("SELECT * FROM uye_destek WHERE id = ?");
    $destekcevap->execute(array($id));
    if ($destekcevap) {
        $uye = $destekcevap->fetch(PDO::FETCH_OBJ);
    }
?>



<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Destek Sonuç</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Menü</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Destek</a></li> 
        <li><a href="#"><i class="fa fa-home"></i> Destek Cevap</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
  
             
            <div class="head-title">
              <h4 style="text-align: center;">Temsilci Cevap Ekranı</h4>
              <br>
            <h4>KONU : <?php  echo $uye->destek_konu; ?></h4>
            </div>
   
  <?php
if ($uye->destek_konu_dosya == NULL){

  }
  else { ?> 

    <div style="margin-bottom:20px; float:right"><a href="../uploadsdestek/<?php echo $uye->destek_konu_dosya; ?>" download><img width="300px;" height="150px;" src="../uploadsdestek/<?php echo $uye->destek_konu_dosya; ?>"></a></div>

  <?php } ?> 




<div class="row" style="margin: 0px;">
<div class="col-md-12 alert alert-warning text-right">
<?php  echo $uye->destek_konu_aciklama;?>
            </div>


        <?php
         $mesajlar = $db->prepare("SELECT * FROM uye_mesaj WHERE destek_id = ?");
         $mesajlar->execute(array($id));
         $destekmesajlari = $mesajlar->fetchAll();
         foreach($destekmesajlari as $mesaj){
           if($mesaj['userid']!=$_SESSION["admin_id"]){
        ?>
          <div class="col-md-12 alert alert-warning text-right">
              <?php echo $mesaj['mesaj']?>
            </div>
        <?php }else{ 
          ?>
           <div class="col-md-12 alert alert-info text-left">
              <?php echo $mesaj['mesaj']?>
            </div>
         <?php 
        } 
         }?>
</div> 
    


        <?php
          if($_POST){
     
           $uye_id = $uye->uye_id;
            $userid = $_SESSION["admin_id"];
            $mesaj = $_POST["mesaj"];
            $tarih = date("Y-m-d H:i:s");

            $mesajekle = $db->prepare("INSERT INTO uye_mesaj (destek_id,userid,uye_id,mesaj,tarih) VALUES (?,?,?,?,?)");
            $mesajekle->execute(array($id,$userid,$uye_id,$mesaj,$tarih));

            if($mesajekle){
              echo '<div class="alert alert-success">Mesajınız başarıyla gönderildi.</div>';
              
             
            }else{
              echo '<div class="alert alert-danger">Mesajınız gönderilmedi.</div>';
            }
          }

        
        ?>
        <form action="" method="post">
          <div class="form-group">
          <textarea name="mesaj" rows="3" class="form-control" placeholder="Mesajınızı giriniz."></textarea>
          </div>
          
          <button class="btn btn-danger">Gönder</button>
        </form>
          
          </div>
        </div>
         
      </div>
       
    </section> 
  </div>

    



