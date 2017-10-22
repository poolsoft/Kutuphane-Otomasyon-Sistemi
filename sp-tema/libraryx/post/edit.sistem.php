<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$a1 = $s->p("a1"); //site isim
	$a2 = $s->p("a2"); //site okul
	$a3 = $s->p("a3"); //site desc
	$a4 = $s->p("a4"); //site url
	$a5 = $s->p("a5"); //site tema
	$a6 = $s->p("a6"); //site durum


	if(  !$a1 || !$a2 || !$a3 || !$a4 || !$a5 || !$a6  ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a6) ){
		echo "Sayfayı yenileyin!";
	}else{

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "sistem ayarlarını düzenledi.";

		$durum = (int)$a6;
		$q = $s->query("UPDATE sistem SET site_isim='$a1',
			site_okul='$a2',
			site_desc='$a3',
			site_url='$a4',
			site_tema='$a5',
			site_durum='$durum' WHERE site_id=1");

		if($q){
			$s->eylem($eylem_yapan,$eylem_icerik);
			echo "ok";
		}else{
			echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
		}

	}
}
?>