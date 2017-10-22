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

		<h1 class="page-title"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Eser Kategorileri</h1>

		<div class="page-content">

			<?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){ ?>
			<form method="post" action="" id="addCatForm" onsubmit="return false;" autocomplete="off">
				<input type="text" name="a1" id="addCat" placeholder="Kategori Adı..." value="" style="padding:4px" />
				<button class="button" id="addCatBut" style="padding:4px;font-size:14px" onclick="addCateg();">Kategori Ekle</button>
			</form>
			<?php } ?>
			
			<div class="search-area">

				<div class="search-content user-search-content clearfix">
					<ul class="user-search-container">
						<?php
						$kategoriler = $s->query("SELECT * FROM eserler_kategoriler ORDER BY cat_ad ASC");
						$yetkiler = $s->kullanici($_SESSION["sp_user"],"uye_eylemler");
						while($a = mysqli_fetch_assoc($kategoriler)){ 
							$cat_id = $a["cat_id"];
							$kac_eser_varr = $s->query("SELECT eser_cat FROM eserler WHERE eser_cat='$cat_id'")->num_rows;
							$kac_eser_var_adet_c = mysqli_fetch_array($s->query("SELECT eser_adet FROM eserler WHERE eser_cat='$cat_id'"));
							$kac_eser_var_adet = $kac_eser_var_adet_c["eser_adet"];
							$kac_eser_var = $kac_eser_varr+(int)$kac_eser_var_adet;
						if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
							$duzenle = '<a href="#" onclick=\'editCat("'.$cat_id.'","'.htmlspecialchars($a["cat_ad"]).'","'.$kac_eser_var.'");return false;\'><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Düzenle</a>';
						}else{
							$duzenle = '';
						}
	
						?>
						<li id="cat_<?php echo $cat_id; ?>">
							<div class="right" style="margin-left:0;padding:17px">
								<div class="oneinf" id="cat_ad_<?php echo $cat_id; ?>"><?php echo htmlspecialchars($a["cat_ad"]); ?></div>
								<div class="oneinf"><span>(<?php echo $kac_eser_var; ?> Eser)</span><?php echo $duzenle; ?></div>
							</div>
						</li>
						<?php } //while bitiş 
						$kac_eser_varr = $s->query("SELECT eser_cat FROM eserler WHERE eser_cat=0")->num_rows;
						$kac_eser_var_adet_c = mysqli_fetch_array($s->query("SELECT eser_adet FROM eserler WHERE eser_cat=0"));
						$kac_eser_var_adet = $kac_eser_var_adet_c["eser_adet"];
						$kac_eser_var_diger = $kac_eser_varr+(int)$kac_eser_var_adet;
						?>

						<li id="cat_0">
							<div class="right" style="margin-left:0;padding:17px">
								<div class="oneinf" id="cat_ad_0">Diğer</div>
								<div class="oneinf"><span>(<?php echo $kac_eser_var_diger; ?> Eser)</span></div>
							</div>
						</li>

					</ul>

				</div>

			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>