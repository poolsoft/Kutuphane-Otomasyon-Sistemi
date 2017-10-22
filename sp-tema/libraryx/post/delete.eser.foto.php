<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //eser id

	if(!$a1){
		echo "Eser ID'si girilmedi!";
	}else{
		if( $s->eser_var_mi($a1) ){

			$eser_adi = addslashes($s->eser($a1,"eser_ad"));
			$eser_isbn = addslashes($s->eser($a1,"eser_isbn"));
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$eser_adi adlı eserin fotoğrafını sildi. (ISBN: $eser_isbn)";

			$eser_foto = $s->eser($a1,"eser_foto");
			unlink(__DIR__."/../../../uploads/eserler/".$eser_foto);
			$q = $s->query("UPDATE eserler SET eser_foto='' WHERE eser_id='$a1'");
			if($q){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
			echo "Böyle bir eser bulunamadı!";
		}
	}

}
?>