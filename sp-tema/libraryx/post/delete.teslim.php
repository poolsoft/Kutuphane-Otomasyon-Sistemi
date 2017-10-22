<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //teslimid

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->teslim_var_mi($a1) ){

			$teslim_alan = $s->teslim($a1,"teslim_alan_no");
			$eser = $s->teslim($a1,"eser_id");

			$ogrenciad = addslashes($s->ogrencino($teslim_alan,"ogrenci_ad"));
			$ogrencisinif = addslashes($s->ogrencino($teslim_alan,"ogrenci_sinif"));
			$eserad = addslashes($s->eser($eser,"eser_ad"));
			$eserisbn = addslashes($s->eser($eser,"eser_isbn"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$teslim_verim_tarihi = $s->teslim($a1,"teslim_verim_tarihi");
			$iade_edilecek_tarih = $s->teslim($a1,"teslim_alim_tarihi");
			$kac_gun = floor(((int)$iade_edilecek_tarih-(int)$teslim_verim_tarihi) / (60*60*24));
			$tarihi = $s->tr_dateTime($teslim_verim_tarihi);
			$teslimverenid = $s->teslim($a1,"teslim_veren");
			$teslim_veren_uye = $s->kullanici($teslimverenid,"uye_adsoyad");
			$eylem_icerik = "$ogrenciad($ogrencisinif-$teslim_alan) adlı öğrenciye $tarihi günü $teslim_veren_uye tarafından $kac_gun günlüğüne verilen $eserad teslimini sildi. (ISBN: $eserisbn)";

			$q = $s->query("DELETE FROM teslimler WHERE teslim_id='$a1'");

			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
			}

		}else{
			echo "HATA! Böyle bir teslim yok!";
		}
	}

}
?>