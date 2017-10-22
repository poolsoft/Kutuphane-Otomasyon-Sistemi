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

		<h1 class="page-title"><i class="fa fa-wrench" aria-hidden="true"></i> Site Ayarları</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( !$s->yetkisi_var("6",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}else{
				?>
				<form method="POST" action="" id="editSistem" onsubmit="return false;" autocomplete="off">
				<fieldset>
					<legend></legend>
					  <p><label for="your_username">Site İsmi:</label><br />
			          <input type="text" name="a1" id="your_username" value="<?php echo htmlspecialchars($s->get_site("site_isim")); ?>" placeholder="Site ismi..." /></p>

					  <p><label for="your_name">Site Okul İsmi:</label><br />
			          <input type="text" name="a2" id="your_name" value="<?php echo htmlspecialchars($s->get_site("site_okul")); ?>" placeholder="Site okul ismi..." /></p>

			          <p><label for="your_email">Site Tanımı:</label><br />
			          <input type="text" name="a3" id="your_email" value="<?php echo htmlspecialchars($s->get_site("site_desc")); ?>" placeholder="Site tanımı..." /></p>

			          <p><label for="your_pass">Site URL(gerekmedikçe değiştirmeyin!):</label><br />
			          <input type="text" name="a4" id="your_pass" value="<?php echo htmlspecialchars($s->get_site("site_url")); ?>" placeholder="Site URL..." /></p>

			          <p><label for="your_pass2">Site Tema:</label><br />
			          <input type="text" name="a5" id="your_pass2" value="<?php echo htmlspecialchars($s->get_site("site_tema")); ?>" placeholder="Site teması..." /></p>

			          <p><label for="select_element2">Site Durumu:</label><br />
			          <select name="a6" id="select_element2">
			          	<option value="1"<?php if($s->get_site("site_durum")=="1"){echo ' selected="selected"';} ?>>Açık</option>
			          	<option value="2"<?php if($s->get_site("site_durum")!="1"){echo ' selected="selected"';} ?>>Bakımda</option>
			          </select>
			          </p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle ilk"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button></p>
				</fieldset>
				</form>
				<?php } ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>