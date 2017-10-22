<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //cat id

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->cat_var_mi($a1) ){

			$cat_adi = addslashes($s->cat($a1,"cat_ad"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$cat_adi adlı eser kategorisini sildi.";

			$q = $s->query("UPDATE eserler SET eser_cat=0 WHERE eser_cat='$a1'");
			$y = $s->query("DELETE FROM eserler_kategoriler WHERE cat_id='$a1'");
			if($q && $y){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
			echo "HATA! Böyle bir kategori yok!";
		}
	}

}
?>