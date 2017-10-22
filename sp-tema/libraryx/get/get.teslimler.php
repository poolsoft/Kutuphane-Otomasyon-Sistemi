<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
	$action = $s->g("action");
  if($action=="iade-edilen"){
  	$q = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=1 ORDER BY teslim_verim_tarihi DESC");
  	$baslik = "İade Edilenler";
  }elseif($action=="iade-edilmeyen"){
  	$q = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=0 ORDER BY teslim_verim_tarihi DESC");
  	$baslik = "İade Edilmeyenler";
  }elseif($action=="iade-tarihi-gecen"){
    $tim = time();
    $q = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=0 && teslim_alim_tarihi<'$tim' ORDER BY teslim_verim_tarihi DESC");
    $baslik = "İade Tarihi Geçenler";
  }else{
  	$q = $s->query("SELECT * FROM teslimler ORDER BY teslim_verim_tarihi DESC");
  	$baslik = "Tüm Teslimler";
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Teslimler</title>
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
<h1><?php echo $baslik; ?></h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>
<hr />
<table class="tg" style="table-layout: fixed; width: 1020px">
<colgroup>
<col style="width: 185px">
<col style="width: 175px">
<col style="width: 175px">
<col style="width: 130px">
<col style="width: 120px">
<col style="width: 120px">
<col style="width: 140px">
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
  	$eserid = $a["eser_id"];
  	$eser_ad = $s->eser($eserid,"eser_ad");
  	$eser_yazar = $s->eser($eserid,"eser_yazar");
  	$eser_isbn = $s->eser($eserid,"eser_isbn");
  	$teslim_alan_no = $a["teslim_alan_no"];
    $teslim_alan = $s->ogrencino($teslim_alan_no,"ogrenci_ad");
    $teslim_alan_sinif = $s->ogrencino($teslim_alan_no,"ogrenci_sinif");
  	$teslim_veren_id = $a["teslim_veren"];

  	$teslim_veren_isim = $s->kullanici($teslim_veren_id,"uye_adsoyad");
  	$teslim_veren_sinif = $s->kullanici($teslim_veren_id,"uye_sinif");
  	$teslim_veren_no = $s->kullanici($teslim_veren_id,"uye_okulno");

  	$teslim_verim_tarihi = $a["teslim_verim_tarihi"];
  	$teslim_alim_tarihi = $a["teslim_alim_tarihi"];
  	$teslim_alindi_tarih = $a["teslim_alindi_tarih"];
  	$teslim_alindi_kim_id = $a["teslim_alindi_kim"];
    $iade_alan = $s->kullanici($teslim_alindi_kim_id,"uye_adsoyad");
    $iade_alan_sinif = $s->kullanici($teslim_alindi_kim_id,"uye_sinif");
    $iade_alan_no = $s->kullanici($teslim_alindi_kim_id,"uye_okulno");

  	$teslim_durumu = $a["teslim_durumu"];

    $teslim_not = $a["teslim_not"];

  	$kac_gun = floor(((int)$teslim_alim_tarihi-(int)$teslim_verim_tarihi) / (60*60*24));

    $kalan_zaman = floor(((int)$teslim_alim_tarihi-(int)$teslim_alindi_tarih) / (60*60*24))+1;
              
    if($kalan_zaman > 0){
      $kalan_zamannx = '<span style="color:#08977E">('.$kalan_zaman.' gün erken)</span>';
    }elseif($kalan_zaman==0){
      $kalan_zamannx = '<span style="color:#08977E">(Gününde)</span>';
    }else{
      $kalan_zamannx = '<span style="color:#DE2C2C">('.(-1)*$kalan_zaman.' gün geç)</span>';
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
    <td class="tg-baqh"><b><?php echo htmlspecialchars($eser_ad); ?></b><br><i><?php echo htmlspecialchars($eser_yazar); ?></i><br>(ISBN: <?php echo htmlspecialchars($eser_isbn); ?>)</td>
    <td class="tg-baqh"><?php echo htmlspecialchars($teslim_alan); ?>
    	<?php if(!empty($teslim_alan_sinif) || !empty($teslim_alan_no)){ ?>
    	<br><?php echo htmlspecialchars($teslim_alan_sinif); ?> - <?php echo htmlspecialchars($teslim_alan_no); ?>
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
      <b><?php echo $kalan_zamannx; ?></b><br>
      <i><?php echo htmlspecialchars($iade_alan); ?></i>
      <?php if(!empty($iade_alan_sinif) || !empty($iade_alan_no)){ ?>
      <br><i style="font-size:12px"><?php echo htmlspecialchars($iade_alan_sinif); ?> - <?php echo htmlspecialchars($iade_alan_no); ?></i>
      <?php } ?>
    <?php }else{ ?>
    	<i><b>İade edilmedi</b></i><br><?php echo $ne_kadar_kaldi; ?>
    <?php } ?>
    <td class="tg-baqh"><?php echo htmlspecialchars($teslim_not); ?></td>
    	
    </td>
  </tr>
  <?php }//endwhile ?>
</table>
<br />
<div style="font-weight:bold;font-family:Arial,sans-serif;font-size:14px"><p>&copy; <?php echo $s->get_site("site_okul"); ?>.<br>by Seçkin Poyraz.</p></div>
<br />

</body>
</html>
<?php } ?>