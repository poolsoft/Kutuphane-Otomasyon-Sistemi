<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$eserid = $s->p("eserid");
	$teslimid = $s->p("teslimid");
	$saf_isbn = $s->p("saf_isbn"); //saf_isbn
	$a1 = $s->p("a1"); //isbn
	$a4 = $s->p("a4"); //no
	$a51 = $s->p("a51"); //verimtarih
	$a5 = $s->p("a5"); //alimtarih
	$a6 = $s->p("a6"); //not


	if(  (!$a1 || !$a51 || !$a5) || !$a4 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a4) ){
		echo "Lütfen sayısal değer girilmesi gereken yere sayısal değer girin!";
	}elseif( !$s->validateDate($a5) ){
		echo "Lütfen geçerli bir iade tarihi girin!";
	}elseif( !$s->validateDate($a51) ){
		echo "Lütfen geçerli bir verim tarihi girin!";
	}elseif( !$s->ogrenci_var_mi_no($a4) ){
		echo "Bu numaraya sahip bir öğrenci yok!";
	}else{

		$alimtarih = strtotime($a5);
		$verimtarih = strtotime($a51);

		if( ((int)$alimtarih < (int)$verimtarih) ){
			echo "İade tarihini veriliş tarihinden daha erken giremezsiniz!";
		}else{

				if( $s->query("SELECT * FROM eserler WHERE eser_isbn='$a1'")->num_rows > 0 ){

					//eser var
					$esid_cek = mysqli_fetch_array($s->query("SELECT * FROM eserler WHERE eser_isbn='$a1'"));
					$esid = $esid_cek["eser_id"];
					$teslim_ara = $s->query("SELECT * FROM teslimler WHERE eser_id='$esid' && teslim_durumu=0")->num_rows;
					$mevcut = (int)$esid_cek["eser_adet"]-(int)$teslim_ara;
					if( ($saf_isbn != $a1) && $mevcut <= 0){

						echo "Bu eser şu anda mevcut değildir! Teslimleri kontrol ediniz.";

					}else{

						$teslim_alan = $s->teslim($teslimid,"teslim_alan_no");
						$eser = $s->teslim($teslimid,"eser_id");

						$ogrenciad = addslashes($s->ogrencino($teslim_alan,"ogrenci_ad"));
						$ogrencisinif = addslashes($s->ogrencino($teslim_alan,"ogrenci_sinif"));
						$eserad = addslashes($s->eser($eser,"eser_ad"));
						$eserisbn = addslashes($s->eser($eser,"eser_isbn"));
						$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
						$teslim_verim_tarihi = $s->teslim($teslimid,"teslim_verim_tarihi");
						$iade_edilecek_tarih = $s->teslim($teslimid,"teslim_alim_tarihi");
						$kac_gun = floor(((int)$iade_edilecek_tarih-(int)$teslim_verim_tarihi) / (60*60*24));
						$tarihi = $s->tr_dateTime($teslim_verim_tarihi);
						$teslimverenid = $s->teslim($teslimid,"teslim_veren");
						$teslim_veren_uye = $s->kullanici($teslimverenid,"uye_adsoyad");
						$eylem_icerik = "$ogrenciad($ogrencisinif-$teslim_alan) adlı öğrenciye $tarihi günü $teslim_veren_uye tarafından $kac_gun günlüğüne verilen $eserad teslimini düzenledi. (ISBN: $eserisbn)";
						
						//her şey tamam
						$q = $s->query("UPDATE teslimler SET eser_id='$esid',
							teslim_alan_no='$a4',
							teslim_alim_tarihi='$alimtarih',
							teslim_verim_tarihi='$verimtarih',
							teslim_not='$a6' WHERE teslim_id='$teslimid'");

						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
						}

					}

				}else{
					echo "Böyle bir eser bulunamadı!";
				}

		}

	}
}
?>