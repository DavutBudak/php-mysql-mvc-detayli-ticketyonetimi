
<?php
$id = $_SESSION["id"];
$uye_getir_talep = $db->prepare("SELECT * FROM uye_yatirim WHERE uye_id");
$uye_getir_talep->execute(array($id));
if ($uye_getir_talep) {
    $uye = $uye_getir_talep->fetch(PDO::FETCH_OBJ);
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Para Yatırma</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i> Para Yatırma</a></li>
        </ol>
    </section>
    <center>



        <!-- Main content -->
      
            <div class="row">

            <div class="col-lg-12" >
                <div class="chart-box">


                <h3>  İşlem Geçmişi </h3>
<hr>
                <table class="table" >
                <thead class="thead-light">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Ad Soyad</th>
                    <th scope="col" >Banka Adı</th>
                    <th scope="col" >Miktar</th>
                    <th scope="col" >Döviz Cinsi</th>
                    <th scope="col">Talep Tarihi</th>
                    <th scope="col" >Onay Durumu</th>
                    <th scope="col" style="text-align:center;">Not</th>
                    <th scope="col" >Duzenle</th>


                    




                </tr>
                </thead>
                <tbody>
                <?php

              
$limit = 5;
$query = "SELECT count(*) FROM uye_yatirim WHERE id";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;

$uyeler = $db -> prepare("SELECT * FROM uye_yatirim WHERE uye_id = ? ORDER BY id Desc LIMIT $starting_limit,$limit");
                $uyeler->execute(array($id));
                $uye_sonuc=$uyeler->fetchAll();
                foreach ($uye_sonuc as $uye) { ?>
                    <tr>
                    <td><?php echo $uye['uye_id'];?></td>
                    <td><?php echo $uye['uye_ad'];?> <?php echo $uye['uye_soyad'];?></td>
                        <td><?php echo $uye['uye_yatirim_banka_adi'];?></td>
                        <td class="text-success"><?php echo $uye['uye_yatirim_miktar'];?> <?php if($uye['uye_yatirim_doviz_cinsi'] == 'TRY'){ echo " ₺";} elseif ($uye['uye_yatirim_doviz_cinsi']== 'USD') { echo " $";}elseif ($uye['uye_yatirim_doviz_cinsi']== 'EUR') { echo " €";}     elseif ($uye['uye_yatirim_doviz_cinsi']== 'KRİPTO') { echo " ₿";} ?></td>
                        <td><?php echo $uye['uye_yatirim_doviz_cinsi'];?></td>
                        <td><?php echo $uye['uye_yatirim_tarih'];?></td>
                        <td class="text-danger"><?php if($uye['uye_yatirim_onay'] == 1){ echo "Onaylandı";} elseif ($uye['uye_yatirim_onay']== 2) { echo "Onaylanmadı";}else{echo "Onay Bekleniyor";}?></td>
                        <td style="color:red;"><?php echo $uye['uye_yatirim_not'];?></td>
                        <td><a href="?adminsayfa=adminbakiyeduzenle&id=<?php echo $uye['id']?>">[ Düzenle ]</a></td>
                        



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

          <li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbakiye&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbakiye&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}
 
                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminbakiye&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>
                </div>

            </div>
       

          


              
