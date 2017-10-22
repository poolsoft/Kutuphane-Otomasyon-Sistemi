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

		<h1 class="page-title"><i class="fa fa-book" aria-hidden="true"></i> Teslim Düzenle</h1>

		<div class="page-content">
			
			<div class="uye-duzenle">
				<p class="firstp" style="margin-bottom:-20px"><a href="?sayfa=anasayfa">&laquo; Ana Sayfaya Dön</a></p>
				<p class="firstp firstpa" style="margin-bottom:15px"><a href="?sayfa=teslimler">&laquo; Teslimlere Dön</a></p>
				<?php
				if( !$s->teslim_var_mi($getTeslim) ){
					echo "<h4 style='color:#C93131'>HATA! Böyle bir teslim yok.</h4>";
				}else{
					if( !$s->yetkisi_var("2",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){
						$yetkisi = ' disabled="disabled"';
					}else{
						$yetkisi = "";
					}
					$eserid = $s->teslim($getTeslim,"eser_id");
					if( !empty($s->eser($eserid,"eser_foto")) ){
						$eser_foto = TEMA_URL."/images/eserler/".$s->eser($eserid,"eser_foto");
					}else{
						$eser_foto = TEMA_URL."/images/nofoto.png";
					}
					$teslim_edildi_ham = $s->teslim($getTeslim,"teslim_verim_tarihi");
					$teslim_edildi = date('d.m.Y',$teslim_edildi_ham);
					$teslim_edildi_tr = $s->tr_dateTime($teslim_edildi_ham);
					$teslim_alindi_ham = $s->teslim($getTeslim,"teslim_alim_tarihi");
					$teslim_alindi = date('d.m.Y',$teslim_alindi_ham);
					$teslim_alindi_tr = $s->tr_dateTime($teslim_alindi_ham);
					$gunumuz = time();
					$kac_gun = floor(((int)$teslim_alindi_ham-(int)$teslim_edildi_ham) / (60*60*24));
					$kalan_zaman = floor(((int)$teslim_alindi_ham-(int)$gunumuz) / (60*60*24))+1;
					
					if($kalan_zaman > 0){
						$ne_kadar_kaldi = '('.$kalan_zaman.' gün kaldı)';
					}elseif($kalan_zaman==0){
						$ne_kadar_kaldi = '(Bugün teslim)';
					}else{
						$ne_kadar_kaldi = '('.(-1)*$kalan_zaman.' gün geçti)';
					}

					if( $s->teslim($getTeslim,"teslim_durumu") == "1"  ){
						$tarih = $s->tr_dateTime($s->teslim($getTeslim,"teslim_alindi_tarih"));
						$ne_kadar_kaldi = '<b>'.$tarih.'</b>';
					}

					$teslim_alan_no = $s->teslim($getTeslim,"teslim_alan_no");

					$teslim_alan = $s->ogrencino($teslim_alan_no,"ogrenci_ad");

					$teslim_alan_sinif = $s->ogrencino($teslim_alan_no,"ogrenci_sinif");

					$teslim_veren_ham = $s->teslim($getTeslim,"teslim_veren");
					$teslim_veren = $s->kullanici($teslim_veren_ham,"uye_adsoyad");
					$teslim_veren_sinif = $s->kullanici($teslim_veren_ham,"uye_sinif");
					$teslim_veren_no = $s->kullanici($teslim_veren_ham,"uye_okulno");
					$teslim_veren_tur = $s->kullanici($teslim_veren_ham,"uye_tur");

					if($teslim_veren_tur=="3"){
						$teslimcibilgi = $teslim_veren_sinif."-".$teslim_veren_no;
					}elseif($teslim_veren_tur=="2"){
						$teslimcibilgi = "Öğretmen";
					}elseif($teslim_veren_tur=="1"){
						$teslimcibilgi = "İdareci";
					}else{
						$teslimcibilgi = $teslim_veren_sinif."-".$teslim_veren_no;
					}

					$teslim_alindi_kim = $s->teslim($getTeslim,"teslim_alindi_kim");
					$teslim_alindi_k = $s->kullanici($teslim_alindi_kim,"uye_adsoyad");

					$teslim_alindi_tarih = $s->teslim($getTeslim,"teslim_alindi_tarih");

					$teslim_alindi_bilgi = htmlspecialchars($teslim_alindi_k)." (".$teslimcibilgi.") adlı üyeye ".$s->tr_dateTime($teslim_alindi_tarih)." günü iade edildi.";

					$teslim_alinan_eser = $s->teslim($getTeslim,"eser_id");
					$eserisim = $s->eser($teslim_alinan_eser,"eser_ad");
					$eseryazar = $s->eser($teslim_alinan_eser,"eser_yazar");
					$eserisbn = $s->eser($teslim_alinan_eser,"eser_isbn");

					$teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
					if($teslim_durumu=="1"){
						$updateTeslim = "teslimEdildi";
					}else{
						$updateTeslim = "updateTeslim";
					}

					$kac_gun = floor(((int)$teslim_alindi_ham-(int)$teslim_edildi_ham) / (60*60*24));

				    $kalan_zaman = floor(((int)$teslim_alindi_ham-(int)$teslim_alindi_tarih) / (60*60*24))+1;
				              
				    if($kalan_zaman > 0){
				      $kalan_zamannx = '<span>('.$kalan_zaman.' gün erken)</span>';
				    }elseif($kalan_zaman==0){
				      $kalan_zamannx = '<span>(Gününde)</span>';
				    }else{
				      
				      $kalan_zamannx = '<span>('.(-1)*$kalan_zaman.' gün geç)</span>';
				    }
					
				?>
				<form method="POST" action="" id="<?php echo $updateTeslim; ?>" onsubmit="return false;" autocomplete="off" enctype="multipart/form-data">
				<input type="hidden" name="saf_isbn" value="<?php echo $eserisbn; ?>" />
				<fieldset>
					<legend></legend>
					<input type="hidden" name="teslimid" value="<?php echo $getTeslim; ?>" />

					  <div class="es-search-box-all"><label for="your_isbn">Eser ISBN:</label><br />
			          <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu=="1"){ ?>
			          <div class="infonotinput" style="margin-top:0"><?php echo htmlspecialchars($eserisim); ?><br /><i style="font-size:13px"><?php echo htmlspecialchars($eseryazar); ?></i><br /><span style="font-size:13px;padding-top:15px;display:inline-block">ISBN: <?php echo htmlspecialchars($eserisbn); ?></span></div>
			          <div class="infonotinput" style="background:transparent;"><a target="_blank" href="?sayfa=eser-duzenle&eser=<?php echo htmlspecialchars($teslim_alinan_eser); ?>">Esere Git <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
			          <?php }else{ ?>
			          <input type="text" id="your_isbn" name="a1" value="<?php echo htmlspecialchars($eserisbn); ?>" placeholder="Eser ISBN..."<?php echo $yetkisi; ?> />
			          <div class="es-search-box es-search-box1"><ul></ul></div>
			          <div class="infonotinput" style="margin-top:0px"><?php echo htmlspecialchars($eserisim); ?><br /><i style="font-size:13px"><?php echo htmlspecialchars($eseryazar); ?></i></div>
			          <div class="infonotinput" style="background:transparent;"><a target="_blank" href="?sayfa=eser-duzenle&eser=<?php echo htmlspecialchars($teslim_alinan_eser); ?>">Esere Git <i class="fa fa-external-link" aria-hidden="true"></i></a></div>
			          <?php } ?>
			          </div>

			          <p><label for="your_username3">Teslim Eden Üye:</label>
			          <div class="infonotinput"><?php echo $teslim_veren; ?> (<?php echo $teslimcibilgi; ?>)</div></p>

			            <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu != "1"){ ?>
			          <div class="es-search-box-all"><label for="your_username2">Teslim Alanın Okul Numarası:</label><br />
			          <input type="text" id="your_username2" name="a4" value="<?php echo htmlspecialchars($s->teslim($getTeslim,"teslim_alan_no")); ?>" placeholder="Teslim alanın okul numarası..."<?php echo $yetkisi; ?> />
			          <div class="es-search-box es-search-box2"><ul></ul></div>
			          <div class="infonotinput" style="margin-top:0px"><?php echo htmlspecialchars($s->ogrencino($s->teslim($getTeslim,"teslim_alan_no"),"ogrenci_ad")); ?><br /><i style="font-size:13px"><?php echo htmlspecialchars($s->ogrencino($s->teslim($getTeslim,"teslim_alan_no"),"ogrenci_sinif")); ?></i></div>
			          </div>
			          <?php } ?>

			          <p><label for="datetimepicker">Teslim Ediliş Tarihi:</label>
			          <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu=="1"){ ?>
			          <div class="infonotinput"><?php echo $teslim_edildi_tr; ?></div>
			          <?php }else{ ?>
			          <input type="text" id="datetimepicker" name="a51" data-value="<?php echo $teslim_edildi; ?>" placeholder="Teslim verim tarihi..."<?php echo $yetkisi; ?> />
			          <?php } ?>
			          </p>

			          <p><label for="datetimepicker2">İade Edilecek Tarih:</label><br />
			          <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu=="1"){ ?>
			          <div class="infonotinput"><?php echo $teslim_alindi_tr; ?> (<?php echo $kac_gun; ?> Günlük)</div>
			          <?php }else{ ?>
			          <input type="text" id="datetimepicker2" name="a5" data-value="<?php echo $teslim_alindi; ?>" placeholder="İade tarihi..."<?php echo $yetkisi; ?> />
			          <?php } ?>
			          </p>

			          <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu=="1"){ ?>
			          
			          <p><label for="your_username">İade Edildi:</label>
			          <div class="infonotinput" style="text-align:left"><?php echo $teslim_alindi_bilgi; ?>&nbsp;<?php echo $kalan_zamannx; ?></div></p>

			          <?php } ?>

			          <p><label for="your_not">Teslim Not:</label><br />
			          <?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu=="1"){ 
			          	$teslimnot = $s->teslim($getTeslim,"teslim_not");
			          	if(empty($teslimnot)){
			          		$teslimnotx = "-";
			          	}else{
			          		$teslimnotx = htmlspecialchars($teslimnot);
			          	}
			          ?>
			          <div class="infonotinput"><?php echo $teslimnotx; ?></div>
			          <?php }else{ ?>
			          <textarea id="your_not" name="a6" placeholder="Teslimle ilgili notunuz..." <?php echo $yetkisi; ?>><?php echo htmlspecialchars($s->teslim($getTeslim,"teslim_not")); ?></textarea>
			          <?php } ?>
			          </p>

			          <?php if( $s->yetkisi_var("2",$s->kullanici($_SESSION["sp_user"],"uye_eylemler")) ){ ?>
			 		  <div class="clearfix"></div>
			          <p><?php 
			          $teslim_durumu = $s->teslim($getTeslim,"teslim_durumu");
			          if($teslim_durumu!="1"){ ?><button class="button guncelle ilk"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp; GÜNCELLE</button> &nbsp; <button class="button teslimet" style="margin-top:10px" onclick="iade_onay('<?php echo $getTeslim; ?>','<?php echo $_SESSION["sp_user"]; ?>')"><i class="fa fa-check" aria-hidden="true"></i>&nbsp; İADE EDİLDİ</button> <br /><br /><?php } ?> <?php if($s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){ ?><button class="button delbut" onclick="delete_teslim('<?php echo $getTeslim; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; TESLİMİ SİL</button><?php } ?></p>
			          <?php } ?>
				</fieldset>
				</form>
				<?php }//if bitiş ?>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>