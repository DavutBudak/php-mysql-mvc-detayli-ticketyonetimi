<?php
    $id = $_SESSION["id"];
    $uye_getir = $db->prepare("SELECT * FROM uye_bilgileri WHERE uye_id = ?");
    $uye_getir->execute(array($id));
    if ($uye_getir) {
      $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
    }
    ?>

<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Anasayfa </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Anasayfa</a></li> 
      </ol>
    </section>

<script type="text/javascript">
   $(document).ready(function() {
    $('#loading').fadeOut(7000);
}) 
</script> 

   

<style>  #loading { 
 position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items:center;
  justify-content:center;
  background-color: #fff;
  z-index: 999
} </style>

<div class="chart-box"> 

<div id="loading">
  <img src="assets/dist/img/1480.gif" alt="Yükleniyor..." />
</div> 


    <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <div class="tradingview-widget-copyright"><a href="https://tr.tradingview.com/markets/currencies/economic-calendar/" rel="noopener" target="_blank"><span class="blue-text">Ekonomik Takvim</span></a> TradingView'den</div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
  {
  "colorTheme": "light",
  "isTransparent": false,
  "width": "100%",
  "height": "600",
  "locale": "tr",
  "importanceFilter": "0,1",
  "currencyFilter": "TRL"
}
  </script>
</div>
<!-- TradingView Widget END -->


  
  </div>
  </div>