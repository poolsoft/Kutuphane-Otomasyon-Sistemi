<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta charset="UTF-8">
	<meta name="robots" content="noindex,nofollow" />
	<title>Eserlerin Yerleri</title>
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

<h1>Eserlerin Kategorileri</h1>
<h3><?php echo $s->get_site("site_okul"); ?> <?php echo $s->get_site("site_isim"); ?></h3>

<hr />

<table class="tg" style="undefined;table-layout: fixed; width: 500px">
<colgroup>
<col style="width: 200px">
<col style="width: 300px">
</colgroup>
  <tr>
    <th class="tg-amwm">KATEGORİ</th>
    <th class="tg-amwm">ESER</th>
  </tr>
  <?php
		$eserler_cek = $s->query("SELECT eser_ad,eser_yazar,eser_yayinevi,eser_isbn,eser_cat FROM eserler ORDER BY eser_cat DESC, eser_ad");
		while($b = mysqli_fetch_assoc($eserler_cek)){
			$eser_ad = $b["eser_ad"];
			$eser_yazar = $b["eser_yazar"];
      $eser_yayinevi = $b["eser_yayinevi"];
			$eser_isbn = $b["eser_isbn"];
      $eser_cat = $b["eser_cat"];
      if($eser_cat==0){
        $cat_ad = "Diğer";
      }else{
        $cat_ad = $s->cat($eser_cat,"cat_ad");
      }
  ?>
  <tr>
    <td class="tg-baqh" style="font-size:18px;vertical-align:middle"><b><?php echo htmlspecialchars($cat_ad); ?></b></td>
    <td class="tg-baqh"><b><?php echo htmlspecialchars($eser_ad); ?></b>
    	<br>
    	<i><?php echo htmlspecialchars($eser_yazar); ?></i>
      <br>
      <i><?php echo htmlspecialchars($eser_yayinevi); ?></i>
    	<br>
    	(ISBN: <?php echo htmlspecialchars($eser_isbn); ?>)
    </td>
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