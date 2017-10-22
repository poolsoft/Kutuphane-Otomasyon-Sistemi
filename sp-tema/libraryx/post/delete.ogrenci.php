<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //öğrenci id

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->ogrenci_var_mi($a1) ){

			$ogrenci_no = $s->ogrenci($a1,"ogrenci_no");
			$q = $s->query("SELECT * FROM teslimler WHERE teslim_alan_no='$ogrenci_no'")->num_rows;

			if($q>0){
				echo "Bu öğrencinin teslim(ler)i var. Bu öğrenciyi silmek için önce teslim(ler)ini kaldırmalısınız.";
			}else{

				$ogrenci_adi = addslashes($s->ogrenci($a1,"ogrenci_ad"));
				$ogrenci_sinif = addslashes($s->ogrenci($a1,"ogrenci_sinif"));
				$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
				$eylem_icerik = "$ogrenci_adi($ogrenci_sinif-$ogrenci_no) adlı öğrenciyi sildi.";

				$q = $s->query("DELETE FROM ogrenciler WHERE id='$a1'");
				if($q){
					$s->eylem($eylem_yapan,$eylem_icerik);
					echo "ok";
				}else{
					echo "Veritabanı hatası! Tekrar deneyin!";
				}

			}

		}else{
			echo "HATA! Böyle bir öğrenci yok!";
		}
	}

}
?>