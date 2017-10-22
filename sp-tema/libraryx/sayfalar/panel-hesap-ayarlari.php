<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getUye = $_SESSION["sp_user"];
$yetkiler = $s->kullanici($getUye,"uye_eylemler");
?>
<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-cog" aria-hidden="true"></i> Hesap Ayarları</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<form method="POST" action="" id="updateYourself" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="userid" value="<?php echo $getUye; ?>" />
				<fieldset>
					<legend><?php echo htmlspecialchars($s->kullanici($getUye,"uye_adsoyad")); ?></legend>
					  <p><label for="select_elementx">Üye Fotoğrafı:</label><br />
			           
			          <?php if( empty($s->kullanici($getUye,"uye_foto")) ){ ?>
			          <input type="file" id="select_elementx" name="foto">
			          <?php }else{ ?>
			          <div class="hasFoto clearfix">
			          	<div class="foto"><img src="<?php echo URL; ?>/uploads/users/<?php echo htmlspecialchars($s->kullanici($getUye,"uye_foto")); ?>" width="100" height="100"></div>
			          	<div class="sil"><a href="javascript:user_foto_kaldir('<?php echo htmlspecialchars($s->kullanici($getUye,"uye_id")); ?>');"><i class="fa fa-trash" aria-hidden="true"></i> Fotoğrafı Kaldır</a></div>
			          </div>
			          <?php } ?>
			          </p>
					  <p><label for="your_username">Kullanıcı Adı:</label><br />
			          <input type="text" name="a1" id="your_username" value="<?php echo htmlspecialchars($s->kullanici($getUye,"uye_kadi")); ?>" placeholder="Kullanıcı adı..." /></p>

					  <p><label for="your_name">Ad:</label><br />
			          <input type="text" name="a2" id="your_name" value="<?php echo htmlspecialchars($s->kullanici($getUye,"uye_adsoyad")); ?>" placeholder="Ad ve soyad..." /></p>

			          <p><label for="your_email">eMail Adresi:</label><br />
			          <input type="text" name="a3" id="your_email" value="<?php echo htmlspecialchars($s->kullanici($getUye,"uye_email")); ?>" placeholder="eMail adresi..." /></p>

			          <p><label for="your_pass">Şifre(değiştirmek istemiyorsanız boş bırakın):</label><br />
			          <input type="password" name="a4" id="your_pass" placeholder="Şifre***..." /></p>

			          <p><label for="your_pass2">Şifre(tekrar):</label><br />
			          <input type="password" name="a5" id="your_pass2" placeholder="Şifre(tekrar)***..." /></p>

			          <?php if( $s->kullanici($getUye,"uye_tur")=="1" || $s->kullanici($getUye,"uye_tur")=="2" ){ null; }else{ ?>
			          <p><label for="select_element">Sınıf:</label><br />
			            <select name="a6" id="select_element">
			            <optgroup label="İdareciler ve Öğretmenler">
			            	<option value=""<?php if( $s->kullanici($getUye,"uye_sinif")==""){ echo ' selected="selected"'; } ?>>YOK</option>
			            </optgroup>
			            <optgroup label="9. Sınıflar">
			              <option value="9/A"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/A"){ echo ' selected="selected"'; } ?>>9/A</option>
			              <option value="9/B"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/B"){ echo ' selected="selected"'; } ?>>9/B</option>
			              <option value="9/C"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/C"){ echo ' selected="selected"'; } ?>>9/C</option>
			              <option value="9/D"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/D"){ echo ' selected="selected"'; } ?>>9/D</option>
			              <option value="9/E"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/E"){ echo ' selected="selected"'; } ?>>9/E</option>
			              <option value="9/F"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/F"){ echo ' selected="selected"'; } ?>>9/F</option>
			              <option value="9/G"<?php if( $s->kullanici($getUye,"uye_sinif")=="9/G"){ echo ' selected="selected"'; } ?>>9/G</option>
			            </optgroup>
			            <optgroup label="10. Sınıflar">
			              <option value="10/A"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/A"){ echo ' selected="selected"'; } ?>>10/A</option>
			              <option value="10/B"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/B"){ echo ' selected="selected"'; } ?>>10/B</option>
			              <option value="10/C"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/C"){ echo ' selected="selected"'; } ?>>10/C</option>
			              <option value="10/D"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/D"){ echo ' selected="selected"'; } ?>>10/D</option>
			              <option value="10/E"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/E"){ echo ' selected="selected"'; } ?>>10/E</option>
			              <option value="10/F"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/F"){ echo ' selected="selected"'; } ?>>10/F</option>
			              <option value="10/G"<?php if( $s->kullanici($getUye,"uye_sinif")=="10/G"){ echo ' selected="selected"'; } ?>>10/G</option>
			            </optgroup>
			            <optgroup label="11. Sınıflar">
			              <option value="11/A"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/A"){ echo ' selected="selected"'; } ?>>11/A</option>
			              <option value="11/B"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/B"){ echo ' selected="selected"'; } ?>>11/B</option>
			              <option value="11/C"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/C"){ echo ' selected="selected"'; } ?>>11/C</option>
			              <option value="11/D"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/D"){ echo ' selected="selected"'; } ?>>11/D</option>
			              <option value="11/E"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/E"){ echo ' selected="selected"'; } ?>>11/E</option>
			              <option value="11/F"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/F"){ echo ' selected="selected"'; } ?>>11/F</option>
			              <option value="11/G"<?php if( $s->kullanici($getUye,"uye_sinif")=="11/G"){ echo ' selected="selected"'; } ?>>11/G</option>
			            </optgroup>
			            <optgroup label="12. Sınıflar">
			              <option value="12/A"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/A"){ echo ' selected="selected"'; } ?>>12/A</option>
			              <option value="12/B"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/B"){ echo ' selected="selected"'; } ?>>12/B</option>
			              <option value="12/C"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/C"){ echo ' selected="selected"'; } ?>>12/C</option>
			              <option value="12/D"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/D"){ echo ' selected="selected"'; } ?>>12/D</option>
			              <option value="12/E"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/E"){ echo ' selected="selected"'; } ?>>12/E</option>
			              <option value="12/F"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/F"){ echo ' selected="selected"'; } ?>>12/F</option>
			              <option value="12/G"<?php if( $s->kullanici($getUye,"uye_sinif")=="12/G"){ echo ' selected="selected"'; } ?>>12/G</option>
			            </optgroup>
			          </select></p>

			          <p><label for="your_no">Okul Numarası(idareciler ve öğretmenler için boş bırakın):</label><br />
			          <input type="number" name="a7" id="your_no" value="<?php echo htmlspecialchars($s->kullanici($getUye,"uye_okulno")); ?>" placeholder="Okul numarası..." /></p>
			          <?php } ?>

			          <p><label for="select_element2">Üye Türü:</label><br />
			          <select name="a8" id="select_element2" disabled="disabled">
			          	<option value="1"<?php if( $s->kullanici($getUye,"uye_tur")=="1" ){ echo ' selected="selected"'; } ?>>İdareci</option>
			          	<option value="2"<?php if( $s->kullanici($getUye,"uye_tur")=="2" ){ echo ' selected="selected"'; } ?>>Öğretmen</option>
			          	<option value="3"<?php if( $s->kullanici($getUye,"uye_tur")=="3" ){ echo ' selected="selected"'; } ?>>Öğrenci</option>
			          </select>
			          </p>

			          <p><label for="your_cinsiyet">Cinsiyet:</label><br />
			          <select id="your_cinsiyet" name="a9">
			          	<option value="Erkek"<?php if(mb_strtolower(trim($s->kullanici($getUye,"uye_cinsiyet")))=="erkek"){echo ' selected';}?>>Erkek</option>
			          	<option value="Kız"<?php if(mb_strtolower(trim($s->kullanici($getUye,"uye_cinsiyet")))=="kız"){echo ' selected';}?>>Kız</option>
			          </select></p>

			          <p style="margin-bottom:10px"><label for="select_elementxx">Eylemler:</label>
			            	<div style="margin-top:-10px"><input type="checkbox" name="y1" id="a1" value="1"<?php if( $s->yetkisi_var("1",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a1">Eserleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y2" id="a2" value="2"<?php if( $s->yetkisi_var("2",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a2">Teslimleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y3" id="a3" value="3"<?php if( $s->yetkisi_var("3",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a3">Öğrencileri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y4" id="a5" value="4"<?php if( $s->yetkisi_var("4",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a5">Öğretmenleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y5" id="a6" value="5"<?php if( $s->yetkisi_var("5",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a6">İdarecileri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y6" id="a4" value="6"<?php if( $s->yetkisi_var("6",$yetkiler) ){ echo ' checked'; } ?> disabled="disabled"> <label for="a4">Site ayarlarını düzenleyebilir.</label></div>
			            </p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button></p>
				</fieldset>
				</form>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>