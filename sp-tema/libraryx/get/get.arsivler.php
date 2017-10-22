<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
  $id = $s->g("id");
  $y = mysqli_fetch_array($s->query("SELECT * FROM arsivler WHERE id='$id'"));
  $baslik = $y["arsiv_ad"];
  $nezamanolusturuldu = $y["arsiv_olusturma_tarihi"];
  $q = $s->query("SELECT * FROM teslimler_arsiv WHERE arsiv_id='$id' ORDER BY teslim_verim_tarihi DESC");
  $quer = $s->query("SELECT teslim_verim_tarihi FROM teslimler_arsiv WHERE arsiv_id='$id'");
  $tarihler = array();
  while($alis = mysqli_fetch_assoc($quer)){
    array_push($tarihler, (int)$alis["teslim_verim_tarihi"]);
  }
  $en_son_tarih = max($tarihler);
  $en_ilk_tarih = min($tarihler);
  $tarih_1 = $s->tr_dateTime($en_ilk_tarih,false);
  $tarih_2 = $s->tr_dateTime($en_son_tarih,false);
  $gun_araligi = $tarih_1." - ".$tarih_2;
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Arşivler</title>
  <meta name="author" content="seckinpoyraz.com" />

  <!-- icon -->
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo TEMA_URL; ?>/images/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo TEMA_URL; ?>/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo TEMA_URL; ?>/images/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo TEMA_URL; ?>/images/favicon-16x16.png">
	<style type="text/css">
  body{text-align:center;}
table{margin:15px auto;}
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:middle}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:middle}
h1{
	display: block;
	margin: 0;
	padding: 0;
	font-family:Arial, sans-serif;font-size:32px;font-weight:bolder;
  text-align: center;
  padding-bottom: 5px;
}
h3{
	display: block;
	margin: 0;
	padding: 0;
	font-family:Arial, sans-serif;font-size:16px;font-weight:normal;
  text-align: center;
  padding-bottom: 5px;
}
@media print{
  .yazdirparcala{
    page-break-after: always;
    page-break-inside: avoid;
  }
}
</style>
</head>

