<?php
    if($_GET["core"] == "sil"){
        $destekid = $_GET["id"];
        $sil = $db->prepare("DELETE FROM uye_destek WHERE id = ?  ");
        $sil->execute(array($destekid));
        if ($sil) {
            echo '
            <div class="alert alert-success" role="alert">
            Destek bilgisi silindi.
            </div>';
            header("Location:?adminsayfa=admindestek");
        } else {
            echo '    
            <div class="alert alert-danger" role="alert">
            Destek bilgisi silme başarısız. Bir sorun oluştu.
            </div>';
        }
    }

            

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Destek</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i> Destek</a></li>
        </ol>
    </section>
    <center>
        <!-- Main content -->
        <?php

        if ($_POST) {
            $destek_konu = trim($_POST["destek_konu"]);
            $destek_konu_tarihi = date('Y-m-d H.i:s');
            $destek_konu_kategori = trim($_POST["destek_konu_kategori"]);
            $destek_konu_onem = trim($_POST["destek_konu_onem"]);
            $destek_konu_aciklama = trim($_POST["destek_konu_aciklama"]);

            
            
            $dizin = 'uploadsdestek/';
            $yuklenecek_dosya = $dizin . basename($_FILES['destek_konu_dosya']['name']);
            $destek_konu_dosya = basename($_FILES['destek_konu_dosya']['name']);
            if (move_uploaded_file($_FILES['destek_konu_dosya']['tmp_name'], $yuklenecek_dosya)) {
              echo "Dosya geçerli ve başarıyla yüklendi.\n";
            } else {
              echo "Olası dosya yükleme saldırısı!\n";
            }

            
            if ( empty($destek_konu)  || empty($destek_konu_aciklama)  || empty($destek_konu_tarihi) || empty($destek_konu_kategori)  || empty($destek_konu_onem)  ) {
                echo '
                   <div class="alert alert-danger" role="alert">
                   Yıldızlı alanlar boş bırakılamaz.
                  </div>';
            } else {  
                $ekle = $db->prepare("INSERT INTO uye_destek (uye_id, uye_kadi, destek_konu, destek_konu_aciklama, destek_konu_tarihi, destek_konu_kategori, destek_konu_onem, destek_konu_dosya ) VALUES (?,?,?,?,?,?,?,?)");
                $ekle->execute(array($_SESSION["id"], $_SESSION["uye"], $destek_konu, $destek_konu_aciklama, $destek_konu_tarihi, $destek_konu_kategori, $destek_konu_onem, $destek_konu_dosya));
            }


            if ($ekle) {
                echo '
                       <div class="alert alert-success" role="alert">
                       Destek Oluştruldu En Kısa Sürede Geri Dönüş Yapılacaktır
                       </div>';
                       header("Location:?adminsayfa=admindestek");
                       
            } else {
                echo '
                       <div class="alert alert-danger" role="alert">
                      başarısız. Bir sorun oluştu.
                       </div>';
            }
        }

        ?>




            <div class="row">
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->
            <div class="col-lg-2" ></div>
                <!-- COL-8 İ ORTALAMAK İÇİN YAPTIM -->

                <div class="chart-box">
   

 <div style=" width: 100%;"> <h4 class="m-bot-2" style="text-align: center;">Açılan Destekler</h4> </div>
 <hr>



            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Kullanıcı</th>
                    <th scope="col">Konu</th>
                    <th scope="col">Konu Tarihi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Önem</th>
                    <th scope="col">Durum</th>
                    <th scope="col">Sil</th>


                </tr>
                </thead>
                <tbody>
                <?php


$limit = 5;
$query = "SELECT count(*) FROM uye_destek WHERE id";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;

                $uyeler = $db -> prepare("SELECT * FROM uye_destek ORDER BY id DESC LIMIT $starting_limit,$limit");
                $uyeler->execute(array($_SESSION["id"]));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>

                        <td> <?php echo $uye["uye_kadi"];?></td>
                        <td> <a href="?adminsayfa=admindestekcevap&id=<?php echo $uye['id']?>"> <?php echo $uye['destek_konu'];?></a></td>
                        <td><?php echo $uye['destek_konu_tarihi'];?></td>
                        <td><?php echo $uye['destek_konu_kategori'];?></td>
                        <td><?php echo $uye['destek_konu_onem'];?></td>
                      <td class="text-danger" ><?php if($uye['destek_konu_durum'] == 1){ echo "Çözüldü";} elseif ($uye['destek_konu_durum']== 2) { echo "Cevaplandı";}else{echo "Cevap Bekliyor";}?></td>
                        <td>
                        <a href="?adminsayfa=admindestekduzenle&id=<?php echo $uye['id']?>">[ Düzenle ]</a>
    
                        <a onclick="return confirm('Veri silinecek Onaylıyormusunuz')" href="?adminsayfa=admindestek&core=sil&id=<?php echo $uye['id']?>">[ Sil ]</a>
                    </td>


                       



                    </tr>
                <?php } 
                ?>
                </tbody>
            </table>
            <?php

$ileri = $_GET['page'];
$ilerigit = $ileri+1;

if ($ileri < $total_pages )
{}
else {
  $ilerigit = $ileri +0;
}

$geri = $_GET['page'];
$gerigit = $geri - 1 ;
if ($geri > 1 )
{}
else {
  $gerigit = $geri -0;

}
?>
       <div class="pagination skew-25"> <ul>
         <?php 
         if($total_pages == 0){}
         else {         ?>

          <li><a class="skew25" href="<?php echo "index.php?adminsayfa=admindestek&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=admindestek&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=admindestek&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>

          </div> 
            
            
            </div>
                        
          </div>

