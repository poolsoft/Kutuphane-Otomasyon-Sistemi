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

		<h1 class="page-title"><i class="fa fa-recycle" aria-hidden="true"></i> Teslimler</h1>

		<div class="page-content">
			
			<div class="search-area">
			<p class="firstp" style="margin-bottom:-25px;margin-top:-5px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.teslimler.istatistik.php" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> Tüm teslim istatistikleri</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.teslimler.istatistik.php" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				<p class="firstp" style="margin-bottom:-25px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.teslimler.php" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> Teslimleri listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.teslimler.php" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
					<p class="firstp" style="margin-bottom:-25px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.teslimler.php?action=iade-edilen" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> İade edilen teslimleri listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.teslimler.php?action=iade-edilen" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
					<p class="firstp" style="margin-bottom:-25px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.teslimler.php?action=iade-edilmeyen" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> İade edilmeyen teslimleri listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.teslimler.php?action=iade-edilmeyen" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
					<p class="firstp firstpa" style="margin-bottom:15px"><a style="font-size:17px;font-weight:500" href="<?php echo TEMA_URL; ?>/get/get.teslimler.php?action=iade-tarihi-gecen" target="_blank"><i class="fa fa-share-square-o" aria-hidden="true"></i> İade tarihi geçen teslimleri listele</a> (<a style="font-size:17px;font-weight:700;letter-spacing:-1px" href="<?php echo TEMA_URL; ?>/get/download.teslimler.php?action=iade-tarihi-gecen" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> İNDİR</a>)</p>
				
				<div class="search-box">
					<form method="POST" action="" id="searchTeslimForm" onsubmit="return false;" autocomplete="off">
						<input type="text" name="src" id="searchTeslim" placeholder="&#xf002; Teslim alınan eserin adı veya teslim alan ad/no...">
					</form>
					<?php
					$teslim_sayisi = $s->query("SELECT teslim_id FROM teslimler")->num_rows;
					
					if($teslim_sayisi >= 80){
						$gosterilen_sayi = 80;
					}else{
						$gosterilen_sayi = $teslim_sayisi;
					}
					?>
					<div class="littleinfo"><span id="sonuc_sayisi"><?php echo $teslim_sayisi; ?></span> sonuç arasından <span id="gosterilen_sayi"><?php echo $gosterilen_sayi; ?></span> tanesi gösteriliyor.</div>
				</div>

				<div class="search-content teslim-search-content eserler clearfix">

					<ul class="teslim-search-container">
						<?php
						$teslimler = $s->query("SELECT * FROM teslimler ORDER BY teslim_id DESC LIMIT 80");
						while($a = mysqli_fetch_assoc($teslimler)){
							$eserid = $s->teslim($a["teslim_id"],"eser_id");
							if( !empty($s->eser($eserid,"eser_foto")) ){
								$eser_foto = URL."/uploads/eserler/".$s->eser($eserid,"eser_foto");
							}else{
								$eser_foto = TEMA_URL."/images/nofoto.png";
							}
							$teslim_edildi_ham = $s->teslim($a["teslim_id"],"teslim_verim_tarihi");
							$teslim_edildi = date('d.m.Y',$teslim_edildi_ham);
							$teslim_alindi_ham = $s->teslim($a["teslim_id"],"teslim_alim_tarihi");
							$teslim_alindi = date('d.m.Y',$teslim_alindi_ham);
							$gunumuz = time();
							$kac_gun = floor(((int)$teslim_alindi_ham-(int)$teslim_edildi_ham) / (60*60*24));
							$kalan_zaman = floor(((int)$teslim_alindi_ham-(int)$gunumuz) / (60*60*24))+1;
							
							if($kalan_zaman > 0){
								$ne_kadar_kaldi = '<span style="color:#08977E"><i class="fa fa-times" aria-hidden="true"></i> ('.$kalan_zaman.' GÜN KALDI)</span>';
							}elseif($kalan_zaman==0){
								$ne_kadar_kaldi = '<span style="color:#08977E"><i class="fa fa-times" aria-hidden="true"></i> (BUGÜN TESLİM)</span>';
							}else{
								$ne_kadar_kaldi = '<span style="color:#DE2C2C"><i class="fa fa-times" aria-hidden="true"></i> ('.(-1)*$kalan_zaman.' GÜN GEÇTİ)</span>';
							}

							if( $s->teslim($a["teslim_id"],"teslim_durumu") == "1"  ){
								$tarih = $s->tr_dateTime($s->teslim($a["teslim_id"],"teslim_alindi_tarih"));
								$ne_kadar_kaldi = '<span class="iade-box"><i class="fa fa-check" aria-hidden="true"></i> '.$tarih.'</span>';
							}

							$teslim_alan_no = $s->teslim($a["teslim_id"],"teslim_alan_no");

							$teslim_alan = $s->ogrencino($teslim_alan_no,"ogrenci_ad");

							$teslim_veren_ham = $s->teslim($a["teslim_id"],"teslim_veren");
							$teslim_veren = $s->kullanici($teslim_veren_ham,"uye_adsoyad");

							$teslim_alan_sinif = $s->ogrencino($teslim_alan_no,"ogrenci_sinif");
							
							$teslim_alindi_tarihx = $s->teslim($a["teslim_id"],"teslim_alindi_tarih");

							$kalan_zamann = floor(((int)$teslim_alindi_ham-(int)$teslim_alindi_tarihx) / (60*60*24))+1;
              			if( $s->teslim($a["teslim_id"],"teslim_durumu") == "1"  ){
						    if($kalan_zamann > 0){
						      $kalan_zamannx = '<span class="iade-box">('.$kalan_zamann.' gün erken)</span>';
						    }elseif($kalan_zamann==0){
						      $kalan_zamannx = '<span class="iade-box">(Gününde)</span>';
						    }else{
						      $kalan_zamannx = '<span class="iade-box">('.(-1)*$kalan_zamann.' gün geç)</span>';
						    }
						}else{
							$kalan_zamannx = "";
						}
						?>
						<li>
							<div class="left">
								<img src="<?php echo $eser_foto; ?>">
							</div>
							<div class="right">
								<div class="oneinf"><span class="teslimad"><?php echo htmlspecialchars($teslim_alan); ?> (<?php echo htmlspecialchars($teslim_alan_sinif); ?>-<?php echo htmlspecialchars($teslim_alan_no); ?>)</span> <a href="?sayfa=teslim-duzenle&teslim=<?php echo $a["teslim_id"]; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Görüntüle</a>
								<?php
								$teslim_durumu = $s->teslim($a["teslim_id"],"teslim_durumu");
			          			if($teslim_durumu!="1"){ ?>
								<a class="iadeedildi" href="javascript:;" onclick="iade_onay('<?php echo $a["teslim_id"]; ?>','<?php echo $_SESSION["sp_user"]; ?>')"><i class="fa fa-check" aria-hidden="true"></i> İADE ET</a>
								<?php } ?>
								</div>
								
								<hr />
								<div class="eser-kisim">
									<div class="oneinf"><b><?php echo htmlspecialchars($s->eser($eserid,"eser_ad")); ?></b> - <i><?php echo htmlspecialchars($s->eser($eserid,"eser_yazar")); ?></i></div>

									<div class="oneinf"><?php echo htmlspecialchars($s->eser($eserid,"eser_yayinevi")); ?> (<b><?php echo htmlspecialchars($s->eser($eserid,"eser_isbn")); ?></b>)</div>
									<?php if( !empty($s->eser($eserid,"eser_not")) ){ ?>
									<div class="oneinf not">ESER NOT: <?php echo htmlspecialchars($s->eser($eserid,"eser_not")); ?></div>
									<?php } ?>
								</div>
								<hr />

								<div class="oneinf">Teslim Eden Üye: <b><?php echo htmlspecialchars($teslim_veren); ?></b></div>
								<div class="oneinf">Teslim Edildi: <?php echo $s->tr_dateTime($teslim_edildi_ham); ?></div>
								<div class="oneinf">İade Edilecek: <?php echo $s->tr_dateTime($teslim_alindi_ham); ?> (<?php echo $kac_gun; ?> Günlük)</div>
								<div class="oneinf">İade Edildi: <b><?php echo $ne_kadar_kaldi; ?></b><?php echo $kalan_zamannx; ?></b></div>
								
								<?php if( !empty($s->teslim($a["teslim_id"],"teslim_not")) ){ ?>
								<div class="oneinf not" style="background-color:#7B7B7B">TESLİM NOT: <?php echo htmlspecialchars($s->teslim($a["teslim_id"],"teslim_not")); ?></div>
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