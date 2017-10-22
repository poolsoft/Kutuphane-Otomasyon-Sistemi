<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "tüm nöbet listelerini sildi.";

		$q = $s->query("DELETE FROM nobetler_aylik");
		$y = $s->query("DELETE FROM nobetler_cizelge");
		if($q){
			$s->eylem($eylem_yapan,$eylem_icerik);
			$s->query("ALTER TABLE nobetler_aylik AUTO_INCREMENT = 1");
			echo "ok";
		}else{
			echo "Veritabanı hatası! Tekrar deneyin!";
		}

	}else{
		echo "HATA! Yetkiniz yok!";
	}

}
?>