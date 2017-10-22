<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //ad
	$a2 = $s->p("a2"); //sınıf
	$a3 = $s->p("a3"); //no
	$a4 = $s->p("a4"); //cinsiyet

	if( !$a1 || !$a3 || !$a4 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a3) ){
		echo "Lütfen geçerli bir okul numarası girin!";
	}else{
		//her şey tamam

		$numara_kontrol = $s->query("SELECT * FROM ogrenciler WHERE ogrenci_no='$a3'")->num_rows;
		if( ($numara_kontrol==1) ){
			echo "Bu numaraya sahip bir öğrenci zaten var!";
		}else{

			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$a1($a2-$a3) adında yeni bir öğrenci ekledi.";

			$ekle = $s->query("INSERT INTO ogrenciler(ogrenci_ad,
				ogrenci_no,
				ogrenci_sinif,
				ogrenci_cinsiyet) VALUES('$a1','$a3','$a2','$a4')");
			if($ekle){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "HATA! Lütfen tekrar deneyin! #1";
			}


		}

				
	}

}
?>