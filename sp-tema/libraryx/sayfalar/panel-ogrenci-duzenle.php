<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getOgrenci = $s->g("ogrenci");
?>

<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Öğrenci Düzenle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<p class="firstp" style="margin-bottom:15px"><a href="?sayfa=ogrenciler">&laquo; Öğrencilere Dön</a></p>
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==3 ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}elseif( !$s->ogrenci_var_mi($getOgrenci) ){
					echo "<h4 style='color:#C93131'>HATA! Böyle bir üye yok.</h4>";
				}else{
				?>
				<form method="POST" action="" id="updateOgrenci" onsubmit="return false;" autocomplete="off">
				<input type="hidden" name="numara_first" value="<?php echo $s->ogrenci($getOgrenci,"ogrenci_no"); ?>" />
				<input type="hidden" name="ogrenciid" value="<?php echo $getOgrenci; ?>" />
				<fieldset>
					<legend></legend>
					  <p><label for="your_username">Öğrenci Adı ve Soyadı:</label><br />
			          <input type="text" name="a1" id="your_username" value="<?php echo htmlspecialchars($s->ogrenci($getOgrenci,"ogrenci_ad")); ?>" placeholder="Kullanıcı adı..." /></p>

			          <p><label for="select_element">Öğrenci Sınıfı:</label><br />
			            <select name="a2" id="select_element">
			            <optgroup label="İdareciler ve Öğretmenler">
			            	<option value=""<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")==""){ echo ' selected="selected"'; } ?>>YOK</option>
			            </optgroup>
			            <optgroup label="9. Sınıflar">
			              <option value="9/A"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/A"){ echo ' selected="selected"'; } ?>>9/A</option>
			              <option value="9/B"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/B"){ echo ' selected="selected"'; } ?>>9/B</option>
			              <option value="9/C"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/C"){ echo ' selected="selected"'; } ?>>9/C</option>
			              <option value="9/D"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/D"){ echo ' selected="selected"'; } ?>>9/D</option>
			              <option value="9/E"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/E"){ echo ' selected="selected"'; } ?>>9/E</option>
			              <option value="9/F"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/F"){ echo ' selected="selected"'; } ?>>9/F</option>
			              <option value="9/G"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="9/G"){ echo ' selected="selected"'; } ?>>9/G</option>
			            </optgroup>
			            <optgroup label="10. Sınıflar">
			              <option value="10/A"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/A"){ echo ' selected="selected"'; } ?>>10/A</option>
			              <option value="10/B"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/B"){ echo ' selected="selected"'; } ?>>10/B</option>
			              <option value="10/C"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/C"){ echo ' selected="selected"'; } ?>>10/C</option>
			              <option value="10/D"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/D"){ echo ' selected="selected"'; } ?>>10/D</option>
			              <option value="10/E"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/E"){ echo ' selected="selected"'; } ?>>10/E</option>
			              <option value="10/F"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/F"){ echo ' selected="selected"'; } ?>>10/F</option>
			              <option value="10/G"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="10/G"){ echo ' selected="selected"'; } ?>>10/G</option>
			            </optgroup>
			            <optgroup label="11. Sınıflar">
			              <option value="11/A"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/A"){ echo ' selected="selected"'; } ?>>11/A</option>
			              <option value="11/B"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/B"){ echo ' selected="selected"'; } ?>>11/B</option>
			              <option value="11/C"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/C"){ echo ' selected="selected"'; } ?>>11/C</option>
			              <option value="11/D"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/D"){ echo ' selected="selected"'; } ?>>11/D</option>
			              <option value="11/E"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/E"){ echo ' selected="selected"'; } ?>>11/E</option>
			              <option value="11/F"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/F"){ echo ' selected="selected"'; } ?>>11/F</option>
			              <option value="11/G"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="11/G"){ echo ' selected="selected"'; } ?>>11/G</option>
			            </optgroup>
			            <optgroup label="12. Sınıflar">
			              <option value="12/A"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/A"){ echo ' selected="selected"'; } ?>>12/A</option>
			              <option value="12/B"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/B"){ echo ' selected="selected"'; } ?>>12/B</option>
			              <option value="12/C"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/C"){ echo ' selected="selected"'; } ?>>12/C</option>
			              <option value="12/D"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/D"){ echo ' selected="selected"'; } ?>>12/D</option>
			              <option value="12/E"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/E"){ echo ' selected="selected"'; } ?>>12/E</option>
			              <option value="12/F"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/F"){ echo ' selected="selected"'; } ?>>12/F</option>
			              <option value="12/G"<?php if( $s->ogrenci($getOgrenci,"ogrenci_sinif")=="12/G"){ echo ' selected="selected"'; } ?>>12/G</option>
			            </optgroup>
			          </select></p>

			          <p><label for="your_no">Okul Numarası:</label><br />
			          <input type="number" name="a3" id="your_no" value="<?php echo htmlspecialchars($s->ogrenci($getOgrenci,"ogrenci_no")); ?>" placeholder="Okul numarası..." /></p>

			          <p><label for="your_cinsiyet">Cinsiyet:</label><br />
			          <select id="your_cinsiyet" name="a4">
			          	<option value="Erkek"<?php if(mb_strtolower(trim($s->ogrenci($getOgrenci,"ogrenci_cinsiyet")))=="erkek"){echo ' selected';}?>>Erkek</option>
			          	<option value="Kız"<?php if(mb_strtolower(trim($s->ogrenci($getOgrenci,"ogrenci_cinsiyet")))=="kız"){echo ' selected';}?>>Kız</option>
			          </select></p>

			 		  <div class="clearfix"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button> <button class="button delbut" onclick="ogrenci_sil('<?php echo $getOgrenci; ?>');return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; ÖĞRENCİYİ SİL</button></p>
				</fieldset>
				</form>
				<?php } ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>