<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //arşiv id

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->arsiv_var_mi($a1) ){

			$arsiv_adi = addslashes($s->arsiv($a1,"arsiv_ad"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$arsiv_adi adlı arşivi sildi.";

			$q = $s->query("DELETE FROM arsivler WHERE id='$a1'");
			$y = $s->query("DELETE FROM teslimler_arsiv WHERE arsiv_id='$a1'");
			if($q && $y){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
			echo "HATA! Böyle bir arşiv yok!";
		}
	}

}
?>