<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){
		$a1 = $s->p("a1"); //arşiv adı
		$onay = $s->p("onay"); //onay

		if( !$a1 || !$onay ){
			echo "Lütfen bütün gerekli alanları doldurun!";
		}elseif( $onay != "yes" ){
			echo "Lütfen onaylayın!";
		}else{
		$teslim_var_mi = $s->query("SELECT * FROM teslimler")->num_rows;
		if($teslim_var_mi>0){

			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$a1 adıyla tüm teslimleri arşivledi.";

			$sade_siniflar = array();
			$siniflar = array();
			$cek_siniflar_q = $s->query("SELECT ogrenci_sinif FROM ogrenciler");
			while($ccc = mysqli_fetch_assoc($cek_siniflar_q)){
				$sinifimiz = $ccc["ogrenci_sinif"];
				$sinif_kiz_sayisi = 0;
				$sinif_erkek_sayisi = 0;
				$pushveri = "";
				if(!in_array($sinifimiz, $sade_siniflar)){
					$sinif_kiz_sayisi = $s->query("SELECT * FROM ogrenciler WHERE LOWER(ogrenci_cinsiyet)='kız' && ogrenci_sinif='$sinifimiz'")->num_rows;
					$sinif_erkek_sayisi = $s->query("SELECT * FROM ogrenciler WHERE LOWER(ogrenci_cinsiyet)='erkek' && ogrenci_sinif='$sinifimiz'")->num_rows;
					$pushveri = $sinifimiz."-".$sinif_kiz_sayisi."-".$sinif_erkek_sayisi;
					array_push($siniflar, $pushveri);
					array_push($sade_siniflar, $sinifimiz);
				}else{
					continue;
				}
			}

			$siniflar_yazi_formati = "";

			$i = 0;
			foreach ($siniflar as $sinif) {
				if($i == count($siniflar)-1){
					$virgul = "";
				}else{
					$virgul = ",";
				}
				$siniflar_yazi_formati .= $sinif.$virgul;
				$i++;
			}

			$now = time();

			//arşiv oluştur
			$olustur = $s->query("INSERT INTO arsivler(arsiv_ad,arsiv_siniflar,arsiv_olusturma_tarihi) VALUES ('$a1','$siniflar_yazi_formati','$now')");
			if($olustur){

				$cc = mysqli_fetch_array($s->query("SELECT id FROM arsivler WHERE arsiv_olusturma_tarihi='$now'"));
				$arsiv_id = $cc["id"];

				$query_all_teslimler = $s->query("SELECT * FROM teslimler ORDER BY teslim_id DESC");

				while($a = mysqli_fetch_assoc($query_all_teslimler)){

					//eseri al
					$eser_id = $a["eser_id"];

					$eser_cek = mysqli_fetch_array($s->query("SELECT * FROM eserler WHERE eser_id='$eser_id'"));
					$eser_isbn = $eser_cek["eser_isbn"];
					$eser_ad = $eser_cek["eser_ad"];
					$eser_yazar = $eser_cek["eser_yazar"];
					$eser_yayinevi = $eser_cek["eser_yayinevi"];

					//teslim alan öğrenciyi al
					$teslim_alan_no = $a["teslim_alan_no"];

					$ogrenci_cek = mysqli_fetch_array($s->query("SELECT * FROM ogrenciler WHERE ogrenci_no='$teslim_alan_no'"));
					$ogrenci_ad = $ogrenci_cek["ogrenci_ad"];
					$ogrenci_sinif = $ogrenci_cek["ogrenci_sinif"];
					$ogrenci_no = $ogrenci_cek["ogrenci_no"];
					$ogrenci_cinsiyet = $ogrenci_cek["ogrenci_cinsiyet"];

					//teslim veren üyeyi al
					$teslim_veren = $a["teslim_veren"];

					$uye_cek = mysqli_fetch_array($s->query("SELECT * FROM uyeler WHERE uye_id='$teslim_veren'"));
					$uye_ad = $uye_cek["uye_adsoyad"];
					$uye_sinif = $uye_cek["uye_sinif"];
					$uye_no = $uye_cek["uye_okulno"];

					//teslim verim tarihi
					$teslim_verim_tarihi = $a["teslim_verim_tarihi"];

					//teslim alım tarihi
					$teslim_alim_tarihi = $a["teslim_alim_tarihi"];

					//iade edildi mi
					$iade_edildi_mi = $a["teslim_durumu"];

					//iade ediliş tarihi
					$iade_edildi_tarih = $a["teslim_alindi_tarih"];
					
					//kime iade edildi
					$iade_edildi_kim = $a["teslim_alindi_kim"];
					$i_uye_cek = mysqli_fetch_array($s->query("SELECT * FROM uyeler WHERE uye_id='$iade_edildi_kim'"));
					$i_uye_ad = $i_uye_cek["uye_adsoyad"];
					$i_uye_sinif = $i_uye_cek["uye_sinif"];
					$i_uye_no = $i_uye_cek["uye_okulno"];

					//teslim not
					$teslim_not = $a["teslim_not"];

					$s->query("INSERT INTO teslimler_arsiv(arsiv_id,
						eser_isbn,
						eser_ad,
						eser_yazar,
						eser_yayinevi,
						teslim_alan_ad,
						teslim_alan_sinif,
						teslim_alan_no,
						teslim_alan_cinsiyet,
						teslim_veren_ad,
						teslim_veren_sinif,
						teslim_veren_no,
						teslim_verim_tarihi,
						teslim_alim_tarihi,
						teslim_alindi_mi,
						teslim_alindi_tarih,
						teslim_alindi_ad,
						teslim_alindi_sinif,
						teslim_alindi_no,
						teslim_not) VALUES ('$arsiv_id',
						'$eser_isbn',
						'$eser_ad',
						'$eser_yazar',
						'$eser_yayinevi',
						'$ogrenci_ad',
						'$ogrenci_sinif',
						'$ogrenci_no',
						'$ogrenci_cinsiyet',
						'$uye_ad',
						'$uye_sinif',
						'$uye_no',
						'$teslim_verim_tarihi',
						'$teslim_alim_tarihi',
						'$iade_edildi_mi',
						'$iade_edildi_tarih',
						'$i_uye_ad',
						'$i_uye_sinif',
						'$i_uye_no',
						'$teslim_not')");

				}

				$teslimleri_sil = $s->query("DELETE FROM teslimler");
				$s->query("ALTER TABLE teslimler AUTO_INCREMENT = 1");
				//$teslimleri_sil = true;
				if($teslimleri_sil){
					$s->eylem($eylem_yapan,$eylem_icerik);
					echo "ok";
				}else{
					echo "veritabanı hatası!";
				}

			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
		echo "HATA! Hiçbir teslim bulunamadı!";
		}

		}

	}else{
		echo "HATA! Yetkiniz yok!";
	}
}
?>