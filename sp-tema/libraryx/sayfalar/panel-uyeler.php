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

		<h1 class="page-title"><i class="fa fa-user" aria-hidden="true"></i> Üyeler</h1>

		<div class="page-content">
			
			<div class="search-area">
				
				<div class="search-box">
				<form method="POST" action="" id="searchUserForm" onsubmit="return false;" autocomplete="off">
					<input type="text" name="src" id="searchUser" placeholder="&#xf002; Aramak istediğiniz üye adı...">
				</form>
				<?php
				$uye_sayisi = $s->query("SELECT uye_id FROM uyeler")->num_rows;
				
				if($uye_sayisi >= 80){
					$gosterilen_sayi = 80;
				}else{
					$gosterilen_sayi = $uye_sayisi;
				}
				?>
				<div class="littleinfo"><span id="sonuc_sayisi"><?php echo $uye_sayisi; ?></span> sonuç arasından <span id="gosterilen_sayi"><?php echo $gosterilen_sayi; ?></span> tanesi gösteriliyor.</div>
				</div>

				<div class="search-content user-search-content clearfix">
					
					<ul class="user-search-container">
						<?php
						$kullanici_uyeid = $_SESSION["sp_user"];
						$uyeler = $s->query("SELECT * FROM uyeler ORDER BY uye_tur ASC, uye_adsoyad LIMIT 80");
						while($a = mysqli_fetch_assoc($uyeler)){ 
							$uye_id = $a["uye_id"];
							$cinsiyet = mb_strtolower(trim($a["uye_cinsiyet"]));
							$def_foto = "user";
							if($cinsiyet=="erkek"){
								$def_foto = "user";
							}else{
								$def_foto = "user2";
							}
							$uye_tur = $s->uye_tur($a["uye_tur"]);
							$yetkiler = $s->kullanici($_SESSION["sp_user"],"uye_eylemler");
							if( 
								( $a["uye_tur"]==1 && $s->yetkisi_var("5",$yetkiler) 
								||
								$a["uye_tur"]==2 && $s->yetkisi_var("4",$yetkiler) 
								||
								$a["uye_tur"]==3 && $s->yetkisi_var("3",$yetkiler) )
								&&
								$uye_id != $kullanici_uyeid
							){
								$duzenle = '<a href="?sayfa=uye-duzenle&uye='.$uye_id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
							}else{
								$duzenle = '';
								
							}

							$bugun_gun = (int)date("d");
							$bugun_ay = (int)date("m");
							$bugun_yil = (int)date("Y");
							$uyeid = $a["uye_id"];

							$nobetci_mi_ilk_kontrol_q = $s->query("SELECT * FROM nobetler_cizelge WHERE nobetci_id='$uyeid' && nobet_gunu='$bugun_gun'");
							$nobetci_mi_ilk_kontrol = $nobetci_mi_ilk_kontrol_q->num_rows;
							if($nobetci_mi_ilk_kontrol==1){
								$cek_nobetid = mysqli_fetch_array($nobetci_mi_ilk_kontrol_q);
								$nobetid = $cek_nobetid["nobet_id"];
								$asil_nobet_cek = mysqli_fetch_array($s->query("SELECT * FROM nobetler_aylik WHERE nobet_id='$nobetid'"));
								$asil_yil = $asil_nobet_cek["nobet_yil"];
								$asil_ay = $asil_nobet_cek["nobet_ay"];
								if((int)$asil_yil==$bugun_yil && (int)$asil_ay==$bugun_ay){
									$uye_nobetci_mi_kontrol = true;
								}else{
									$uye_nobetci_mi_kontrol = false;
								}
							}else{
								$uye_nobetci_mi_kontrol = false;
							}
							
							if( $uye_nobetci_mi_kontrol ){
								$nobetci_mi = '<span class="nobetcitext">NÖBETÇİ</span>';
							}else{
								$nobetci_mi = '';
							}
						?>
						<li>
							<div class="left">
								<?php if(empty($a["uye_foto"])){ ?>
								<img class="kivrim" src="<?php echo TEMA_URL; ?>/images/<?php echo $def_foto; ?>.png">
								<?php }else{ ?>
								<img class="kivrim" src="<?php echo URL; ?>/uploads/users/<?php echo htmlspecialchars($a["uye_foto"]); ?>">
								<?php } ?>
							</div>
							<div class="right">
								<div class="oneinf"><?php echo htmlspecialchars($a["uye_adsoyad"]); ?><?php echo $nobetci_mi; ?></div>
								<div class="oneinf"><span><?php echo $uye_tur; ?> <?php if($a["uye_tur"] == "3"){ ?>(<?php echo htmlspecialchars($a["uye_sinif"]); ?>-<?php echo htmlspecialchars($a["uye_okulno"]); ?>)<?php } ?></span><?php echo $duzenle; ?></div>
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