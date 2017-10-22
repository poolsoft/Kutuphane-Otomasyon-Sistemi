<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q)){
		$query = $s->query("SELECT * FROM eserler WHERE eser_ad LIKE '%".$q."%' OR eser_yazar LIKE '%".$q."%' OR REPLACE(eser_isbn, '-', '') LIKE '%".$q."%' ORDER BY eser_ad ASC LIMIT 80");
		while($a = mysqli_fetch_assoc($query)){
							if( !empty($a["eser_foto"]) ){
								$eser_foto = URL."/uploads/eserler/".$a["eser_foto"];
							}else{
								$eser_foto = TEMA_URL."/images/nofoto.png";
							}
							if( $s->yetkisi_var("1",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
								$duzenle = '<div class="oneinf"><a href="?sayfa=eser-duzenle&eser='.$a["eser_id"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a></div>';
							}else{
								$duzenle = '<div class="oneinf">&nbsp;</div>';
							}
							$esid = $a["eser_id"];
							$teslim_ara = $s->query("SELECT * FROM teslimler WHERE eser_id='$esid' && teslim_durumu=0")->num_rows;
							$mevcut = (int)$a["eser_adet"]-(int)$teslim_ara;
						?>
						<li>
							<div class="left">
								<img src="<?php echo $eser_foto; ?>">
							</div>
							<div class="right">
								<div class="oneinf"><span><?php echo htmlspecialchars($a["eser_ad"]); ?></span></div>
								<div class="oneinf"><?php echo htmlspecialchars($a["eser_yazar"]); ?></div>
								<?php echo $duzenle; ?>
								<div class="oneinf">Yayınevi: <?php echo htmlspecialchars($a["eser_yayinevi"]); ?></div>
								<div class="oneinf">ISBN: <b><?php echo htmlspecialchars($a["eser_isbn"]); ?></b></div>
								<div class="oneinf">Sayfa: <b><?php echo htmlspecialchars($a["eser_sayfa"]); ?></b> - Fiyat: <b><?php echo htmlspecialchars($a["eser_fiyat"]); ?></b></div>
								<div class="oneinf">Toplam: <b><?php echo htmlspecialchars($a["eser_adet"]); ?></b> - Mevcut: <b><?php echo $mevcut; ?></b></div>
								<div class="oneinf">Yeri: <b><?php echo htmlspecialchars($a["eser_yer"]); ?></b></div>
								<?php if( !empty($a["eser_not"]) ){ ?>
								<div class="oneinf not"><?php echo htmlspecialchars($a["eser_not"]); ?></div>
								<?php } ?>
							</div>
						</li>
						<?php }//while bitiş

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>