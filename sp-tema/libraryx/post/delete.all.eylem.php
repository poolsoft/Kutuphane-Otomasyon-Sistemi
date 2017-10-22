<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	if( $s->kullanici($_SESSION["sp_user"],"uye_tur")==1 || $s->kullanici($_SESSION["sp_user"],"uye_tur")==2 ){

			$y = $s->query("DELETE FROM eylemler");
			if($y){
				$s->query("ALTER TABLE eylemler AUTO_INCREMENT = 1");
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

	}else{
		echo "HATA! Yetkiniz yok!";
	}

}
?>