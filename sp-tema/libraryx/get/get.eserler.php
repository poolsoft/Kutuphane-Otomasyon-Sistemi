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
	<title>Tüm Eserler</title>
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
	font-family:Arial, sans-serif;font-size:32px;font-weight:bolder;
  padding-bottom: 5px;
}
h3{
	display: block;
	margin: 0;
	padding: 0;
	font-family:Arial, sans-serif;font-size:16px;font-weight:normal;
  padding-bottom: 5px;
}
@media print  
{
    table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
}
</style>
</head>

<body>
<h1>Tüm Eserler</h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>
<hr />
<table class="tg" style="table-layout: fixed;width:1020px">
<colgroup>
<col style="width: 65px">
<col style="width: 120px">
<col style="width: 165px">
<col style="width: 135px">
<col style="width: 135px">
<col style="width: 100px">
<col style="width: 60px">
<col style="width: 150px">
<col style="width: 70px">
<col style="width: 65px">
</colgroup>
  <tr>
    <th class="tg-amwm">ESERİN YERİ</th>
    <th class="tg-amwm">ESER ISBN</th>
    <th class="tg-amwm">ESER ADI</th>
    <th class="tg-amwm">ESER YAZARI</th>
    <th class="tg-amwm">ESER YAYINEVİ</th>
    <th class="tg-amwm">ESER KATEGORİSİ</th>
    <th class="tg-amwm">ESER ADEDİ</th>
    <th class="tg-amwm">ESER NOT</th>
    <th class="tg-amwm">ESER SAYFA SAYISI</th>
    <th class="tg-amwm">ESER FİYAT</th>
  </tr>
  <?php
  $q = $s->query("SELECT * FROM eserler ORDER BY eser_cat DESC, eser_ad");
  while($a = mysqli_fetch_assoc($q)){
  	$eser_ad = $a["eser_ad"];
  	$eser_yazar = $a["eser_yazar"];
  	$eser_isbn = $a["eser_isbn"];
    $eser_yayinevi = $a["eser_yayinevi"];
    $eser_cat = $a["eser_cat"];
    $eser_adet = $a["eser_adet"];
    $eser_not = $a["eser_not"];
    $eser_yer = $a["eser_yer"];
    $eser_sayfa = $a["eser_sayfa"];
    $eser_fiyat = $a["eser_fiyat"];

    if($eser_cat==0){
      $eser_kategori = "Diğer";
    }else{
      $eser_kategori_c = mysqli_fetch_array($s->query("SELECT * FROM eserler_kategoriler WHERE cat_id='$eser_cat'"));
      $eser_kategori = $eser_kategori_c["cat_ad"];
    }

  ?>
  <tr>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_yer); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_isbn); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_ad); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_yazar); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_yayinevi); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_kategori); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_adet); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_not); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_sayfa); ?></td>
    <td class="tg-baqh"><?php echo htmlspecialchars($eser_fiyat); ?></td>
  </tr>
  <?php }//endwhile ?>
</table>

<br />
<div style="font-weight:bold;font-family:Arial,sans-serif;font-size:14px"><p>&copy; <?php echo $s->get_site("site_okul"); ?>.<br>by Seçkin Poyraz.</p></div>
<br />
</body>
</html>
<?php } ?>