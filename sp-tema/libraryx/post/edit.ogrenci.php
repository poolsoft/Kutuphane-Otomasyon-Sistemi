<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$numara_first = $s->p("numara_first");
	$ogrenci_id = $s->p("ogrenciid");
	$a1 = $s->p("a1"); //ad
	$a2 = $s->p("a2"); //sınıf
	$a3 = $s->p("a3"); //numara
	$a4 = $s->p("a4"); //cinsiyet

	if( !$a1 || !$a3 || !$a4 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a3) ){
		echo "Lütfen geçerli bir sınıf numarası girin!";
	}else{
		
		$numara_kontrol = $s->query("SELECT * FROM ogrenciler WHERE ogrenci_no='$a3'")->num_rows;
		if( ($numara_first != $a3) && ($numara_kontrol==1) ){
			echo "Bu numaraya sahip bir öğrenci zaten var!";
		}else{

			$ogrenci_adi = addslashes($s->ogrenci($ogrenci_id,"ogrenci_ad"));
			$ogrenci_sinif = addslashes($s->ogrenci($ogrenci_id,"ogrenci_sinif"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$ogrenci_adi($ogrenci_sinif-$a3) adlı öğrenciyi düzenledi.";

			$guncelle = $s->query("UPDATE ogrenciler SET ogrenci_ad='$a1',
				ogrenci_sinif='$a2',
				ogrenci_no='$a3',
				ogrenci_cinsiyet='$a4' WHERE id='$ogrenci_id'");
			if($guncelle){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "HATA! Lütfen tekrar deneyin! #1";
			}


		}
		
	}
}
?>