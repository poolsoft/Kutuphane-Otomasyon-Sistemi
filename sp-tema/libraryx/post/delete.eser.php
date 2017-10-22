<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{

	$a1 = $s->p("a1"); //eserid

	if(!$a1){
		echo "HATA! Bir veri girin!";
	}elseif(!is_numeric($a1)){
		echo "HATA! Yazılımsal hata!";
	}else{
		if( $s->eser_var_mi($a1) ){

			$q = $s->query("SELECT * FROM teslimler WHERE eser_id='$a1'")->num_rows;

			if($q>0){
				echo "Bu eserin teslim(ler)i var. Bu eseri silmek için önce teslim(ler)i kaldırmalısınız.";
			}else{

				$eser_adi = addslashes($s->eser($a1,"eser_ad"));
				$eser_isbn = addslashes($s->eser($a1,"eser_isbn"));
				$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
				$eylem_icerik = "$eser_adi adlı eseri sildi. (ISBN: $eser_isbn)";

				$eser_foto = $s->eser($a1,"eser_foto");

				unlink(__DIR__."/../../../uploads/eserler/".$eser_foto);
				$q = $s->query("DELETE FROM eserler WHERE eser_id='$a1'");
				if($q){
					$s->eylem($eylem_yapan,$eylem_icerik);
					echo "ok";
				}else{
					echo "Veritabanı hatası! Tekrar deneyin!";
				}

			}

		}else{
			echo "HATA! Böyle bir eser yok!";
		}
	}

}
?>