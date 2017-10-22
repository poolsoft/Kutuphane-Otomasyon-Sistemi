<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q)){
		$query = $s->query("SELECT * FROM ogrenciler WHERE ogrenci_ad LIKE '%".$q."%' OR ogrenci_sinif LIKE '%".$q."%' OR ogrenci_no LIKE '%".$q."%' ORDER BY ogrenci_sinif*1,ogrenci_sinif ASC, ogrenci_ad ASC LIMIT 80");
		while($a = mysqli_fetch_assoc($query)){
			$cinsiyet = mb_strtolower(trim($a["ogrenci_cinsiyet"]));
		if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
			$duzenle = '<a href="?sayfa=ogrenci-duzenle&ogrenci='.$a["id"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
		}else{
			$duzenle = '';
		}
			
?>
		<li>
			<div class="left">
				<?php if($cinsiyet=="erkek"){ ?>
					<img class="kivrim" src="<?php echo TEMA_URL; ?>/images/user.png">
				<?php
				}else{ ?>
					<img class="kivrim" src="<?php echo TEMA_URL; ?>/images/user2.png">
				<?php } ?>
			</div>
			<div class="right">
				<div class="oneinf"><?php echo htmlspecialchars($a["ogrenci_ad"]); ?></div>
				<div class="oneinf"><span>(<?php echo $a["ogrenci_sinif"]; ?>-<?php echo $a["ogrenci_no"]; ?>-<?php echo $a["ogrenci_cinsiyet"]; ?>)</span><?php echo $duzenle; ?></div>
			</div>
		</li>
<?php
		}

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>