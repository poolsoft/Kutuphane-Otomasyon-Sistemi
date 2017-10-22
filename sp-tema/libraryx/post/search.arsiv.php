<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q)){
		$query = $s->query("SELECT * FROM arsivler WHERE arsiv_ad LIKE '%".$q."%' ORDER BY id DESC LIMIT 80");
		while($a = mysqli_fetch_assoc($query)){	
			$aid = $a["id"];
			$ad = $a["arsiv_ad"];
			$quer = $s->query("SELECT teslim_verim_tarihi FROM teslimler_arsiv WHERE arsiv_id='$aid'");
			$tarihler = array();
			while($alis = mysqli_fetch_assoc($quer)){
				array_push($tarihler, (int)$alis["teslim_verim_tarihi"]);
			}
			$en_son_tarih = max($tarihler);
			$en_ilk_tarih = min($tarihler);
			$tarih_1 = $s->tr_dateTime($en_ilk_tarih,false);
			$tarih_2 = $s->tr_dateTime($en_son_tarih,false);
			$gun_araligi = $tarih_1." - ".$tarih_2;
			$tarih = $a["arsiv_olusturma_tarihi"];
			$gun = $s->tr_dateTime($tarih);
		?>
		<li>
			<div class="left">
				<img class="kivrim" style="height:60px;width:60px" src="<?php echo TEMA_URL; ?>/images/arsiv.png">
			</div>
			<div class="right">
				<div class="oneinf"><?php echo htmlspecialchars($ad); ?></div>
				<div class="oneinf"><span>(<?php echo $gun_araligi; ?>)</span><br><a href="<?php echo TEMA_URL; ?>/get/get.arsivler.php?id=<?php echo $aid; ?>" target="_blank" style="margin-top:10px"><i class="fa fa-share-square-o" aria-hidden="true"></i> Arşivi Görüntüle</a> <a href="<?php echo URL; ?>/?sayfa=arsiv-duzenle&arsiv=<?php echo $aid; ?>" style="margin-top:10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a> &nbsp;&nbsp; <a target="_blank" href="<?php echo TEMA_URL; ?>/get/download.arsivler.php?id=<?php echo $aid; ?>" style="margin-top:10px"><i class="fa fa-download" aria-hidden="true"></i> İndir</a></div>
			</div>
		</li>
		<?php } //while bitiş

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>