<?php
if(!isset($_SESSION)){
	session_start();
}
if( !isset($_SESSION["sp_login"]) ){
  echo "Giriş yapmadan bu sayfayı görüntüleyemezsiniz.";
}else{
$getEser = $s->g("eser");
?>

<div class="main-content">
					
	<div class="hizala">

		<h1 class="page-title"><i class="fa fa-book" aria-hidden="true"></i> Eser Düzenle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<p class="firstp" style="margin-bottom:15px"><a href="?sayfa=eserler">&laquo; Eserlere Dön</a></p>
				<?php
				if( !$s->eser_var_mi($getEser) ){
					echo "<h4 style='color:#C93131'>HATA! Böyle bir eser yok.</h4>";
				}elseif( !$s->yetkisi_var("1",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
					echo "<h4 style='color:#C93131'>HATA! Yetkiniz yok!</h4>";
				}else{
				?>
				<form method="POST" action="" id="updateEser" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="eserid" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_id")); ?>" />
				<fieldset>
					<legend><?php echo htmlspecialchars($s->eser($getEser,"eser_ad")); ?></legend>
					  <p><label for="select_element">Eser Fotoğrafı:</label><br />
			           
			          <?php if( empty($s->eser($getEser,"eser_foto")) ){ ?>
			          <input type="file" id="select_element" name="foto">
			          <?php }else{ ?>
			          <div class="hasFoto clearfix">
			          	<div class="foto"><img src="<?php echo URL; ?>/uploads/eserler/<?php echo htmlspecialchars($s->eser($getEser,"eser_foto")); ?>" width="103" height="160"></div>
			          	<div class="sil"><a href="javascript:eser_foto_kaldir('<?php echo htmlspecialchars($s->eser($getEser,"eser_id")); ?>');"><i class="fa fa-trash" aria-hidden="true"></i> Fotoğrafı Kaldır</a></div>
			          </div>
			          <?php } ?>
			           </p>

			           <p><label for="your_yer">Eser Yeri:</label><br />
			          <input type="text" id="your_yer" name="a_yer" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_yer")); ?>" placeholder="Eserin kütüphanedeki yeri..." />
			          </p>

			           <p><label for="your_isbn">ISBN:</label><br />
			          <input type="text" id="your_isbn" name="a6" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_isbn")); ?>" placeholder="Eserin ISBN kodu..." /><a class="button" style="display:inline-block;padding:4px;padding-left:6px;padding-right:6px;font-size:14px;" onclick="fillISBN();"><i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp;ISBN'den Doldur</a> <a class="button" style="display:inline-block;padding:4px;padding-left:6px;padding-right:6px;font-size:14px;" onclick="downloadISBN();"><i class="fa fa-download" aria-hidden="true"></i> &nbsp;ISBN'den Fotoğrafı İndir</a></p>

					  <p><label for="your_username">Eser Adı:</label><br />
			          <input type="text" id="your_username" name="a1" value="<?php echo trim(htmlspecialchars($s->eser($getEser,"eser_ad"))); ?>" placeholder="Eser adı..." /></p>

					  <p><label for="your_name">Eser Yazarı:</label><br />
			          <input type="text" id="your_name" name="a2" value="<?php echo trim(htmlspecialchars($s->eser($getEser,"eser_yazar"))); ?>" placeholder="Eser yazarı..." /></p>

			          <p><label for="your_email">Eser Yayınevi:</label><br />
			          <input type="text" id="your_email" name="a3" value="<?php echo trim(htmlspecialchars($s->eser($getEser,"eser_yayinevi"))); ?>" placeholder="Eser yayınevi..." /></p>

			          <p><label for="your_no">Eser Kategorisi:</label><br />
			          <select name="a4">
			          	<?php
			          	$cat_cek = $s->query("SELECT * FROM eserler_kategoriler ORDER BY cat_ad ASC");
			          	$disable_aktif_diger = false;
			          	while($c = mysqli_fetch_assoc($cat_cek)){
			          		$cat_id = $c["cat_id"];
			          		$cat_ad = $c["cat_ad"];
			          		$eser_cat = $s->eser($getEser,"eser_cat");
			          		$aktif = '';
			          		$aktif_diger = '';
			          		if($cat_id==$eser_cat){
			          			$aktif = ' selected="selected"';
			          			$disable_aktif_diger = true;
			          		}
			          	?>
			          	<option value="<?php echo $cat_id; ?>"<?php echo $aktif; ?>><?php echo htmlspecialchars($cat_ad); ?></option>
			          	<?php } 
			          	if(!$disable_aktif_diger){
			          		$aktif_diger = ' selected="selected"';
			          	}else{
			          		$aktif_diger = '';
			          	}
			          	?>
			          	<option value="none"<?php echo $aktif_diger; ?>>Diğer</option>
			          </select></p>

			          <p><label for="your_adet">Eserin Adedi:</label><br />
			          <input type="number" id="your_adet" name="a7" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_adet")); ?>" placeholder="Bu eserden kaç tane var..." />
			          <div class="infonotinput" style="padding-top:-10px">(<?php
			          $teslim_ara = $s->query("SELECT * FROM teslimler WHERE eser_id='$getEser' && teslim_durumu=0")->num_rows;
							$mevcut = (int)$s->eser($getEser,"eser_adet")-(int)$teslim_ara;
							echo $mevcut;
						?> adet mevcut)</div>
			          </p>

			          <p><label for="your_adet">Eserin Sayfa Sayısı:</label><br />
			          <input type="text" id="your_sayfa" name="asayfa" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_sayfa")); ?>" placeholder="Bu eserin sayfa sayısı..." />
			          </p>	

			          <p><label for="your_adet">Eserin Fiyatı:</label><br />
			          <input type="text" id="your_fiyat" name="afiyat" value="<?php echo htmlspecialchars($s->eser($getEser,"eser_fiyat")); ?>" placeholder="Bu eserin fiyatı..." />
			          </p>		          

			          <input type="hidden" name="kullanimda" value="<?php echo htmlspecialchars($teslim_ara); ?>">

			          <p><label for="your_not">Not(varsa):</label><br />
			          <textarea id="your_not" name="a8" placeholder="Eserle ilgili notunuz..."><?php echo htmlspecialchars($s->eser($getEser,"eser_not")); ?></textarea>
			          </p>

			 		  <div class="clearfix"></div>
			          <p><button class="button guncelle"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button> <?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){ ?>&nbsp; <button class="button delbut" onclick="eser_sil('<?php echo $getEser; ?>');return false;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; ESERİ SİL</button><?php } ?></p>
				</fieldset>
				</form>
				<?php }//if bitiş ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>