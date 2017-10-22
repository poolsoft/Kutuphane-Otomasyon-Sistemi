<?php
include("../../../sp-sistem/baglanti.php");

define("MAX_SIZE","5120");
define("NEW_WIDTH","320");

if( !$s->giris_yapildi() ){
	header("Location: ".URL."");
	exit();
}else{
	$foto = $_FILES["foto"];
	$a1 = $s->p("a1"); //kadi
	$a2 = $s->p("a2"); //ad
	$a3 = $s->p("a3"); //email
	$a4 = $s->p("a4"); //şifre
	$a5 = $s->p("a5"); //şifre 2
	$a6 = $s->p("a6"); //sınıf
	$a7 = $s->p("a7"); //okul no
	$a8 = $s->p("a8"); //üye türü
	$a9 = $s->p("a9"); //üye cinsiyet
	$y1 = $s->p("y1"); //düzenle-eser
	$y2 = $s->p("y2"); //düzenle-teslim
	$y3 = $s->p("y3"); //düzenle-öğrenci
	$y4 = $s->p("y4"); //düzenle-öğretmen
	$y5 = $s->p("y5"); //düzenle-idareci
	$y6 = $s->p("y6"); //düzenle-site ayar
	$sifre_girilmis = false;

	if($a8=="1" || $a8=="2"){
		$a6 = null;
		$a7 = null;
		$a67 = null;
	}else{
		$a67 = "($a6-$a7)";
	}

	//yetkiler
	$yetkiler = array();
	if($y1){
		array_push($yetkiler, $y1);
	}
	if($y2){
		array_push($yetkiler, $y2);
	}
	if($y3){
		array_push($yetkiler, $y3);
	}
	if($y4){
		array_push($yetkiler, $y4);
	}
	if($y5){
		array_push($yetkiler, $y5);
	}
	if($y6){
		array_push($yetkiler, $y6);
	}

	if(empty($yetkiler)){
		$yetkiler = "";
	}else{
		$yetkiler = implode(',', $yetkiler);
	}

	if( !$a9 || ( $a8=="3" && (!$a1 || !$a2 || !$a3 || !$a6 || !$a7) ) || ( $a8=="1" && (!$a1 || !$a2 || !$a3) ) || ( $a8=="2" && (!$a1 || !$a2 || !$a3) ) ){
		echo "Lütfen bütün gerekli alanları doldurun!";
	}elseif(!filter_var($a3, FILTER_VALIDATE_EMAIL)){
		echo "Lütfen geçerli bir eMail adresi girin!";
	}elseif( $a4 != $a5 ){
		echo "Şifreler uyuşmuyor!";
	}elseif( strlen($a1)<5 ){
		echo "Kullanıcı adınız 5 karakterden az olamaz!";
	}elseif( strlen($a4)<5 ){
		echo "Şifreniz 5 karakterden az olamaz!";
	}elseif( $s->kadi_var_mi($a1) ){
		echo "Bu kullanıcı adı başka bir üye tarafından kullanılıyor!";
	}elseif( $s->email_var_mi($a3) ){
		echo "Bu email adresi başka bir üye tarafından kullanılıyor!";
	}elseif( !$s->kadi_kontrol($a1) ){
		echo "Lütfen geçerli bir kullanıcı adı girin!";
	}else{
		//her şey tamam

		$eylem_yapan = $s->kullanici($_SESSION["sp_user"],"uye_adsoyad");
		$eylem_icerik = "$a2 adında yeni bir üye ekledi.";

		if(isset( $foto ) && !empty( $foto["name"] )){
			//fotoğraf eklenmişse

			$imageFileType = pathinfo($foto["name"],PATHINFO_EXTENSION);
			$target_dir = __DIR__."/../../../uploads/users/";
			$uniq = uniqid().".".$imageFileType;
			$target_file = $target_dir . $uniq;
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			    echo "Fotoğraf olarak sadece JPG, JPEG, PNG & GIF dosyaları yükleyebilirsiniz.";
			}else{
				$uploadedfile = $foto["tmp_name"];

				$size = filesize($uploadedfile);

				if($size > MAX_SIZE*1024){
				 echo "Bu fotoğrafın boyutu çok büyük!";
				}else{
					$a = $s->CreateThumbnail($imageFileType,$uploadedfile,$target_file,NEW_WIDTH);
					if($a){
						$sifrele = $s->sifrele($a4);
						$now = time();
						$q = $s->query("INSERT INTO uyeler(uye_foto,
							uye_kadi,
							uye_adsoyad,
							uye_email,
							uye_pass,
							uye_sinif,
							uye_okulno,
							uye_cinsiyet,
							uye_tur,
							uye_kayittarihi,
							uye_eylemler) VALUES('$uniq',
							'$a1',
							'$a2',
							'$a3',
							'$sifrele',
							'$a6',
							'$a7',
							'$a9',
							'$a8',
							'$now',
							'$yetkiler')");
						if($q){
							$s->eylem($eylem_yapan,$eylem_icerik);
							echo "ok";
						}else{
							echo "Veritabanı hatası! Tekrar deneyin! kod:#1";
						}
					}else{
						echo "Fotoğraf yüklenemedi!";
					}

				}
			}

			}else{
				//fotoğraf eklenmemişse
				$sifrele = $s->sifrele($a4);
				$now = time();
				$q = $s->query("INSERT INTO uyeler(uye_kadi,
						uye_adsoyad,
						uye_email,
						uye_pass,
						uye_sinif,
						uye_okulno,
						uye_cinsiyet,
						uye_tur,
						uye_kayittarihi,
						uye_eylemler) VALUES('$a1',
						'$a2',
						'$a3',
						'$sifrele',
						'$a6',
						'$a7',
						'$a9',
						'$a8',
						'$now',
						'$yetkiler')");
					if($q){
						$s->eylem($eylem_yapan,$eylem_icerik);
						echo "ok";
					}else{
						echo $s->error();
					}
			}

				
	}

}
?>