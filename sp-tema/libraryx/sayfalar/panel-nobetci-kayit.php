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

		<h1 class="page-title"><i class="fa fa-calendar" aria-hidden="true"></i> Nöbetçi Kayıtları</h1>

		<div class="page-content">

		<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
				?>
		<form method="post" action="" id="addNobetForm" onsubmit="return false;" autocomplete="off">
				<select name="a1" id="addNobet1" style="font-weight:bold;padding:6px;font-size:16px">
					<option value="1">Ocak</option>
					<option value="2">Şubat</option>
					<option value="3">Mart</option>
					<option value="4">Nisan</option>
					<option value="5">Mayıs</option>
					<option value="6">Haziran</option>
					<option value="7">Temmuz</option>
					<option value="8">Ağustos</option>
					<option value="9">Eylül</option>
					<option value="10">Ekim</option>
					<option value="11">Kasım</option>
					<option value="12">Aralık</option>
				</select>
				<select name="a2" id="addNobet2" style="font-weight:bold;padding:6px;font-size:16px">
					<?php
					$su_anki_yil = date("Y");
					$elli_yil_once = (int)$su_anki_yil-50;
					$elli_yil_sonra = (int)$su_anki_yil+80;
					for ($i=$elli_yil_once; $i <= $elli_yil_sonra; $i++) { 
						if($su_anki_yil==$i){
							$selected = ' selected="selected"';
						}else{
							$selected = '';
						}
					?><option value="<?php echo $i; ?>"<?php echo $selected; ?>><?php echo $i; ?></option><?php } ?>
				</select>
				<button class="button" id="addNobet" style="padding:4px;font-size:14px" onclick="nobet_ekle();">Nöbet Çizelgesi Ekle</button>
			</form>
			<?php } ?>

			
			<div class="search-area">

				<div class="search-content user-search-content clearfix">

					<ul class="user-search-container">
						<?php
						$nobetler = $s->query("SELECT * FROM nobetler_aylik ORDER BY nobet_yil DESC, nobet_ay DESC");
						while($a = mysqli_fetch_assoc($nobetler)){ 
							$nid = $a["nobet_id"];
							$nobet_ay = $a["nobet_ay"];
							$nobet_ay_yazi = $s->tr_Ay($nobet_ay);
							$nobet_yil = $a["nobet_yil"];
							$nobet_baslik = $nobet_ay_yazi." ".$nobet_yil;
							$kayitsayisi = $s->query("SELECT * FROM nobetler_cizelge WHERE nobet_id='$nid'")->num_rows;
							$ay_toplam_gun_sayisi = cal_days_in_month(CAL_GREGORIAN,(int)$nobet_ay,(int)$nobet_yil);
						?>
						<li>
							<div class="left">
								<img class="kivrim" style="height:60px;width:60px" src="<?php echo TEMA_URL; ?>/images/nobet.png">
							</div>
							<div class="right">
								<div class="oneinf"><?php echo htmlspecialchars($nobet_baslik); ?></div>
								<div class="oneinf"><span>(<?php echo $kayitsayisi; ?>/<?php echo $ay_toplam_gun_sayisi; ?> Kayıt)</span><br><a href="<?php echo TEMA_URL; ?>/get/get.nobetler.php?id=<?php echo $nid; ?>" target="_blank" style="margin-top:10px"><i class="fa fa-share-square-o" aria-hidden="true"></i> Çizelgeyi Görüntüle</a> <a href="<?php echo URL; ?>/?sayfa=nobet-duzenle&id=<?php echo $nid; ?>" style="margin-top:10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a> &nbsp;&nbsp; <a target="_blank" href="<?php echo TEMA_URL; ?>/get/download.nobetler.php?id=<?php echo $nid; ?>" style="margin-top:10px"><i class="fa fa-download" aria-hidden="true"></i> İndir</a></div>
							</div>
						</li>
						<?php } //while bitiş ?>

					</ul>

					<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
					?>
					<p style="margin-top:-10px">
						<button class="button delbut" onclick="deleteTumNobet();return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; TÜM KAYITLARI SİL</button>
					</p>
					<?php } ?>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>