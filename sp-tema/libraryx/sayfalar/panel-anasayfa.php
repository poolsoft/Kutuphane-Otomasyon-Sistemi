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

		<h1 class="page-title"><i class="fa fa-home" aria-hidden="true"></i> Ana Sayfa</h1>

		<div class="page-content">
			
			<div class="boxes">
				<div class="box">
					<h1><i class="fa fa-bar-chart" aria-hidden="true"></i> İstatistikler</h1>
					<div class="cont">
						<div class="stats">
							<?php
								$toplam = 0;
								$toplam_icin_query = $s->query("SELECT * FROM eserler");
								while($a = mysqli_fetch_assoc($toplam_icin_query)){
									$adet = $a["eser_adet"];
									$toplam = $toplam+(int)$adet;
								}
								$teslimde = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=0")->num_rows;
								$mevcut = (int)$toplam-(int)$teslimde;
							?>
							<?php
							$toplam_teslim = $s->query("SELECT teslim_id FROM teslimler")->num_rows;
							$kitap_alan_erkek = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
						JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
						WHERE LOWER(a.ogrenci_cinsiyet) = 'erkek'")->num_rows;
							$kitap_alan_kiz = $s->query("SELECT p.teslim_alan_no, a.ogrenci_cinsiyet, a.ogrenci_no FROM teslimler AS p
						JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
						WHERE LOWER(a.ogrenci_cinsiyet) = 'kız'")->num_rows;
							if($toplam_teslim==0){
						    	$erkek_yuzde = 0;
						    	$kiz_yuzde = 0;
						    }else{
							    $erkek_bol = $kitap_alan_erkek/$toplam_teslim;
								$erkek_yuzde = round($erkek_bol*100);
								$kiz_bol = $kitap_alan_kiz/$toplam_teslim;
								$kiz_yuzde = round($kiz_bol*100);
						    }
							?>
							<?php
							$siniflar = array();
							$cek_siniflar_q = $s->query("SELECT ogrenci_sinif FROM ogrenciler");
							while($ccc = mysqli_fetch_assoc($cek_siniflar_q)){
								if(!in_array($ccc["ogrenci_sinif"], $siniflar)){
									array_push($siniflar, $ccc["ogrenci_sinif"]);
								}else{
									continue;
								}
							}

							$sinif_yuzdeleri = array();
							$en_yuksek_sinif_cek = "NaN";
							$en_dusuk_sinif_cek = "NaN";
							$en_yuksek_sinif = 0;
							$en_dusuk_sinif = 0;
							foreach ($siniflar as $sinif){
							$kitap_alan = $s->query("SELECT p.teslim_alan_no, a.ogrenci_no, a.ogrenci_sinif FROM teslimler AS p
							JOIN ogrenciler AS a ON p.teslim_alan_no = a.ogrenci_no
							WHERE a.ogrenci_sinif = '$sinif'")->num_rows;
							if($toplam_teslim==0){
							    $sinif_yuzde = 0;
							}else{
							    $yuzde_bol = $kitap_alan/$toplam_teslim;
								$sinif_yuzde = (round($yuzde_bol,1))*100;
							}
							array_push($sinif_yuzdeleri, (int)$sinif_yuzde);
							$en_yuksek_sinif = max($sinif_yuzdeleri);
							$en_yuksek_sinif_yer = array_search($en_yuksek_sinif, $sinif_yuzdeleri);
							$en_yuksek_sinif_cek = $siniflar[$en_yuksek_sinif_yer];
							$en_dusuk_sinif = min($sinif_yuzdeleri);
							$en_dusuk_sinif_yer = array_search($en_dusuk_sinif, $sinif_yuzdeleri);
							$en_dusuk_sinif_cek = $siniflar[$en_dusuk_sinif_yer];
							}
							$kitap_alan_cok = $s->query("SELECT teslim_id FROM teslimler WHERE teslim_alan_no IN (SELECT ogrenci_no FROM ogrenciler WHERE ogrenci_sinif='$en_yuksek_sinif_cek')")->num_rows;
							$kitap_alan_az = $s->query("SELECT teslim_id FROM teslimler WHERE teslim_alan_no IN (SELECT ogrenci_no FROM ogrenciler WHERE ogrenci_sinif='$en_dusuk_sinif_cek')")->num_rows;
							?>
							<div class="stat"><span>Toplam Eser:</span> <span><?php echo $toplam; ?></span></div>
							<div class="stat"><span>İade Edilecek Eser:</span> <span><?php echo $teslimde; ?></span></div>
							<div class="stat"><span>Mevcut Eser:</span> <span><?php echo $mevcut; ?></span></div>
							<div class="stat"><span>En Çok Okuyan Sınıf:</span> <span><?php echo htmlspecialchars($en_yuksek_sinif_cek); ?> (%<?php echo $en_yuksek_sinif; ?>) <span style="font-weight:400">(<?php echo $kitap_alan_cok; ?> teslim)</span></span></div>
							<div class="stat"><span>En Az Okuyan Sınıf:</span> <span><?php echo htmlspecialchars($en_dusuk_sinif_cek); ?> (%<?php echo $en_dusuk_sinif; ?>) <span style="font-weight:400"> (<?php echo $kitap_alan_az; ?> teslim)</span></span></div>
							<div class="stat"><span>Erkeklerin Okuma Oranı:</span> <span>%<?php echo $erkek_yuzde; ?> <span style="font-weight:400">(<?php echo $kitap_alan_erkek; ?> teslim)</span></span></div>
							<div class="stat"><span>Kızların Okuma Oranı:</span> <span>%<?php echo $kiz_yuzde; ?> <span style="font-weight:400">(<?php echo $kitap_alan_kiz; ?> teslim)</span></span></div>
						</div>
					</div>
				</div>
				<div class="box">
					<h1><i class="fa fa-firefox" aria-hidden="true"></i> Hızlı Teslim</h1>
					<div class="cont">
						<form method="POST" action="" id="addQuickTeslim" onsubmit="return false;" autocomplete="off">
						<input type="hidden" name="teslimid" value="" />
						<input type="hidden" name="a6" value="" />

						<div class="fast-teslim">
							<div class="birim es-search-boxa-all">
								<div class="sol">ISBN:</div>
								<div class="sag"><input type="text" name="a1" id="your_isbn"></div>
								<div class="es-search-boxa es-search-boxa1"><ul></ul></div>
							</div>
							<div class="birim es-search-boxa-all">
								<div class="sol">Okul No:</div>
								<div class="sag"><input type="text" name="a4" id="your_username2"></div>
								<div class="es-search-boxa es-search-boxa2"><ul></ul></div>
							</div>
							<div class="birim">
								<div class="sol">Teslim Tarihi:</div>
								<div class="sag"><input type="text" name="a51" id="datetimepicker" data-value="<?php echo date("d.m.Y"); ?>"></div>
							</div>
							<div class="birim">
								<div class="sol">İade Tarihi:</div>
								<div class="sag"><input type="text" name="a5" id="datetimepicker2"></div>
							</div>
							<div class="birim" style="margin-top:15px">
								<button class="ilk but">Teslim Et</button>
							</div>
						</div>
						</form>
					</div>
				</div>
				<div class="box">
					<h1><i class="fa fa-exclamation-circle" aria-hidden="true"></i> İade Tarihi Geçenler</h1>
					<div class="cont">
						<ul>
						<?php
							$a = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=0 ORDER BY teslim_alim_tarihi ASC");
							while($b = mysqli_fetch_assoc($a)){
							$teslim_alim_tarihi = $b["teslim_alim_tarihi"];
							$tim = time();
							if( (int)$tim > (int)$teslim_alim_tarihi ){
								$teslim_alan_no = $b["teslim_alan_no"];
								$teslim_alan = $s->ogrencino($teslim_alan_no,"ogrenci_ad");
								$teslim_alan_sinif = $s->ogrencino($teslim_alan_no,"ogrenci_sinif");
								$teslim_alindi_ham = $b["teslim_alim_tarihi"];
								$teslim_eser = $b["eser_id"];
								$eser_adi = $s->eser($teslim_eser,"eser_ad");
								$kalan_zaman = floor(((int)$tim-(int)$teslim_alindi_ham) / (60*60*24));
								if($kalan_zaman==0){
									continue;
								}
								$teslim_alindi = $s->tr_dateTime($teslim_alindi_ham);
						?>
							<li>
							<a href="?sayfa=teslim-duzenle&teslim=<?php echo $b["teslim_id"]; ?>">
								<div>Alan: <b><?php echo htmlspecialchars($teslim_alan); ?></b> (<?php echo htmlspecialchars($teslim_alan_sinif); ?>-<?php echo htmlspecialchars($teslim_alan_no); ?>)</div>
								<div>Eser: <b><?php echo htmlspecialchars($eser_adi); ?></b></div>
								<div>Son İade Tarihi: <b><?php echo $teslim_alindi; ?> <span style="color:#DE2C2C">(<?php echo $kalan_zaman; ?> GÜN GEÇTİ)</span></b></div>
							</a>
							</li>
							<?php }//if bitiş ?>	
							<?php }//while bitiş ?>
						</ul>
					</div>
				</div>
				<div class="box">
					<h1><i class="fa fa-info-circle" aria-hidden="true"></i> İade Tarihi Yaklaşanlar</h1>
					<div class="cont">
						<ul>
							<?php
							$a = $s->query("SELECT * FROM teslimler WHERE teslim_durumu=0 ORDER BY teslim_alim_tarihi ASC");
							while($b = mysqli_fetch_assoc($a)){
							$teslim_alindi_ham = $b["teslim_alim_tarihi"];
							$teslim_alim_tarihi = $b["teslim_alim_tarihi"];
							$tim = time();
							$kalan_zaman = floor(((int)$teslim_alindi_ham-(int)$tim) / (60*60*24))+1;
							if( $kalan_zaman>=0 && $kalan_zaman<=20 ){
								$teslim_alan_no = $b["teslim_alan_no"];
								$teslim_alan = $s->ogrencino($teslim_alan_no,"ogrenci_ad");
								$teslim_alan_sinif = $s->ogrencino($teslim_alan_no,"ogrenci_sinif");
								$teslim_eser = $b["eser_id"];
								$eser_adi = $s->eser($teslim_eser,"eser_ad");
								$kalan_zamann = floor(((int)$teslim_alindi_ham-(int)$tim) / (60*60*24))+1;
								if($kalan_zamann>0){
									$kalan_zaman = $kalan_zaman.' GÜN KALDI';
								}else{
									$kalan_zaman = 'BUGÜN TESLİM';
								}
								$teslim_alindi = $s->tr_dateTime($teslim_alindi_ham);
						?>
							<li>
							<a href="?sayfa=teslim-duzenle&teslim=<?php echo $b["teslim_id"]; ?>">
								<div>Alan: <b><?php echo htmlspecialchars($teslim_alan); ?></b> (<?php echo htmlspecialchars($teslim_alan_sinif); ?>-<?php echo htmlspecialchars($teslim_alan_no); ?>)</div>
								<div>Eser: <b><?php echo htmlspecialchars($eser_adi); ?></b></div>
								<div>Son İade Tarihi: <b><?php echo $teslim_alindi; ?> <span style="color:#08977E">(<?php echo $kalan_zaman; ?>)</span></b></div>
							</a>
							</li>
							<?php }//if bitiş ?>	
							<?php }//while bitiş ?>
						</ul>
					</div>
				</div>
				<div class="box fullbox" style="margin-bottom:80px">
					<h1><i class="fa fa-line-chart" aria-hidden="true"></i> Grafikler <a href="?sayfa=grafikler" title="Tüm grafikleri görüntüle">(Tümünü Görüntüle)</a></h1>
					<div class="cont">
						
						<div class="graph" style="text-align:center;">
							<div id="chartContainer1" style="width: 80%; margin:10px auto; height: 250px;display: inline-block;"></div>
							<div id="chartContainer2" style="width: 80%; margin:10px auto; height: 250px;display: inline-block;"></div>
							<div id="chartContainer3" style="width: 90%; margin:10px auto; height: 250px;display: inline-block;"></div>
						</div>

					</div>
				</div>
			</div>

		</div> <!-- .page-content -->
	
	</div><!-- .hizala -->

</div><!-- .main-content -->
<?php } ?>