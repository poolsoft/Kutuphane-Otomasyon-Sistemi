<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){

		$ogrenci_no = $s->ogrenci($a1,"ogrenci_no");
		$ax = $s->query("SELECT * FROM teslimler")->num_rows;

		if($ax<0){
			echo "Öğrencilerin teslim(ler)i var. Tüm öğrencileri silmek için önce teslim(ler)i kaldırmalısınız.";
		}else{

			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "tüm öğrencileri sildi.";

			$q = $s->query("DELETE FROM ogrenciler");
			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				$s->query("ALTER TABLE ogrenciler AUTO_INCREMENT = 1");
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}

	}else{
		echo "HATA! Yetkiniz yok!";
	}

}
?>