<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //nöbet

	if(!$a1){
		echo "Nöbet ID'si girilmedi!";
	}else{
		if( $s->nobet_var_mi($a1) ){

			$nobet_ay = $s->nobet_aylik($a1,"nobet_ay");
			$nobet_ay_yazi = $s->tr_Ay($nobet_ay);
			$nobet_yil = $s->nobet_aylik($a1,"nobet_yil");
			$nobet_baslik = $nobet_ay_yazi." ".$nobet_yil;

			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$nobet_baslik nöbet listesini sildi.";

			$q = $s->query("DELETE FROM nobetler_aylik WHERE nobet_id='$a1'");
			$y = $s->query("DELETE FROM nobetler_cizelge WHERE nobet_id='$a1'");
			if($q && $y){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "Veritabanı hatası! Tekrar deneyin!";
			}

		}else{
			echo "Böyle bir nöbet bulunamadı!";
		}
	}

}
?>