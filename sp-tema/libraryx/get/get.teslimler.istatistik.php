<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
  $siniflar = array();
  $cek_siniflar_q = $s->query("SELECT ogrenci_sinif FROM ogrenciler");
  while($ccc = mysqli_fetch_assoc($cek_siniflar_q)){
    if(!in_array($ccc["ogrenci_sinif"], $siniflar)){
      array_push($siniflar, $ccc["ogrenci_sinif"]);
    }else{
      continue;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Teslim İstatistikleri</title>
  <meta name="author" content="seckinpoyraz.com" />

  <!-- icon -->
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMA_URL; ?>/images/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMA_URL; ?>/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMA_URL; ?>/images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMA_URL; ?>/images/favicon-16x16.png">
	<style type="text/css">
  body{text-align:center;}
table{margin:15px auto}
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
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:middle}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:middle}
@media print  
{
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
}
</style>
</head>

<body>

<h1>Teslim İstatistikleri</h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>

<hr />

<table class="tg" style="undefined;table-layout: fixed; width: 830px">
<colgroup>
<col style="width: 155px">
<col style="width: 163px">
<col style="width: 100px">
<col style="width: 100px">
<col style="width: 125px">
<col style="width: 125px">
<col style="width: 125px">
</colgroup>
  <tr>
    <th class="tg-amwm">SINIF</th>
    <th class="tg-amwm">TOPLAM TESLİM</th>
    <th class="tg-amwm">KIZ</th>
    <th class="tg-amwm">ERKEK</th>
    <th class="tg-amwm">KIZ YÜZDE</th>
    <th class="tg-amwm">ERKEK YÜZDE</th>
    <th class="tg-amwm">SINIF YÜZDE</th>
  </tr>

  <?php
  $toplam_teslim = $s->query("SELECT teslim_id FROM teslimler")->num_rows;
  $kitap_alan_erkek = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE LOWER(a.ogrenci_cinsiyet) = 'erkek'")->num_rows;
  $kitap_alan_kiz = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE LOWER(a.ogrenci_cinsiyet) = 'kız'")->num_rows;
  if($toplam_teslim==0){
    $erkek_yuzde = 0;
    $kiz_yuzde = 0;
  }else{
    $erkek_bol = $kitap_alan_erkek/$toplam_teslim;
    $erkek_yuzde = round($erkek_bol*100);
    $kiz_bol = $kitap_alan_kiz/$toplam_teslim;
    $kiz_yuzde = round($kiz_bol*100);
  }
  ?>
  <tr>
    <td class="tg-baqh">TÜM SINIFLAR</td>
    <td class="tg-baqh"><?php echo $toplam_teslim; ?></td>
    <td class="tg-baqh"><?php echo $kitap_alan_kiz; ?></td>
    <td class="tg-baqh"><?php echo $kitap_alan_erkek; ?></td>
    <td class="tg-baqh">%<?php echo $kiz_yuzde; ?></td>
    <td class="tg-baqh">%<?php echo $erkek_yuzde; ?></td>
    <td class="tg-baqh">%100</td>
  </tr>
  <?php
    foreach ($siniflar as $sinif){
      $kitap_alan = $s->query("SELECT p.teslim_alan_no, a.ogrenci_no, a.ogrenci_cinsiyet, a.ogrenci_sinif FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE a.ogrenci_sinif = '$sinif'")->num_rows;
      $kitap_alan_kiz = $s->query("SELECT p.teslim_alan_no, a.ogrenci_no, a.ogrenci_cinsiyet, a.ogrenci_sinif FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE a.ogrenci_sinif = '$sinif' && LOWER(a.ogrenci_cinsiyet)='kız'")->num_rows;
      $kitap_alan_erkek = $s->query("SELECT p.teslim_alan_no, a.ogrenci_no, a.ogrenci_cinsiyet, a.ogrenci_sinif FROM teslimler AS p
JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
WHERE a.ogrenci_sinif = '$sinif' && LOWER(a.ogrenci_cinsiyet)='erkek'")->num_rows;  
      if($kitap_alan==0){
        $kitap_alan_erkek_yuzde = 0;
        $kitap_alan_kiz_yuzde = 0;
        $yuzde_bol = 0;
      }else{
        $yuzde_bol_kiz = $kitap_alan_kiz/$kitap_alan;
        $kitap_alan_kiz_yuzde = round($yuzde_bol_kiz*100);
        $yuzde_bol_erkek = $kitap_alan_erkek/$kitap_alan;
        $kitap_alan_erkek_yuzde = round($yuzde_bol_erkek*100);
        $yuzde_bol = $kitap_alan/$toplam_teslim;
      }
      if($toplam_teslim==0){
        $sinif_yuzde = 0;
      }else{
        $sinif_yuzde = round($yuzde_bol*100);
      }
      ?>
      <tr>
        <td class="tg-baqh"><?php echo htmlspecialchars($sinif); ?></td>
        <td class="tg-baqh"><?php echo $kitap_alan; ?></td>
        <td class="tg-baqh"><?php echo $kitap_alan_kiz; ?></td>
        <td class="tg-baqh"><?php echo $kitap_alan_erkek; ?></td>
        <td class="tg-baqh">%<?php echo $kitap_alan_kiz_yuzde; ?></td>
        <td class="tg-baqh">%<?php echo $kitap_alan_erkek_yuzde; ?></td>
        <td class="tg-baqh">%<?php echo $sinif_yuzde; ?></td>
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