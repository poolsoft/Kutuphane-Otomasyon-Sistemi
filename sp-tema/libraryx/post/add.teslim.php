<?php
include("../../../sp-sistem/baglanti.php");
if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$eserid = $s->p("eserid");
	$teslimid = $s->p("teslimid");
	$a1 = $s->p("a1"); //isbn
	$a4 = $s->p("a4"); //no
	$a51 = $s->p("a51"); //verimtarih
	$a5 = $s->p("a5"); //alimtarih
	$a6 = $s->p("a6"); //not


	if(  (!$a1 || !$a5) || !$a4  ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif( !is_numeric($a4) ){
		echo "Lütfen sayısal değer girilmesi gereken yere sayısal değer girin!";
	}elseif( !$s->validateDate($a5) ){
		echo "Lütfen geçerli bir iade tarihi girin!";
	}elseif( !$s->validateDate($a51) ){
		echo "Lütfen geçerli bir teslim verim tarihi girin!";
	}elseif( !$s->ogrenci_var_mi_no($a4) ){
		echo "Bu numaraya sahip bir öğrenci yok!";
	}else{

		$alimtarih = strtotime($a5);
		$verimtarih = strtotime($a51);

		if( ((int)$alimtarih < (int)$verimtarih) ){
			echo "İade tarihini veriliş tarihinden daha erken giremezsiniz!";
		}else{

				if( $s->query("SELECT * FROM eserler WHERE eser_isbn='$a1'")->num_rows > 0 ){

					//eser var
					$esid_cek = mysqli_fetch_array($s->query("SELECT * FROM eserler WHERE eser_isbn='$a1'"));
					$esid = $esid_cek["eser_id"];

					$teslim_ara = $s->query("SELECT * FROM teslimler WHERE eser_id='$esid' && teslim_durumu=0")->num_rows;
					$mevcut = (int)$esid_cek["eser_adet"]-(int)$teslim_ara;

					if($mevcut>0){
						
						//her şey tamam
						$ogrenciad = $s->ogrencino($a4,"ogrenci_ad");
						$ogrencisinif = $s->ogrencino($a4,"ogrenci_sinif");
						$eserad = $s->eserisbn($a1,"eser_ad");
						$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
						$eylem_icerik = "$ogrenciad($ogrencisinif-$a4) adlı öğrenciye $eserad adlı eseri teslim etti. (ISBN: $a1)";

						$teslim_veren = $_SESSION["sp_user"];
						$now = time();
						$q = $s->query("INSERT INTO teslimler(eser_id,
							teslim_alan_no,
							teslim_veren,
							teslim_verim_tarihi,
							teslim_alim_tarihi,
							teslim_durumu,
							teslim_not) VALUES('$esid',
							'$a4',
							'$teslim_veren',
							'$verimtarih',
							'$alimtarih',
							0,
							'$a6')");

						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
						}

					}else{
						echo "Bu eser şu anda mevcut değildir! Teslimleri kontrol ediniz.";
					}


				}else{
					echo "Böyle bir eser bulunamadı!";
				}
		}
	}
}
?>