<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //üye id

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->uye_var_mi($a1) ){

			$q = $s->query("SELECT * FROM uyeler WHERE uye_id='$a1' && uye_nobetci=1")->num_rows;

			if($q>0){
				echo "Bu üye zaten nöbetçi!";
			}else{
				
				$ad = $s->kullanici($a1,"uye_adsoyad");
				$now = time();
				$b = $s->query("INSERT INTO nobetciler(nobetci_ad,tarih) VALUES('$ad','$now')");
				$a = $s->query("UPDATE uyeler SET uye_nobetci=0");
				$q = $s->query("UPDATE uyeler SET uye_nobetci=1 WHERE uye_id='$a1'");
				if($b && $a && $q){
					echo "ok";
				}else{
					echo "Veritabanı hatası! Tekrar deneyin!";
				}

			}

		}else{
			echo "HATA! Böyle bir üye yok!";
		}
	}

}
?>