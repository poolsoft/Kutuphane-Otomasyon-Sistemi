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

		<h1 class="page-title"><i class="fa fa-upload" aria-hidden="true"></i> Öğrencileri İçe Aktar</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur") == "1" ||
					$s->kullanici($_SESSION["sp_user"],"uye_tur") == "2" ){
				?>
				<form method="POST" action="" id="ogrenciAktar" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>

					  <p><label for="your_file">Dosya:</label><br />
			          <input type="file" name="a1" id="your_file" value="" /></p>

			          <p><label for="select_element">9. Sınıflar Kaç Şube:</label><br />
			            <select name="a2" id="select_element">
			            <option value="1">1 Şube (A)</option>
			            <option value="2">2 Şube (A,B)</option>
			            <option value="3">3 Şube (A,B,C)</option>
			            <option value="4">4 Şube (A,B,C,D)</option>
			            <option value="5">5 Şube (A,B,C,D,E)</option>
			            <option value="6">6 Şube (A,B,C,D,E,F)</option>
			            <option value="7">7 Şube (A,B,C,D,E,F,G)</option>
			          </select></p>

			          <p><label for="select_element2">10. Sınıflar Kaç Şube:</label><br />
			            <select name="a3" id="select_element2">
			            <option value="1">1 Şube (A)</option>
			            <option value="2">2 Şube (A,B)</option>
			            <option value="3">3 Şube (A,B,C)</option>
			            <option value="4">4 Şube (A,B,C,D)</option>
			            <option value="5">5 Şube (A,B,C,D,E)</option>
			            <option value="6">6 Şube (A,B,C,D,E,F)</option>
			            <option value="7">7 Şube (A,B,C,D,E,F,G)</option>
			          </select></p>

			          <p><label for="select_element3">11. Sınıflar Kaç Şube:</label><br />
			            <select name="a4" id="select_element3">
			            <option value="1">1 Şube (A)</option>
			            <option value="2">2 Şube (A,B)</option>
			            <option value="3">3 Şube (A,B,C)</option>
			            <option value="4">4 Şube (A,B,C,D)</option>
			            <option value="5">5 Şube (A,B,C,D,E)</option>
			            <option value="6">6 Şube (A,B,C,D,E,F)</option>
			            <option value="7">7 Şube (A,B,C,D,E,F,G)</option>
			          </select></p>

			          <p><label for="select_element4">12. Sınıflar Kaç Şube:</label><br />
			            <select name="a5" id="select_element4">
			            <option value="1">1 Şube (A)</option>
			            <option value="2">2 Şube (A,B)</option>
			            <option value="3">3 Şube (A,B,C)</option>
			            <option value="4">4 Şube (A,B,C,D)</option>
			            <option value="5">5 Şube (A,B,C,D,E)</option>
			            <option value="6">6 Şube (A,B,C,D,E,F)</option>
			            <option value="7">7 Şube (A,B,C,D,E,F,G)</option>
			          </select></p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; ÖĞRENCİLERİ AKTAR</button></p>
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