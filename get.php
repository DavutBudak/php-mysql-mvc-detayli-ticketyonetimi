<?php
    if(!$_GET){
        include 'pages/anasayfa.php';
    }else{
        switch($_GET["sayfa"]){
            // case alanında url yolu tanımlanır, include sayfa yeri gösterilir.
            case 'anasayfa': include 'pages/anasayfa.php';break;
            case 'bankahesaplari':include 'pages/bankahesaplari.php';break;
            case 'bankahesapduzenle':include 'pages/duzenle/bankahesapduzenle.php';break;
            case 'profilbilgileri':include 'pages/profilbilgileri.php';break;
            case 'dekontyukle':include 'pages/dosya_dekont.php';break;
            case 'dekontduzenle':include 'pages/duzenle/dekont_dosya_duzenle.php';break;
            case 'dosyayukle':include 'pages/dosya_yukle.php';break;
            case 'kimlikduzenle':include 'pages/duzenle/kimlik_dosya_duzenle.php';break;
            case 'ehliyetduzenle':include 'pages/duzenle/ehliyet_dosya_duzenle.php';break;
            case 'ikametgahduzenle':include 'pages/duzenle/ikametgah_dosya_duzenle.php';break;
            case 'hesapbilgileri':include 'pages/hesapbilgileri.php';break;
            case 'paracekme':include 'pages/paracekme.php';break;
            case 'destek':include 'pages/destek.php';break;
            case 'destekduzenle':include 'pages/duzenle/destekduzenle.php';break;
            case 'destekcevap':include 'pages/duzenle/destekcevap.php';break;
            case 'bakiye':include 'pages/bakiye.php';break;

            default:include 'pages/anasayfa.php';break;
        }
    }
?>