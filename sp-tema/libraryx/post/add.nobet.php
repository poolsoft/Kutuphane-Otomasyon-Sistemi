<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //ay
	$a2 = $s->p("a2"); //yıl

	if( !$a1 || !$a2 ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif(!is_numeric($a1) || !is_numeric($a2)){
		echo "Lütfen sayfayı yenileyin!";
	}else{
		//her şey tamam
		$aynisi_kontrol = $s->query("SELECT * FROM nobetler_aylik WHERE nobet_ay='$a1' && nobet_yil='$a2'")->num_rows;
		if( ($aynisi_kontrol==1) ){
			echo "Böyle bir çizelge zaten var!";
		}else{

			$nobet_ay_yazi = $s->tr_Ay((int)$a1);
			$nobet_baslik = $nobet_ay_yazi." ".$a2;
			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "$nobet_baslik nöbet listesini oluşturdu.";

			$ekle = $s->query("INSERT INTO nobetler_aylik(nobet_ay,nobet_yil) VALUES('$a1','$a2')");
			if($ekle){
				$s->eylem($eylem_yapan,$eylem_icerik);
				echo "ok";
			}else{
				echo "HATA! Lütfen tekrar deneyin! #1";
			}


		}

				
	}

}
?>