<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getArsiv = $s->g("arsiv");
?>

<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Arşiv Düzenle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<p class="firstp" style="margin-bottom:15px"><a href="?sayfa=arsivler">&laquo; Arşivlere Dön</a></p>
				<?php
				if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==3 ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}elseif( !$s->arsiv_var_mi($getArsiv) ){
					echo "<h4 style='color:#C93131'>HATA! Böyle bir arşiv yok.</h4>";
				}else{
				?>
				<form method="POST" action="" id="updateArsiv" onsubmit="return false;" autocomplete="off">
				<input type="hidden" name="arsiv_id" value="<?php echo $getArsiv; ?>" />
				<fieldset>
					<legend></legend>
					  <p><label for="your_username">Arşiv Adı:</label><br />
			          <input type="text" name="a1" id="your_username" value="<?php echo htmlspecialchars($s->arsiv($getArsiv,"arsiv_ad")); ?>" placeholder="Arşiv adı..." /></p>

			 		  <div class="clearfix"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button> <button class="button delbut" onclick="arsiv_sil('<?php echo $getArsiv; ?>');return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; ARŞİVİ SİL</button></p>
				</fieldset>
				</form>
				<?php } ?>
			</div>

			<div class="graph">
				<div id="chartContainer1" style="width: 100%; margin:10px auto; height: 250px;display: inline-block;"></div>
				<div id="chartContainer2" style="width: 100%; margin:10px auto; height: 350px;display: inline-block;"></div>
				<div id="chartContainer3" style="width: 100%; margin:10px auto; height: 350px;display: inline-block;"></div>
				</div>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>