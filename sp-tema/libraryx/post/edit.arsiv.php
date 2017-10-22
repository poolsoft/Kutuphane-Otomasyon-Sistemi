<?php
include("../../../sp-sistem/baglanti.php");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$arsiv_id = $s->p("arsiv_id");
	$a1 = $s->p("a1"); //ad

	if( !$arsiv_id || !$a1 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($arsiv_id) ){
		echo "Lütfen sayfayı yenileyin!";
	}else{
		
		if( !$s->arsiv_var_mi($arsiv_id) ){
			echo "Böyle bir arşiv yok!";
		}else{

			$arsiv_adi = addslashes($s->arsiv($arsiv_id,"arsiv_ad"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$arsiv_adi adlı arşivi düzenledi.";

			$guncelle = $s->query("UPDATE arsivler SET arsiv_ad='$a1' WHERE id='$arsiv_id'");
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