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

		<h1 class="page-title"><i class="fa fa-archive" aria-hidden="true"></i> Teslimleri Arşivle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur") == "1" ||
					$s->kullanici($_SESSION["sp_user"],"uye_tur") == "2" ){
				?>
				<form method="POST" action="" id="arsivOlustur" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>
					  <p><label for="your_username">Arşiv Adı:</label><br />
			          <input type="text" name="a1" id="your_username" value="" placeholder="Arşivin adı..." /></p>

					  <p>
			          <input type="checkbox" name="onay" value="yes" id="xxxx"> <label for="xxxx"><span style="font-weight:bold;font-size:16px;color:#A91B1B;text-decoration:underline">Bu arşivi oluşturduktan sonra hiçbir teslimin artık sistemin ana sayfasında gözükmeyeceğinin farkındayım.</span></label></p>
			          <br />
			 		  <div class="clearfix"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; TÜM TESLİMLERİ ARŞİVLE</button></p>
				</fieldset>
				</form>
				<?php }else{
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				} ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>