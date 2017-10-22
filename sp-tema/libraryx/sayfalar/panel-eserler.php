<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
?>
<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-book" aria-hidden="true"></i> Eserler</h1>

		<div class="page-content">
			
			<div class="search-area">

				<p class="firstp" style="margin-bottom:-25px;margin-top:-5px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.eserler.php" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> Eserleri listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.eserler.php" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				<p class="firstp" style="margin-bottom:-25px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.eserler.kategoriler.php" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> Eserleri kategorilerine göre listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.eserler.kategoriler.php" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				<p class="firstp" style="margin-bottom:-25px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.eserler.yerler.php" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> Eserleri yerlerine göre listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.eserler.yerler.php" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				<p class="firstp firstpa" style="margin-bottom:15px;"><a style="font-size:17px;font-weight:500" href="javascript:getEserBelirli()"><i class="fa fa-share-square-o" aria-hidden="true"></i> Eserleri belirli kriterlere göre listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="javascript:getEserBelirli('indir')"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				
				<div class="search-box">
					<form method="POST" action="" id="searchEserForm" onsubmit="return false;" autocomplete="off">
						<input type="text" name="src" id="searchEser" placeholder="&#xf002; Aramak istediğiniz eser, yazar veya ISBN...">
					</form>
					<?php
					$eser_sayisi = $s->query("SELECT eser_id FROM eserler")->num_rows;
					
					if($eser_sayisi >= 80){
						$gosterilen_sayi = 80;
					}else{
						$gosterilen_sayi = $eser_sayisi;
					}
					?>
					<div class="littleinfo"><span id="sonuc_sayisi"><?php echo $eser_sayisi; ?></span> sonuç arasından <span id="gosterilen_sayi"><?php echo $gosterilen_sayi; ?></span> tanesi gösteriliyor.</div>
				</div>

				<div class="search-content eser-search-content eserler clearfix">

					<ul class="eser-search-container">
						<?php
						$eserler = $s->query("SELECT * FROM eserler ORDER BY eser_ad ASC LIMIT 80");
						while($a = mysqli_fetch_assoc($eserler)){
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
						<?php }//while bitiş ?>

					</ul>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>