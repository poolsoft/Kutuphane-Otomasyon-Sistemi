<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
  exit();
}else{
	$download = $s->g("download");
	if($download=="yes"){
		$link = TEMA_URL."/get/download.eserler.belirli.php";
	}else{
		$link = TEMA_URL."/get/get.eserler.belirli.php";
	}
?>
<form method="get" action="<?php echo $link; ?>" target="_blank" autocomplete="off">
	<div class="sol">Eser Yeri:</div> <div class="sag"><input type="text" name="yer" placeholder="Eserin yeri..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser ISBN:</div> <div class="sag"><input type="text" name="isbn" placeholder="Eserin ISBN kodu..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser Adı:</div> <div class="sag"><input type="text" name="ad" placeholder="Eserin adı(benzer)..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser Yazarı:</div> <div class="sag"><input type="text" name="yazar" placeholder="Eserin yazarı(benzer)..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser Yayınevi:</div> <div class="sag"><input type="text" name="yayinevi" placeholder="Eserin yayınevi(benzer)..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser Kategorisi:</div> <div class="sag"><select name="cat[]" multiple>
						<option value="all" selected="selected">Tümü</option>
			          	<?php
			          	$cat_cek = $s->query("SELECT * FROM eserler_kategoriler ORDER BY cat_ad ASC");
			          	while($c = mysqli_fetch_assoc($cat_cek)){
			          		$cat_id = $c["cat_id"];
			          		$cat_ad = $c["cat_ad"];
			          	?>
			          	<option value="<?php echo $cat_id; ?>"><?php echo $cat_ad; ?></option>
			          	<?php } ?>
			          	<option value="0">Diğer</option>
			          </select></div>
    <div style="clear:both;height:7px"></div>
	<div class="sol">Eser Adedi:</div> <div class="sag"><input type="number" name="adet" placeholder="Eserden kaç adet var..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">Eser Mevcut:</div> <div class="sag"><input type="number" name="mevcut" placeholder="Eserden şu anda ne kadar mevcut..."></div>
	<div style="clear:both;height:7px"></div>
	<div class="sol">&nbsp;</div> <div class="sag"><input type="submit" value="Listele"></div>
</form>

<style type="text/css">
	.sol{float:left;width:120px;}
	.sag{float:left;}
	input[type="text"],input[type="number"]{padding-left:5px;padding-right:5px;width:150%;box-sizing:border-box;}
</style>
<?php } ?>