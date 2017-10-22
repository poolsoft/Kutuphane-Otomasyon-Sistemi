<?php
include("../../../sp-sistem/baglanti.php");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$kategori_id = $s->p("cid");
	$a1 = $s->p("a1"); //ad
	$a1_kucuk = mb_strtolower($a1);
	$eski_ad = $s->p("eskiad");

	if( !$kategori_id || !$a1 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($kategori_id) ){
		echo "Lütfen sayfayı yenileyin!";
	}elseif(strpos($a1, "&lt;") !== false){
		echo "Kategori adında özel karakterler kullanamazsınız!";
	}elseif(strpos($a1, "&gt;") !== false){
		echo "Kategori adında özel karakterler kullanamazsınız!";
	}elseif(strpos($a1, "&amp;") !== false){
		echo "Kategori adında özel karakterler kullanamazsınız!";
	}elseif(strpos($a1, "'") !== false){
		echo "Kesme işareti kullanamazsınız!";
	}elseif(strpos($a1, '&quot;') !== false){
		echo "Tırnak işareti kullanamazsınız!";
	}elseif(mb_strtolower($a1)=="diğer"){
		echo "Lütfen başka bir ad kullanın!";
	}else{
		
		if( !$s->cat_var_mi($kategori_id) ){
			echo "Böyle bir kategori yok!";
		}else{
			
			$ad_kontrol = $s->query("SELECT * FROM eserler_kategoriler WHERE LOWER(cat_ad)='$a1_kucuk'")->num_rows;
			if( $a1 != $eski_ad && ($ad_kontrol==1) ){
				echo "Bu ada sahip bir kategori zaten var!";
			}else{
				$cat_adi = addslashes($s->cat($kategori_id,"cat_ad"));
				$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
				$eylem_icerik = "$cat_adi adlı eser kategorisini düzenledi.";
				$guncelle = $s->query("UPDATE eserler_kategoriler SET cat_ad='$a1' WHERE cat_id='$kategori_id'");
				if($guncelle){
					$s->eylem($eylem_yapan,$eylem_icerik);
					echo "okeyto******".$a1;
				}else{
					echo "HATA! Lütfen tekrar deneyin! #1";
				}
			}	

		}
		
	}
}
?>