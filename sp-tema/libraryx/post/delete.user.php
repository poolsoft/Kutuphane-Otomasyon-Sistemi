<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //teslimid

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->uye_var_mi($a1) ){

			$q = $s->query("SELECT * FROM teslimler WHERE teslim_veren='$a1'")->num_rows;

			if($q>0){
				echo "Bu üyenin teslim(ler)i var. Bu üyeyi silmek için önce teslim(ler)ini kaldırmalısınız.";
			}else{

				$uye_adi = addslashes($s->kullanici($a1,"uye_adsoyad"));
				$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
				$eylem_icerik = "$uye_adi adlı üyeyi sildi.";

				$uye_foto = $s->kullanici($a1,"uye_foto");

				unlink(__DIR__."/../../../uploads/users/".$uye_foto);
				$y = $s->query("DELETE FROM nobetler_cizelge WHERE nobetci_id='$a1'");
				$q = $s->query("DELETE FROM uyeler WHERE uye_id='$a1'");
				if($q && $y){
					$s->eylem($eylem_yapan,$eylem_icerik);
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