<?php
include("../../../sp-sistem/baglanti.php");
if( $s->giris_yapildi() ){
	echo "ok";
}else{

	$a1 = mb_strtolower($s->p("a1")); //kullanıcı adı
	$a2 = $s->p("a2"); //şifre

	if(!$a1 || !$a2){
		echo "Lütfen bütün alanları doldurun!";
	}else{

		$sifrele = $s->sifrele($a2);
		if( $s->uye_var($a1,$sifrele) ){
			// üye var
			$uyeid_cek = mysqli_fetch_array($s->query("SELECT * FROM uyeler WHERE uye_kadi='$a1'"));
			$uyeid = $uyeid_cek["uye_id"];

			//session oluştur -- uye_id ile
			$s->session_giris_yap($uyeid);


			$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
			$eylem_icerik = "giriş yaptı.";

			$s->eylem($eylem_yapan,$eylem_icerik);
			echo "ok";

		}else{
			//üye yok
			echo "Kullanıcı adı veya şifre hatalı!";

		}

	}

}
?>