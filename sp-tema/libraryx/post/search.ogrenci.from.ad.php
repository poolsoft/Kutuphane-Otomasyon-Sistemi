<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q) || ($q == '0')){
		$query = $s->query("SELECT * FROM ogrenciler WHERE ogrenci_ad LIKE '%".$q."%' OR ogrenci_sinif LIKE '%".$q."%' OR ogrenci_no LIKE '%".$q."%' ORDER BY ogrenci_sinif*1,ogrenci_sinif ASC LIMIT 20");
		while($a = mysqli_fetch_assoc($query)){
							$ogrenci_no = $a["ogrenci_no"];
						?>
						<li>
						<a href="#" onclick="addOgrenci('<?php echo htmlspecialchars($a["ogrenci_no"]); ?>'); return false;">
							<div class="oneinf eser"><span><?php echo htmlspecialchars($a["ogrenci_ad"]); ?></span></div>
							<div class="oneinf yazar"><span><?php echo htmlspecialchars($a["ogrenci_sinif"]); ?></span></div>
							<div class="oneinf isbn"><?php echo htmlspecialchars($a["ogrenci_no"]); ?></div>
						</a>
						</li>
						<?php }//while bitiş

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>