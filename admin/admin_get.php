<?php
    if(!$_GET){
        include 'pages_admin/anasayfa.php';
    }else{
        switch($_GET["adminsayfa"]){
            // case alanında url yolu tanımlanır, include sayfa yeri gösterilir.
           
            case 'anasayfa': include 'pages_admin/anasayfa.php';break;
            case 'adminbankahesaplari': include 'pages_admin/admin_bankahesaplari.php';break;
            case 'adminbankahesapduzenle':include 'pages_admin/duzenle/admin_bankahesapduzenle.php';break;
            case 'adminbankahesapsil':include 'pages_admin/duzenle/admin_bankahesaplari_sil.php';break;
            case 'adminparacekme':include 'pages_admin/admin_paracekme.php';break;
            case 'adminbakiye':include 'pages_admin/admin_bakiye.php';break;
            case 'adminparacekmeduzenle':include 'pages_admin/duzenle/admin_paracekme_duzenle.php';break;
            case 'adminbakiyeduzenle':include 'pages_admin/duzenle/admin_bakiye_duzenleme.php';break;
            case 'adminhesapayarlariduzenle':include 'pages_admin/duzenle/admin_hesapayarlari_duzenle.php';break;
            case 'adminhesapayarlari':include 'pages_admin/admin_hesapayarlari.php';break;
            case 'admin_hesapayarlari_sil':include 'pages_admin/duzenle/admin_hesapayarlari_sil.php';break;
            case 'admindestek':include 'pages_admin/admin_destek.php';break;
            case 'admindestekcevap':include 'pages_admin/admin_destekcevap.php';break;
            case 'admindestekduzenle':include 'pages_admin/duzenle/admin_destek_duzenle.php';break;
            case 'admindekontduzenle':include 'pages_admin/duzenle/admin_dekont_duzenle.php';break;
            case 'adminkimlikduzenle':include 'pages_admin/duzenle/admin_kimlik_duzenle.php';break;
            case 'adminehliyetduzenle':include 'pages_admin/duzenle/admin_ehliyet_duzenle.php';break;
            case 'adminikametgahduzenle':include 'pages_admin/duzenle/admin_ikametgah_duzenle.php';break;




            
            default:include 'pages_admin/anasayfa.php';break;
        }
    }
?>