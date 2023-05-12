
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Hesap Ayarları</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i>Hesaplar</a></li>
        </ol>
    </section>
    <center>
        <!-- Main content -->
      
            <div class="col-lg-12" >
                <div class="chart-box">
                       
                <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"> Kullanıcı Adı</th>
                    <th scope="col">Şifre</th>
                    <th scope="col">E-posta</th>
                    <th scope="col">Üye Yönetimi</th>
                </tr>
                </thead>
                <tbody>
                <?php

$limit = 5;
$query = "SELECT count(*) FROM uye_bilgileri WHERE uye_id";

$s = $db->query($query);
$total_results = $s->fetchColumn();
$total_pages = ceil($total_results/$limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else{
    $page = $_GET['page'];
}



$starting_limit = ($page-1)*$limit;


                $uyeler = $db -> query("SELECT * FROM uye_bilgileri ORDER BY uye_id DESC LIMIT $starting_limit,$limit", PDO::FETCH_OBJ);
                foreach ($uyeler as $uye) { ?>
                    <tr>
                        <th scope="row"><?php echo $uye->uye_id;?></th>
                        <td><?php echo $uye->uye_kadi;?></td>
                        <td><?php echo $uye->uye_sifre;?></td>
                        <td><?php echo $uye->uye_eposta;?></td>
                        <td>
                            <a href="?adminsayfa=adminhesapayarlariduzenle&id=<?php echo $uye->uye_id;?>">[ Düzenle ]</a>
                            <a onclick="return confirm('Veri silinecek Onaylıyormusunuz')" href="?adminsayfa=admin_hesapayarlari_sil&id=<?php echo $uye->uye_id;?>">[ Sil ]</a>


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

          <li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminhesapayarlari&page=$gerigit"; ?>"><i class="fa fa-angle-left"></i></a></li>

        <?php } ?>


<?php
            for ($page=1; $page <= $total_pages ; $page++):?>        

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminhesapayarlari&page=$page"; ?>"> <?php  echo $page; ?> </a></li>

              <?php endfor;  ?>

              <?php 
                       if($total_pages == 0){}

                       else {         ?>

<li><a class="skew25" href="<?php echo "index.php?adminsayfa=adminhesapayarlari&page=$ilerigit"; ?>" ><i class="fa fa-angle-right"></i></a></li>
              
                      <?php } ?>


           </ul></div>

          </div> 
            


            </div>
