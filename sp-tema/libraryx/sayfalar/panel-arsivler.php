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

		<h1 class="page-title"><i class="fa fa-archive" aria-hidden="true"></i> Teslim Arşivleri</h1>

		<div class="page-content">
			
			<div class="search-area">
				
				<div class="search-box">
				<form method="POST" action="" id="searchArsivForm" onsubmit="return false;" autocomplete="off">
					<input type="text" name="src" id="searchArsiv" placeholder="&#xf002; Aramak istediğiniz arşiv adı...">
				</form>
				<?php
				$arsiv_sayisi = $s->query("SELECT id FROM arsivler")->num_rows;
				
				if($arsiv_sayisi >= 80){
					$gosterilen_sayi = 80;
				}else{
					$gosterilen_sayi = $arsiv_sayisi;
				}
				?>
				<div class="littleinfo"><span id="sonuc_sayisi"><?php echo $arsiv_sayisi; ?></span> sonuç arasından <span id="gosterilen_sayi"><?php echo $gosterilen_sayi; ?></span> tanesi gösteriliyor.</div>
				</div>

				<div class="search-content user-search-content clearfix">

					<ul class="user-search-container">
						<?php
						$arsivler = $s->query("SELECT * FROM arsivler ORDER BY id DESC LIMIT 80");
						while($a = mysqli_fetch_assoc($arsivler)){ 
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
						<?php } //while bitiş ?>

					</ul>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>