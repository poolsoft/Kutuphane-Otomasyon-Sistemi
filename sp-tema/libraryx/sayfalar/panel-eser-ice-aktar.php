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

		<h1 class="page-title"><i class="fa fa-upload" aria-hidden="true"></i> Eserleri İçe Aktar</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur") == "1" ||
					$s->kullanici($_SESSION["sp_user"],"uye_tur") == "2" ){
				?>
				<form method="POST" action="" id="eserAktar" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>

					  <p><label for="your_file">Dosya:</label><br />
			          <input type="file" name="a1" id="your_file" value="" /></p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; ESERLERİ AKTAR</button></p>
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