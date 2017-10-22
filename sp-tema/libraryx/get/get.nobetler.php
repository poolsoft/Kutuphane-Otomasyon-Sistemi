<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
  $id = $s->g("id");
  $nobet_ay = $s->nobet_aylik($id,"nobet_ay");
  $nobet_ay_yazi = $s->tr_Ay($nobet_ay);
  $nobet_yil = $s->nobet_aylik($id,"nobet_yil");
  $nobet_baslik = $nobet_ay_yazi." ".$nobet_yil;
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Nöbetçi Kayıtları</title>
  <meta name="author" content="seckinpoyraz.com" />

  <!-- icon -->
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMA_URL; ?>/images/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMA_URL; ?>/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMA_URL; ?>/images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMA_URL; ?>/images/favicon-16x16.png">
	<style type="text/css">
  body{text-align:center;}
table{margin:15px auto}
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
  .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
  .tg .tg-baqh{text-align:center;vertical-align:middle}
  .tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:middle}
  h1{
    display: block;
    margin: 0;
    padding: 0;
    font-family:Arial, sans-serif;font-size:50px;font-weight:bolder;
  }
  h3{
    display: block;
    margin: 0;
    padding: 0;
    padding-bottom: 5px;
    font-family:Arial, sans-serif;font-size:16px;font-weight:normal;
  }
  @media print  
{
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
}
  </style>
</head>

<body>

<h1>Nöbetçi Kayıtları</h1>
<h1 style="font-size:35px;padding-bottom:10px"><?php echo $nobet_baslik; ?></h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>

<hr />

<table class="tg" style="undefined;table-layout: fixed; width: 502px">
<colgroup>
<col style="width: 251px">
<col style="width: 251px">
</colgroup>
  <tr>
    <th class="tg-amwm">NÖBETÇİ ADI</th>
    <th class="tg-amwm">NÖBETÇİ OLDUĞU TARİH</th>
  </tr>
  <?php
  $q = $s->query("SELECT * FROM nobetler_cizelge WHERE nobet_id='$id' ORDER BY nobet_gunu ASC");
  while($a = mysqli_fetch_assoc($q)){
    $nobetci_id_bir = $a["nobetci_id_bir"];
    if($nobetci_id_bir != 0){
      $break = "<br />";
      $ad1 = $s->kullanici($nobetci_id_bir,"uye_adsoyad");
    }else{
      $break = "";
      $ad1 = "";
    }
    
    $nobetci_id_iki = $a["nobetci_id_iki"];
    if($nobetci_id_iki != 0){
      $ad2 = $s->kullanici($nobetci_id_iki,"uye_adsoyad");
    }else{
      $ad2 = "";
    }

    $nobet_gunu = $a["nobet_gunu"];
    $nobet_ay_sifirli = $nobet_ay;
    if($nobet_ay<10){
      $nobet_ay_sifirli = "0$nobet_ay";
    }
    $ay_toplam_gun_sayisi = cal_days_in_month(CAL_GREGORIAN,(int)$nobet_ay,(int)$nobet_yil);
    $curday = "$nobet_gunu.$nobet_ay_sifirli.$nobet_yil";
    $curday_time = mktime(0,0,0,(int)$nobet_ay,$nobet_gunu,(int)$nobet_yil);
    $gun = $s->tr_dateTime($curday_time);


    $uye_sinif1 = $s->kullanici($nobetci_id_bir,"uye_sinif");
    $uye_no1 = $s->kullanici($nobetci_id_bir,"uye_okulno");
    if(!empty($uye_sinif1) || !empty($uye_no1)){
      $sinifi1 = " (".htmlspecialchars($uye_sinif1)."-".htmlspecialchars($uye_no1).")";
    }else{
      $sinifi1 = "";
    }

    $uye_sinif2 = $s->kullanici($nobetci_id_iki,"uye_sinif");
    $uye_no2 = $s->kullanici($nobetci_id_iki,"uye_okulno");
    if(!empty($uye_sinif2) || !empty($uye_no2)){
      $sinifi2 = " (".htmlspecialchars($uye_sinif2)."-".htmlspecialchars($uye_no2).")";
    }else{
      $sinifi2 = "";
    }
  ?>
  <tr>
    <td class="tg-baqh"><?php echo htmlspecialchars($ad1); ?><?php echo $sinifi1.$break; ?><?php echo htmlspecialchars($ad2); ?><?php echo $sinifi2; ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($gun); ?></td>
  </tr>
  <?php 
  }
  ?>
</table>
<br />
<div style="font-weight:bold;font-family:Arial,sans-serif;font-size:14px"><p>&copy; <?php echo $s->get_site("site_okul"); ?>.<br>by Seçkin Poyraz.</p></div>
<br />

</body>
</html>
<?php } ?>