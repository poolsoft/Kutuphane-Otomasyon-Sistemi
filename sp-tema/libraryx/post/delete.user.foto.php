<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //üye id

	if(!$a1){
		echo "Üye ID'si girilmedi!";
	}else{
		if( $s->uye_var_mi($a1) ){

			$uye_adi = addslashes($s->kullanici($a1,"uye_adsoyad"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$uye_adi adlı üyenin fotoğrafını sildi.";

			$uye_foto = $s->kullanici($a1,"uye_foto");
			unlink(__DIR__."/../../../uploads/users/".$uye_foto);
			$q = $s->query("UPDATE uyeler SET uye_foto='' WHERE uye_id='$a1'");
			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
			echo "Böyle bir üye bulunamadı!";
		}
	}

}
?>