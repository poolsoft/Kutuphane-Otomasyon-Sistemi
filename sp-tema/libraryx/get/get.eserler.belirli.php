<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{

	$yer = $s->g("yer");
	$isbn = $s->g("isbn");
	$ad = $s->g("ad");
	$yazar = $s->g("yazar");
	$yayinevi = $s->g("yayinevi");
	$cats = $_GET["cat"];
	$adet = $s->g("adet");
	$mevcut = $s->g("mevcut");

	$tum_kategoriler = false;

	foreach ((array) $cats as $cat) {
		if($cat=="all"){
			$tum_kategoriler = true;
			break;
		}
	}

	if(!empty($yer)){
		$q_yer = "e.eser_yer='$yer'";
	}else{
		$q_yer = "1=1";
	}

	if(!empty($isbn)){
		$q_isbn = "REPLACE(e.eser_isbn, '-', '') LIKE '%".$isbn."%'";
	}else{
		$q_isbn = "1=1";
	}

	if(!empty($ad)){
		$q_ad = "e.eser_ad LIKE '%".$ad."%'";
	}else{
		$q_ad = "1=1";
	}

	if(!empty($yazar)){
		$q_yazar = "e.eser_yazar LIKE '%".$yazar."%'";
	}else{
		$q_yazar = "1=1";
	}

	if(!empty($yayinevi)){
		$q_yayinevi = "e.eser_yayinevi LIKE '%".$yayinevi."%'";
	}else{
		$q_yayinevi = "1=1";
	}

	if(!$tum_kategoriler){
		$sirala = "";
		$a = 1;
		$sayisi = count($cats);
		foreach ((array) $cats as $cat) {
			if($a==$sayisi){
				$sirala .= "e.eser_cat='$cat'";
			}else{
				$sirala .= "e.eser_cat='$cat' OR ";
			}
			$a++;
		}
		$q_cat = $sirala;
	}else{
		$q_cat = "1=1";
	}

	if(is_numeric($adet)){
		$q_adet = "e.eser_adet='$adet'";
	}else{
		$q_adet = "1=1";
	}

	if(is_numeric($mevcut) && (int)$mevcut>=0){
		$q_mevcut = true;
	}else{
		$q_mevcut = false;
	}

	$q_yer = "SELECT * FROM eserler AS e WHERE $q_yer && $q_isbn && $q_ad && $q_yazar && $q_yayinevi && $q_cat && $q_adet ORDER BY e.eser_cat DESC, e.eser_ad";

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Belirli Eserler</title>
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
<h1>Belirli Eserler</h1>
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
  $q = $s->query($q_yer);
  while($a = mysqli_fetch_assoc($q)){
  	$eser_id = $a["eser_id"];
  	$eser_ad = $a["eser_ad"];
  	$eser_yazar = $a["eser_yazar"];
  	$eser_isbn = $a["eser_isbn"];
    $eser_yayinevi = $a["eser_yayinevi"];
    $eser_cat = $a["eser_cat"];
    $eser_adet = $a["eser_adet"];
    $eser_not = $a["eser_not"];
    $eser_yer = $a["eser_yer"];
    $addet = $a["eser_adet"];
    $eser_sayfa = $a["eser_sayfa"];
    $eser_fiyat = $a["eser_fiyat"];

    if($q_mevcut){
  		$teslimdeki_adedi = $s->query("SELECT eser_id FROM teslimler WHERE eser_id='$eser_id' && teslim_durumu=0")->num_rows;
  		$mevcuteser = $addet-$teslimdeki_adedi;
  		if($mevcuteser!=(int)$mevcut){
  			continue;
  		}
  	}

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