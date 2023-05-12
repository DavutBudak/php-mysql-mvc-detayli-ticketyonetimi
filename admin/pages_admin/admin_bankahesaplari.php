<?php
$id = $_SESSION["id"];
$uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id");
$uye_getir->execute(array($id));
if ($uye_getir) {
    $uyegelen = $uye_getir->fetch(PDO::FETCH_OBJ);
}
?>

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Banka Hesapları</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li> 
        <li><i class="fa fa-home"></i> Menü</li> 
        <li><a href=""><i class="fa fa-home"></i> Banka Hesapları</a></li> 
      </ol>
    </section>
     
    <section class="content container-fluid">
      <div class="row">
      <div class="col-lg-12">
          <div class="chart-box">
            <div class="head-title">
              <h4 style="text-align: center;">Banka Hesapları</h4>
              <p class="text-center m-top-2">Banka Hesaplarını Bu Ekrandan Görüntüleyebilir Ve Güncelleyebilirsiniz</p>
            </div>           
      
            <table class="table">
                <thead class="thead-light">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Ad Soyad</th>
                    <th scope="col">Banka Adı</th>
                    <th scope="col">Döviz Cinsi</th>
                    <th scope="col">Şube Adı</th>
                    <th scope="col">Hesap No</th>
                    <th scope="col" >Iban No</th>
                    <th scope="col">Düzenle</th>

                </tr>
                </thead>
                <tbody>
                <?php

$limit = 5;
$query = "SELECT count(*) FROM uye_banka_hesaplari WHERE idyeni";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;

                $uyeler = $db -> prepare("SELECT * FROM uye_banka_hesaplari WHERE  idyeni ORDER BY idyeni DESC LIMIT $starting_limit,$limit");
                $uyeler->execute(array($_SESSION["id"]));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>
                    <td><?php echo $uye['uye_id'];?></td>
                    <td><?php echo $uye['uye_ad'];?> <?php echo $uye['uye_soyad'];?></td>
                        <td><?php echo $uye['uye_banka_adi'];?></td>
                        <td><?php echo $uye['uye_banka_doviz_cinsi'];?></td>
                        <td><?php echo $uye['uye_sube_adi'];?></td>
                        <td><?php echo $uye['uye_hesap_no'];?></td>
                        <td style="text-align: left;"><?php echo $uye['uye_iban'];?></td>
                        
                    
 
                    
                      <td><a href="?adminsayfa=adminbankahesapduzenle&id=<?php echo $uye['idyeni']?>">[Düzenle]</a>
                      <a onclick="return confirm('Veri silinecek Onaylıyormusunuz')" href="?adminsayfa=adminbankahesapsil&id=<?php echo $uye['idyeni']?>">[Sil]</a>
</td>


                    
                        



                    </tr>
                <?php } ?>
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

          <li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbankahesaplari&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbankahesaplari&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbankahesaplari&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>

    </section> 
</div>
  </div>

 


  