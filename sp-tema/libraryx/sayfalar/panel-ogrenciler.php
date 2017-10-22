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

		<h1 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> Öğrenciler</h1>

		<div class="page-content">
			
			<div class="search-area">
				
				<div class="search-box">
				<form method="POST" action="" id="searchOgrenciForm" onsubmit="return false;" autocomplete="off">
					<input type="text" name="src" id="searchOgrenci" placeholder="&#xf002; Aramak istediğiniz öğrenci adı, sınıfı veya numarası...">
				</form>
				<?php
				$ogrenci_sayisi = $s->query("SELECT id FROM ogrenciler")->num_rows;
				if($ogrenci_sayisi >= 80){
					$gosterilen_sayi = 80;
				}else{
					$gosterilen_sayi = $ogrenci_sayisi;
				}
				?>
				<div class="littleinfo"><span id="sonuc_sayisi"><?php echo $ogrenci_sayisi; ?></span> sonuç arasından <span id="gosterilen_sayi"><?php echo $gosterilen_sayi; ?></span> tanesi gösteriliyor.</div>
				</div>

				<div class="search-content user-search-content clearfix">
					<ul class="user-search-container">
						<?php
						$ogrenciler = $s->query("SELECT * FROM ogrenciler ORDER BY ogrenci_sinif*1,ogrenci_sinif ASC, ogrenci_ad ASC LIMIT 80");
						$yetkiler = $s->kullanici($_SESSION["sp_user"],"uye_eylemler");
						while($a = mysqli_fetch_assoc($ogrenciler)){ 
							$ogrenci_id = $a["id"];
							$cinsiyet = mb_strtolower(trim($a["ogrenci_cinsiyet"]));
						if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
							$duzenle = '<a href="?sayfa=ogrenci-duzenle&ogrenci='.$ogrenci_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
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
								<div class="oneinf"><span>(<?php echo htmlspecialchars($a["ogrenci_sinif"]); ?>-<?php echo htmlspecialchars($a["ogrenci_no"]); ?>-<?php echo htmlspecialchars($a["ogrenci_cinsiyet"]); ?>)</span><?php echo $duzenle; ?></div>
							</div>
						</li>
						<?php } //while bitiş ?>

					</ul>

					<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
					<p style="margin-top:-10px">
						<button class="button delbut" onclick="deleteTumOgrenci();return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; TÜM ÖĞRENCİLERİ SİL</button>
					</p>
					<?php } ?>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>