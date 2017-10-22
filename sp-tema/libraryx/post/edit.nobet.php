<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$nobet_id = $_POST["nobet_id"]; //site isim
	$tarihler = $_POST["tarihler"]; //tarihler
	$nobetcilerbir = $_POST["nobetcilerbir"]; //nöbetçiler ilk (id şeklinde)
	$nobetcileriki = $_POST["nobetcileriki"]; //nöbetçiler ilk (id şeklinde)

	$a = 0;
	$err = false;
	foreach ($nobetcilerbir as $kontrol) {
		if(($kontrol != "yok" && $nobetcileriki[$a] != "yok") && ($kontrol == $nobetcileriki[$a]) ){
			$err = true;
		}
		$a++;
	}


	if(  !$nobet_id || !$tarihler || !$nobetcilerbir || !$nobetcileriki ){
		echo "Kod Hatası! Site yöneticisine danışın!";
	}elseif( !$s->nobet_var_mi($nobet_id) ){
		echo "Böyle bir nöbet yok!";
	}elseif($err){
		echo "İki nöbetçiyi de aynı kişi seçemezsiniz!";
	}else{

		$nobet_ay = $s->nobet_aylik($nobet_id,"nobet_ay");
		$nobet_ay_yazi = $s->tr_Ay($nobet_ay);
		$nobet_yil = $s->nobet_aylik($nobet_id,"nobet_yil");
		$nobet_baslik = $nobet_ay_yazi." ".$nobet_yil;

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "$nobet_baslik nöbet listesini düzenledi.";

		$i = 0;
		foreach ($nobetcilerbir as $nobetcibir) {
			$tarihi = $tarihler[$i];// 05.02.2017
			$tarihi_parcala = explode(".", $tarihi);
			$gun = (int)$tarihi_parcala[0];
			$ay = (int)$tarihi_parcala[1];
			$yil = (int)$tarihi_parcala[2];
			$tarihi_time = mktime(0,0,0,$ay,$gun,$yil);
			$ikinci_nobetci = $nobetcileriki[$i];

			if($nobetcibir=="yok" && $ikinci_nobetci=="yok"){
				$s->query("DELETE FROM nobetler_cizelge WHERE nobet_id='$nobet_id' && nobet_gunu='$gun'");
			}else{
				if($nobetcibir=="yok"){
					$nobetcibir = 0;
				}
				if($ikinci_nobetci=="yok"){
					$ikinci_nobetci = 0;
				}
				$zaten_o_mu = $s->query("SELECT * FROM nobetler_cizelge WHERE nobet_id='$nobet_id' && nobet_gunu='$gun' && nobetci_id_bir='$nobetcibir' && nobetci_id_iki='$ikinci_nobetci'")->num_rows;
				if($zaten_o_mu==1){
					$i++;
					continue;
				}else{
					$s->query("DELETE FROM nobetler_cizelge WHERE nobet_id='$nobet_id' && nobet_gunu='$gun'");
					$s->query("INSERT INTO nobetler_cizelge (nobet_id,nobetci_id_bir,nobetci_id_iki,nobet_gunu) VALUES ('$nobet_id','$nobetcibir','$ikinci_nobetci','$gun')");
				}
				
			}
			$i++;
		}

		$s->eylem($eylem_yapan,$eylem_icerik);
		echo "ok";

	}
}
?>