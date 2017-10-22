<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$yetkilerx = $s->kullanici($_SESSION["sp_user"],"uye_eylemler");
?>
<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-plus-square" aria-hidden="true"></i> Üye Ekle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur") == "1" ||
					$s->kullanici($_SESSION["sp_user"],"uye_tur") == "2" ){
				?>
				<form method="POST" action="" id="addUye" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>
					  <p><label for="select_elementx">Üye Fotoğrafı:</label><br />
			           
			          <input type="file" id="select_elementx" name="foto">
			          </p>
					  <p><label for="your_username">Kullanıcı Adı:</label><br />
			          <input type="text" name="a1" id="your_username" value="" placeholder="Kullanıcı adı..." /></p>

					  <p><label for="your_name">Ad:</label><br />
			          <input type="text" name="a2" id="your_name" value="" placeholder="Ad ve soyad..." /></p>

			          <p><label for="your_email">eMail Adresi:</label><br />
			          <input type="text" name="a3" id="your_email" value="" placeholder="eMail adresi..." /></p>

			          <p><label for="your_pass">Şifre:</label><br />
			          <input type="password" name="a4" id="your_pass" placeholder="Şifre***..." /></p>

			          <p><label for="your_pass2">Şifre(tekrar):</label><br />
			          <input type="password" name="a5" id="your_pass2" placeholder="Şifre(tekrar)***..." /></p>

			          <p><label for="select_element">Sınıf:</label><br />
			            <select name="a6" id="select_element">
			            <optgroup label="İdareciler ve Öğretmenler">
			            	<option value="">YOK</option>
			            </optgroup>
			            <optgroup label="9. Sınıflar">
			              <option value="9/A">9/A</option>
			              <option value="9/B">9/B</option>
			              <option value="9/C">9/C</option>
			              <option value="9/D">9/D</option>
			              <option value="9/E">9/E</option>
			              <option value="9/F">9/F</option>
			              <option value="9/G">9/G</option>
			            </optgroup>
			            <optgroup label="10. Sınıflar">
			              <option value="10/A">10/A</option>
			              <option value="10/B">10/B</option>
			              <option value="10/C">10/C</option>
			              <option value="10/D">10/D</option>
			              <option value="10/E">10/E</option>
			              <option value="10/F">10/F</option>
			              <option value="10/G">10/G</option>
			            </optgroup>
			            <optgroup label="11. Sınıflar">
			              <option value="11/A">11/A</option>
			              <option value="11/B">11/B</option>
			              <option value="11/C">11/C</option>
			              <option value="11/D">11/D</option>
			              <option value="11/E">11/E</option>
			              <option value="11/F">11/F</option>
			              <option value="11/G">11/G</option>
			            </optgroup>
			            <optgroup label="12. Sınıflar">
			              <option value="12/A">12/A</option>
			              <option value="12/B">12/B</option>
			              <option value="12/C">12/C</option>
			              <option value="12/D">12/D</option>
			              <option value="12/E">12/E</option>
			              <option value="12/F">12/F</option>
			              <option value="12/G">12/G</option>
			            </optgroup>
			          </select></p>

			          <p><label for="your_no">Okul Numarası(idareciler ve öğretmenler için boş bırakın):</label><br />
			          <input type="number" name="a7" id="your_no" value="" placeholder="Okul numarası..." /></p>

			          <p><label for="select_element2">Üye Türü:</label><br />
			          <select name="a8" id="select_element2">
			          	<option value="1">İdareci</option>
			          	<option value="2">Öğretmen</option>
			          	<option value="3">Öğrenci</option>
			          </select>
			          </p>

			          <p><label for="your_cinsiyet">Cinsiyet:</label><br />
			          <select id="your_cinsiyet" name="a9">
			          	<option value="Erkek">Erkek</option>
			          	<option value="Kız">Kız</option>
			          </select></p>

			          <p style="margin-bottom:10px"><label for="select_elementxx">Eylemler:</label>
			            	<div style="margin-top:-10px"><input type="checkbox" name="y1" id="a1" value="1"<?php if( !$s->yetkisi_var("1",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a1">Eserleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y2" id="a2" value="2"<?php if( !$s->yetkisi_var("2",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a2">Teslimleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y3" id="a3" value="3"<?php if( !$s->yetkisi_var("3",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a3">Öğrencileri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y4" id="a5" value="4"<?php if( !$s->yetkisi_var("4",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a5">Öğretmenleri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y5" id="a6" value="5"<?php if( !$s->yetkisi_var("5",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a6">İdarecileri düzenleyebilir.</label></div>
			            	<div><input type="checkbox" name="y6" id="a4" value="6"<?php if( !$s->yetkisi_var("6",$yetkilerx) ){ echo ' disabled'; } ?>> <label for="a4">Site ayarlarını düzenleyebilir.</label></div>
			            </p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; ÜYEYİ EKLE</button></p>
				</fieldset>
				</form>
				<?php }else{
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>