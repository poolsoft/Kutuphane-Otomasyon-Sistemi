<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$q = $s->p("q");

	if(!empty($q) || ($q == '0')){
		$query = $s->query("SELECT * FROM eserler WHERE eser_ad LIKE '%".$q."%' OR eser_yazar LIKE '%".$q."%' OR REPLACE(eser_isbn, '-', '') LIKE '%".$q."%' ORDER BY eser_ad ASC LIMIT 20");
		while($a = mysqli_fetch_assoc($query)){
							$esid = $a["eser_id"];
							$teslim_ara = $s->query("SELECT * FROM teslimler WHERE eser_id='$esid' && teslim_durumu=0")->num_rows;
							$mevcut = (int)$a["eser_adet"]-(int)$teslim_ara;
						?>
						<li>
						<a href="#" onclick="addISBN('<?php echo htmlspecialchars($a["eser_isbn"]); ?>'); return false;">
							<div class="oneinf eser"><span><?php echo htmlspecialchars($a["eser_ad"]); ?></span></div>
							<div class="oneinf yazar"><span><?php echo htmlspecialchars($a["eser_yazar"]); ?> - <?php echo htmlspecialchars($a["eser_yayinevi"]); ?></span></div>
							<div class="oneinf isbn"><?php echo htmlspecialchars($a["eser_isbn"]); ?></div>
							<div class="oneinf"><span style="font-size:14px;font-weight:400">(Mevcut: <?php echo $mevcut; ?>)</span></div>
						</a>
						</li>
						<?php }//while bitiş

	}else{
		echo "Lütfen aramak için bir terim giriniz...";
	}

}
?>