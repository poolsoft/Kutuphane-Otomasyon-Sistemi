<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q)){
		$query = $s->query("SELECT * FROM eylemler WHERE eylem LIKE '%".$q."%' OR eylem_yapan LIKE '%".$q."%' ORDER BY eylem_id DESC");
		while($a = mysqli_fetch_assoc($query)){
			$id = $a["eylem_id"];
			$eylem_yapan = $a["eylem_yapan"];
			$eylem = $a["eylem"];
			$eylem_tarih = $a["eylem_tarih"];
			$gun = $s->tr_dateTime($eylem_tarih)." ".date("H:i:s",$eylem_tarih);
		?><li><div class="right eylemright"><div class="oneinf"><a class="eylema"><?php echo htmlspecialchars($eylem_yapan); ?></a><span class="eylemspanbir"><?php echo htmlspecialchars($eylem); ?></span><span class="eylemspaniki">(<?php echo $gun; ?>)</span></div></div></li><?php } //while bitiş

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>