<body>
<div class="yazdirparcala">
<h1><?php echo $baslik; ?></h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>
<h3><b><?php echo $gun_araligi; ?></b></h3>
<h3><i>Bu arşiv, <?php echo $s->tr_dateTime($nezamanolusturuldu); ?> tarihinde oluşturuldu.</i></h3>
<hr />
<table class="tg" style="undefined;table-layout: fixed; width: 802px">
<colgroup>
<col style="width: 185px">
<col style="width: 175px">
<col style="width: 115px">
<col style="width: 130px">
<col style="width: 130px">
<col style="width: 130px">
<col style="width: 200px">
</colgroup>
  <tr>
    <th class="tg-amwm">ESER</th>
    <th class="tg-amwm">TESLİM ALAN KİŞİ</th>
    <th class="tg-amwm">TESLİM EDEN ÜYE</th>
    <th class="tg-amwm">TESLİM EDİLDİĞİ TARİH</th>
    <th class="tg-amwm">İADE EDİLECEK TARİH</th>
    <th class="tg-amwm">İADE EDİLDİĞİ TARİH &amp; ÜYE</th>
    <th class="tg-amwm">NOT</th>
  </tr>
  <?php
  while($a = mysqli_fetch_assoc($q)){
  	$eser_ad = $a["eser_ad"];
  	$eser_yazar = $a["eser_yazar"];
  	$eser_isbn = $a["eser_isbn"];
    $eser_yayinevi = $a["eser_yayinevi"];
  	$teslim_alan_no = $a["teslim_alan_no"];
    $teslim_alan = $a["teslim_alan_ad"];
    $teslim_alan_sinif = $a["teslim_alan_sinif"];
    $teslim_alan_cinsiyet = $a["teslim_alan_cinsiyet"];

  	$teslim_veren_isim = $a["teslim_veren_ad"];
  	$teslim_veren_sinif = $a["teslim_veren_sinif"];
  	$teslim_veren_no = $a["teslim_veren_no"];

  	$teslim_verim_tarihi = $a["teslim_verim_tarihi"];
  	$teslim_alim_tarihi = $a["teslim_alim_tarihi"];
  	$teslim_alindi_tarih = $a["teslim_alindi_tarih"];
    $iade_alan = $a["teslim_alindi_ad"];
    $iade_alan_sinif = $a["teslim_alindi_sinif"];
    $iade_alan_no = $a["teslim_alindi_no"];

  	$teslim_durumu = $a["teslim_alindi_mi"];

    $teslim_not = $a["teslim_not"];

  	$kac_gun = floor(((int)$teslim_alim_tarihi-(int)$teslim_verim_tarihi) / (60*60*24));

    $kalan_zaman = floor(((int)$teslim_alim_tarihi-(int)$teslim_alindi_tarih) / (60*60*24))+1;
              
    if($kalan_zaman > 0){
      $kalan_zamannx = '<span>('.$kalan_zaman.' gün erken)</span>';
    }elseif($kalan_zaman==0){
      $kalan_zamannx = '<span>(Gününde)</span>';
    }else{
      $kalan_zamannx = '<span>('.(-1)*$kalan_zaman.' gün geç)</span>';
    }

    $gunumuz = time();
    $kalan_zamano = floor(((int)$teslim_alim_tarihi-(int)$gunumuz) / (60*60*24))+1;
              
    if($kalan_zamano > 0){
      $ne_kadar_kaldi = '<span>('.$kalan_zamano.' gün kaldı)</span>';
    }elseif($kalan_zamano==0){
      $ne_kadar_kaldi = '<span>(Bugün teslim)</span>';
    }else{
      $ne_kadar_kaldi = '<span>('.(-1)*$kalan_zamano.' gün geçti)</span>';
    }
  ?>
  <tr>
    <td class="tg-baqh"><b><?php echo htmlspecialchars($eser_ad); ?></b><br><i><?php echo htmlspecialchars($eser_yazar); ?></i><br><br><?php echo htmlspecialchars($eser_yayinevi); ?><br>(ISBN: <?php echo htmlspecialchars($eser_isbn); ?>)</td>
    <td class="tg-baqh"><?php echo htmlspecialchars($teslim_alan); ?>
    	<?php if(!empty($teslim_alan_sinif) || !empty($teslim_alan_no)){ ?>
    	<br><?php echo htmlspecialchars($teslim_alan_sinif); ?> - <?php echo htmlspecialchars($teslim_alan_no); ?> - <?php echo htmlspecialchars($teslim_alan_cinsiyet); ?>
    	<?php } ?>
    </td>
    <td class="tg-baqh"><?php echo htmlspecialchars($teslim_veren_isim); ?>
    	<?php if(!empty($teslim_veren_sinif) || !empty($teslim_veren_no)){ ?>
    	<br><?php echo htmlspecialchars($teslim_veren_sinif); ?> - <?php echo htmlspecialchars($teslim_veren_no); ?>
    	<?php } ?>
    </td>
    <td class="tg-baqh"><?php echo $s->tr_dateTime($teslim_verim_tarihi); ?></td>
    <td class="tg-baqh"><?php echo $s->tr_dateTime($teslim_alim_tarihi); ?><br>(<?php echo $kac_gun; ?> günlük)</td>
    <td class="tg-baqh">
    <?php if($teslim_durumu=="1"){ ?>
    	<b><?php echo $s->tr_dateTime($teslim_alindi_tarih); ?></b><br>
      <i><?php echo htmlspecialchars($iade_alan); ?></i>
      <?php if(!empty($iade_alan_sinif) || !empty($iade_alan_no)){ ?>
      <br><i style="font-size:12px"><?php echo htmlspecialchars($iade_alan_sinif); ?> - <?php echo htmlspecialchars($iade_alan_no); ?></i>
      <?php } ?>
      <br><i style="font-size:12px"><?php echo $kalan_zamannx; ?></i>
    <?php }else{ ?>
    	<i><b>İade edilmedi</b></i>
    <?php } ?>
    <td class="tg-baqh"><?php echo htmlspecialchars($teslim_not); ?></td>
    	
    </td>
  </tr>
  <?php }//endwhile ?>
</table>
</div><!-- .yazdirparcala -->

<div class="yazdirparcala">

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
  $toplam_teslim = $s->query("SELECT id FROM teslimler_arsiv WHERE arsiv_id='$id'")->num_rows;
  $kitap_alan_erkek = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet) = 'erkek' && arsiv_id='$id'")->num_rows;
  $kitap_alan_kiz = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet) = 'kız' && arsiv_id='$id'")->num_rows;
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
  $siniflar = array();
  $siniflar_cek = $s->query("SELECT * FROM arsivler WHERE id='$id'");
  while($xyz = mysqli_fetch_assoc($siniflar_cek)){
    $arsiv_siniflar = $xyz["arsiv_siniflar"];
    $parcala = explode(",",$arsiv_siniflar);
    foreach($parcala as $parca){
      array_push($siniflar,$parca);
    }
  }
  foreach ($siniflar as $sinif){
        $parcala = explode("-",$sinif);
        $sinifimiz = $parcala[0];
        $sinif_kiz = $parcala[1];
        $sinif_erkek = $parcala[2];
        $sinif_toplam = (int)$sinif_kiz+(int)$sinif_erkek;
        $kitap_alan_kiz = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet)='kız' && teslim_alan_sinif='$sinifimiz' && arsiv_id='$id'")->num_rows;
        $kitap_alan_erkek = $s->query("SELECT * FROM teslimler_arsiv WHERE LOWER(teslim_alan_cinsiyet)='erkek' && teslim_alan_sinif='$sinifimiz' && arsiv_id='$id'")->num_rows;
        $kitap_alan = (int)$kitap_alan_kiz+(int)$kitap_alan_erkek;
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
            $sinif_yuzde  = 0;
          }else{
            $sinif_yuzde = round($yuzde_bol*100);
          }
    ?>
      <tr>
        <td class="tg-baqh"><?php echo htmlspecialchars($sinifimiz); ?></td>
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
</div><!-- .yazdirparcala -->
</body>
</html>
<?php } ?>