<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getTeslim = $s->g("teslim");
?>

<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-plus-square" aria-hidden="true"></i> Teslim Ekle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( !$s->yetkisi_var("2",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}else{
					$teslim_veren = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
					$teslim_veren_sinif = $s->kullanici($_SESSION["sp_user"],"uye_sinif");
					$teslim_veren_no = $s->kullanici($_SESSION["sp_user"],"uye_okulno");
					$teslim_veren_tur = $s->kullanici($_SESSION["sp_user"],"uye_tur");

					if($teslim_veren_tur=="3"){
						$teslimcibilgi = $teslim_veren_sinif."-".$teslim_veren_no;
					}elseif($teslim_veren_tur=="2"){
						$teslimcibilgi = "ÖĞRETMEN";
					}elseif($teslim_veren_tur=="1"){
						$teslimcibilgi = "İDARECİ";
					}else{
						$teslimcibilgi = $teslim_veren_sinif."-".$teslim_veren_no;
					}
				?>
				<form method="POST" action="" id="addTeslim" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>
					<input type="hidden" name="teslimid" value="<?php echo $getTeslim; ?>" />
					  <div class="es-search-box-all"><label for="your_isbn">Eser ISBN:</label><br />
			          <input type="text" id="your_isbn" name="a1" value="" placeholder="Eser ISBN..." />
			          <div class="es-search-box es-search-box1"><ul></ul></div>
			          </div>

			          <p><label for="your_username3">Teslim Eden Üye:</label>
			          <div class="infonotinput"><?php echo $teslim_veren; ?> (<?php echo $teslimcibilgi; ?>)</div></p>

			          <div class="es-search-box-all"><label for="your_username2">Teslim Alanın Okul Numarası:</label><br />
			          <input type="text" id="your_username2" name="a4" value="" placeholder="Teslim alanın okul numarası..." />
			          <div class="es-search-box es-search-box2"><ul></ul></div>
			          </div>

			          <p><label for="datetimepicker">Teslim Ediliş Tarihi:</label><br />
			          <input type="text" id="datetimepicker" name="a51" value="" data-value="<?php echo date("d.m.Y") ?>" placeholder="İade tarihi..." />
			          </p>

			          <p><label for="datetimepicker2">İade Edilecek Tarih:</label><br />
			          <input type="text" id="datetimepicker2" name="a5" value="" placeholder="İade tarihi..." />
			          </p>

			          <p><label for="your_not">Teslim Not(varsa):</label><br />
			          <textarea id="your_not" name="a6" placeholder="Teslimle ilgili notunuz..."></textarea>
			          </p>


			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle ilk"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; TESLİMİ EKLE</button></p>

				</fieldset>
				</form>
				<?php }//if bitiş ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>