<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getNobet = $s->g("id");
?>

<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Nöbet Düzenle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<p class="firstp" style="margin-bottom:15px"><a href="?sayfa=nobetci-kayit">&laquo; Nöbetçi Kayıtlarına Dön</a></p>
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==3 ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}elseif( !$s->nobet_var_mi($getNobet) ){
					echo "<h4 style='color:#C93131'>HATA! Böyle bir nöbet yok.</h4>";
				}else{
				?>
				<form method="POST" action="" id="updateNobet" onsubmit="return false;" autocomplete="off">
				<input type="hidden" name="nobet_id" value="<?php echo $getNobet; ?>" />
				<fieldset>
					<legend></legend>


					<?php
					$nobet_ay = $s->nobet_aylik($getNobet,"nobet_ay");
					$nobet_ay_sifirli = $nobet_ay;
					if($nobet_ay<10){
						$nobet_ay_sifirli = "0$nobet_ay";
					}
					$nobet_yil = $s->nobet_aylik($getNobet,"nobet_yil");
					$ay_toplam_gun_sayisi = cal_days_in_month(CAL_GREGORIAN,(int)$nobet_ay,(int)$nobet_yil);
					for ($i=1; $i <= $ay_toplam_gun_sayisi; $i++) {
					if($i<10){
						$i = "0$i";
					}
					$curday = "$i.$nobet_ay_sifirli.$nobet_yil";
					$curday_time = mktime(0,0,0,(int)$nobet_ay,$i,(int)$nobet_yil);
					?>	

					<div class="tumtaraf">
						<div class="soltaraf">
						  <p><label>Nöbet Günü &amp; Nöbetçiler:</label><br />
				          <input type="text" name="tarihler[]" class="nobettarih" data-value="<?php echo $curday; ?>" placeholder="Nöbet günü..." readonly="readonly" /></p>
				        </div>

				        <div class="sagtaraf">
				          <p><br />
				          <select name="nobetcilerbir[]">
				          	<option value="yok">YOK</option>
				          	<?php
				          	$uyeler_cek = $s->query("SELECT * FROM uyeler ORDER BY uye_adsoyad");
				          	while($a = mysqli_fetch_assoc($uyeler_cek)){
				          		$uye_id = $a["uye_id"];
				          		$uye_ad = $a["uye_adsoyad"];
				          		$uye_sinif = $a["uye_sinif"];
				          		$uye_no = $a["uye_okulno"];
				          		if(!empty($uye_sinif) || !empty($uye_no)){
    								$sinifi = "(".htmlspecialchars($uye_sinif)."-".htmlspecialchars($uye_no).")";
    							}else{
    								$sinifi = "";
    							}
    							$uyenin_nobet_gunu_mu = $s->query("SELECT * FROM nobetler_cizelge WHERE nobet_id='$getNobet' && nobetci_id_bir='$uye_id' && nobet_gunu='$i'")->num_rows;
    							if($uyenin_nobet_gunu_mu==1){
    								$uye_nobetci_mi = ' selected="selected"';
    							}else{
    								$uye_nobetci_mi = '';
    							}

				          	?><option value="<?php echo $uye_id; ?>"<?php echo $uye_nobetci_mi; ?>><?php echo htmlspecialchars($uye_ad)." ".$sinifi; ?></option><?php } ?>
				          </select></p>

				          <p>
				          <select name="nobetcileriki[]">
				          	<option value="yok">YOK</option>
				          	<?php
				          	$uyeler_cek = $s->query("SELECT * FROM uyeler ORDER BY uye_adsoyad");
				          	while($a = mysqli_fetch_assoc($uyeler_cek)){
				          		$uye_id = $a["uye_id"];
				          		$uye_ad = $a["uye_adsoyad"];
				          		$uye_sinif = $a["uye_sinif"];
				          		$uye_no = $a["uye_okulno"];
				          		if(!empty($uye_sinif) || !empty($uye_no)){
    								$sinifi = "(".htmlspecialchars($uye_sinif)."-".htmlspecialchars($uye_no).")";
    							}else{
    								$sinifi = "";
    							}
    							$uyenin_nobet_gunu_mu = $s->query("SELECT * FROM nobetler_cizelge WHERE nobet_id='$getNobet' && nobetci_id_iki='$uye_id' && nobet_gunu='$i'")->num_rows;
    							if($uyenin_nobet_gunu_mu==1){
    								$uye_nobetci_mi = ' selected="selected"';
    							}else{
    								$uye_nobetci_mi = '';
    							}

				          	?><option value="<?php echo $uye_id; ?>"<?php echo $uye_nobetci_mi; ?>><?php echo htmlspecialchars($uye_ad)." ".$sinifi; ?></option><?php } ?>
				          </select></p>
				        </div>
				    </div>

					<?php
					}
					?>

			 		  <div class="clearfix"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button> <button class="button delbut" onclick="nobet_sil('<?php echo $getNobet; ?>');return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; NÖBET ÇİZELGESİNİ SİL</button></p>
				</fieldset>
				</form>
				<?php } ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>