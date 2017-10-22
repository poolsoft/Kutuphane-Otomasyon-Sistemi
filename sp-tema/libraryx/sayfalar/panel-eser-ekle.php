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

		<h1 class="page-title"><i class="fa fa-plus-square" aria-hidden="true"></i> Eser Ekle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<?php
				if( !$s->yetkisi_var("1",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}else{
				?>
				<form method="POST" action="" id="addEser" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<fieldset>
					<legend></legend>
					  <p><label for="select_element">Eser Fotoğrafı:</label><br />
			           
			          <input type="file" id="select_element" name="foto">
			           </p>

			          <p><label for="your_yer">Eser Yeri:</label><br />
			          <input type="text" id="your_yer" name="a_yer" value="" placeholder="Eserin kütüphanedeki yeri..." />
			          </p>

			          <p><label for="your_isbn">ISBN:</label><br />
			          <input type="text" id="your_isbn" name="a6" value="" placeholder="Eserin ISBN kodu..." />
			          <a class="button" style="display:inline-block;padding:4px;padding-left:6px;padding-right:6px;font-size:14px;" onclick="fillISBN();"><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp;ISBN'den Doldur</a> <a class="button" style="display:inline-block;padding:4px;padding-left:6px;padding-right:6px;font-size:14px;" onclick="downloadISBN();"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;ISBN'den Fotoğrafı İndir</a>
			          </p>

					  <p><label for="your_username">Eser Adı:</label><br />
			          <input type="text" id="your_username" name="a1" value="" placeholder="Eser adı..." /></p>

					  <p><label for="your_name">Eser Yazarı:</label><br />
			          <input type="text" id="your_name" name="a2" value="" placeholder="Eser yazarı..." /></p>

			          <p><label for="your_email">Eser Yayınevi:</label><br />
			          <input type="text" id="your_email" name="a3" value="" placeholder="Eser yayınevi..." /></p>

			          <p><label for="your_no">Eser Kategorisi:</label><br />
			          <select name="a4">
			          	<?php
			          	$cat_cek = $s->query("SELECT * FROM eserler_kategoriler ORDER BY cat_ad ASC");
			          	while($c = mysqli_fetch_assoc($cat_cek)){
			          		$cat_id = $c["cat_id"];
			          		$cat_ad = $c["cat_ad"];
			          	?>
			          	<option value="<?php echo $cat_id; ?>"><?php echo $cat_ad; ?></option>
			          	<?php } ?>
			          	<option value="none" selected="selected">Diğer</option>
			          </select></p>

			          <p><label for="your_adet">Eserin Adedi:</label><br />
			          <input type="number" id="your_adet" name="a7" value="" placeholder="Bu eserden kaç tane var..." />
			          </p>

			          <p><label for="your_adet">Eserin Sayfa Sayısı:</label><br />
			          <input type="text" id="your_sayfa" name="asayfa" value" placeholder="Bu eserin sayfa sayısı..." />
			          </p>

			          <p><label for="your_adet">Eserin Fiyatı:</label><br />
			          <input type="text" id="your_fiyat" name="afiyat" value="" placeholder="Bu eserin fiyatı..." />
			          </p>

			          <p><label for="your_not">Not(varsa):</label><br />
			          <textarea id="your_not" name="a8" placeholder="Eserle ilgili notunuz..."></textarea>
			          </p>

			 		  <div class="clearfix" style="height:10px"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; ESERİ EKLE</button></p>
				</fieldset>
				</form>
				<?php }//if bitiş ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>