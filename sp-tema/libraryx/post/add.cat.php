<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //ad
	$a1_kucuk = mb_strtolower($a1);

	if( !$a1 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
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
		//her şey tamam
		if(strpos($a1, '&amp;') !== false){
			$a1 = str_replace("&amp;", "&", $a1);
		}
		$ad_kontrol = $s->query("SELECT * FROM eserler_kategoriler WHERE LOWER(cat_ad)='$a1_kucuk'")->num_rows;
		if( ($ad_kontrol==1) ){
			echo "Bu ada sahip bir kategori zaten var!";
		}else{

			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$a1 adında yeni bir eser kategorisi oluşturdu.";

			$now = time();
			$ekle = $s->query("INSERT INTO eserler_kategoriler(cat_ad,cat_olusturma_tarihi) VALUES('$a1','$now')");
			if($ekle){
				$s->eylem($eylem_yapan,$eylem_icerik);
				$cekhele = mysqli_fetch_array($s->query("SELECT * FROM eserler_kategoriler WHERE cat_ad='$a1'"));
				$id = $cekhele["cat_id"];
				echo "okeyto******".$id."******".$a1;
			}else{
				echo "HATA! Lütfen tekrar deneyin! #1";
			}


		}

				
	}

}
?>