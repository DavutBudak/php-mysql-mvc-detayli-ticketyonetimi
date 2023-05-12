

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Para Çek</h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li>
            <li class="active"><i class="fa fa-bullseye"></i> Menü</li>
            <li><a href=""><i class="fa fa-home"></i>Banka Hesabı Sil</a></li>
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
                $id = $_GET["id"];
            $uye_getir = $db->prepare("SELECT * FROM uye_banka_hesaplari WHERE idyeni = ?");
            $uye_getir->execute(array($id));
            if ($uye_getir->rowCount()) {

                $uye_sil = $db->prepare("DELETE FROM uye_banka_hesaplari WHERE idyeni = ?");
                $uye_sil->execute(array($id));
                if ($uye_sil->rowCount()) {
                    echo '
                    <div class="alert alert-success" role="alert">
                    Üye silindi.
                    </div>';
                    header("Location:?adminsayfa=adminbankahesaplari");
                } else {
                    echo '    
                    <div class="alert alert-danger" role="alert">
                    Üye silme başarısız. Bir sorun oluştu.
                    </div>';
                }

            } else {
                header("Location:?adminsayfa=adminbankahesaplari");
            }

            ?>
    


                </div>
            </div>
